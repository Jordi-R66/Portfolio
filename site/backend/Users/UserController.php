<?php

require_once __DIR__ . '/../CookieManager.php';
require_once __DIR__ . '/../DB/Database.php';

class UserController
{
	// Codes de statut pour la réponse de validation
	public const CONN_OK = 0;
	public const CONN_INVALID = 1; // Cookie absent ou fraude
	public const CONN_EXPIRED = 2; // Session techniquement terminée

	private const COOKIE_NAME = "auth_token";

	// Durée de la session : 1 heure
	// On définit ici la durée pour PHP (secondes) et pour SQL (intervalle)
	private const SESSION_TTL_SECONDS = 3600;
	private const SESSION_TTL_SQL = '1 hour';

	/**
	 * Tente de connecter un utilisateur.
	 * Vérifie le hash (compatible pgcrypto $2a$) et crée une session.
	 */
	public static function login(string $username, string $password): bool
	{
		$pdo = Database::getPDO();

		try {
			// 1. Récupérer l'ID et le Hash de l'utilisateur
			// On ne récupère que ce qui est strictement nécessaire
			$sql = "SELECT userId, passHash FROM public.users WHERE username = :username";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['username' => $username]);
			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			// Utilisateur introuvable
			if (!$user) {
				return false;
			}

			// 2. Vérifier le mot de passe
			// password_verify() est compatible avec les hashs Blowfish ($2a$) générés par pgcrypto
			if (!password_verify($password, $user['passhash'])) {
				//var_dump($user);
				return false;
			}

			// 3. Créer la session (La magie PostgreSQL)
			// On délègue à Postgres la génération de l'UUID et le calcul de la date de fin.
			// Le "RETURNING codeUUID" nous évite une requête SELECT supplémentaire.
			$sqlInsert = "INSERT INTO public.auth_codes (userId, expiration) 
                          VALUES (:uid, NOW() + INTERVAL '" . self::SESSION_TTL_SQL . "') 
                          RETURNING codeUUID";

			$stmtInsert = $pdo->prepare($sqlInsert);
			$stmtInsert->execute(['uid' => $user['userid']]);
			$result = $stmtInsert->fetch(PDO::FETCH_ASSOC);

			$uuidGenereted = $result['codeuuid'];

			// 4. Mettre à jour la date de dernière connexion (Audit)
			// On utilise CURRENT_TIMESTAMP pour la précision
			$sqlUpdate = "UPDATE public.users SET lastConn = CURRENT_TIMESTAMP WHERE userId = :uid";
			$stmtUpdate = $pdo->prepare($sqlUpdate);
			$stmtUpdate->execute(['uid' => $user['userid']]);

			// 5. Poser le cookie via le Manager
			CookieManager::setCookie(self::COOKIE_NAME, $uuidGenereted, self::SESSION_TTL_SECONDS);

			return true;
		} catch (PDOException $e) {
			// En production, préférer un log fichier : error_log($e->getMessage());
			return false;
		}
	}

	/**
	 * Vérifie si la session courante est valide.
	 * Optimisé pour ne faire qu'une seule requête SQL légère.
	 */
	public static function validateConnection(): int
	{
		// 1. Vérification rapide via CookieManager
		if (!CookieManager::cookieExists(self::COOKIE_NAME)) {
			return self::CONN_INVALID;
		}

		// Note : CookieManager ne possède pas de méthode "get", on lit la superglobale directement
		$uuid = $_COOKIE[self::COOKIE_NAME];
		$pdo = Database::getPDO();

		// 2. Requête d'une pierre deux coups
		// On vérifie l'existence de l'UUID ET si la date est encore bonne.
		// Renvoie un booléen 'is_active'.
		$sql = "SELECT (expiration > NOW()) as is_active 
                FROM public.auth_codes 
                WHERE codeUUID = :uuid";

		// Note : Si ta colonne codeUUID est de type UUID en base, le cast ::uuid est implicite via PDO,
		// mais pour être rigoureux en SQL pur : WHERE codeUUID = :uuid::uuid
		$stmt = $pdo->prepare($sql);
		$stmt->execute(['uuid' => $uuid]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// Cas A : UUID introuvable en base (Session supprimée ou fausse)
		if (!$row) {
			CookieManager::clearCookie(self::COOKIE_NAME);
			return self::CONN_INVALID;
		}

		// Cas B : UUID trouvé, mais la date est dépassée (is_active = false)
		if ($row['is_active'] === false) {
			// On nettoie proprement
			self::logout();
			return self::CONN_EXPIRED;
		}

		// Cas C : Tout est vert
		return self::CONN_OK;
	}

	/**
	 * Déconnecte l'utilisateur : Nettoyage BDD et Cookie.
	 */
	public static function logout(): void
	{
		if (CookieManager::cookieExists(self::COOKIE_NAME)) {
			$uuid = $_COOKIE[self::COOKIE_NAME];

			try {
				$pdo = Database::getPDO();
				// Suppression de la session en base
				$sql = "DELETE FROM public.auth_codes WHERE codeUUID = :uuid";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(['uuid' => $uuid]);
			} catch (Exception $e) {
				// On continue même si la DB échoue, pour au moins supprimer le cookie
			}

			// Suppression du cookie navigateur
			CookieManager::clearCookie(self::COOKIE_NAME);
		}
	}
}
