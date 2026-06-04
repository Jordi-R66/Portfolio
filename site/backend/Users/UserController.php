<?php

require_once __DIR__ . '/../CookieManager.php';
require_once __DIR__ . '/../DB/Database.php';

class UserController {
	public const CONN_OK = 0;
	public const CONN_INVALID = 1;
	public const CONN_EXPIRED = 2;

	private const COOKIE_NAME = "auth_token";
	private const SESSION_TTL_SECONDS = 3600;
	private const SESSION_TTL_SQL = '1 hour';

	public static function login(string $username, string $password): bool {
		$status = false;

		try {
			$pdo = Database::getPDO();
			$sql = "SELECT userId, passHash FROM public.users WHERE username = :username";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['username' => $username]);
			$user = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($user && password_verify($password, $user['passhash'])) {
				$sqlInsert = "INSERT INTO public.auth_codes (userId, expiration) 
                              VALUES (:uid, NOW() + INTERVAL '" . self::SESSION_TTL_SQL . "') 
                              RETURNING codeUUID";
				$stmtInsert = $pdo->prepare($sqlInsert);
				$stmtInsert->execute(['uid' => $user['userid']]);
				$result = $stmtInsert->fetch(PDO::FETCH_ASSOC);

				$uuidGenerated = $result['codeuuid'];

				$sqlUpdate = "UPDATE public.users SET lastConn = CURRENT_TIMESTAMP WHERE userId = :uid";
				$stmtUpdate = $pdo->prepare($sqlUpdate);
				$stmtUpdate->execute(['uid' => $user['userid']]);

				CookieManager::setCookie(self::COOKIE_NAME, $uuidGenerated, self::SESSION_TTL_SECONDS);
				$status = true;
			}
		} catch (PDOException $e) {
			$status = false;
		}

		return $status;
	}

	public static function validateConnection(): int {
		$status = self::CONN_INVALID;

		if (CookieManager::cookieExists(self::COOKIE_NAME)) {
			$uuid = $_COOKIE[self::COOKIE_NAME];
			$pdo = Database::getPDO();

			$sql = "SELECT (expiration > NOW()) as is_active 
                    FROM public.auth_codes 
                    WHERE codeUUID = :uuid";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['uuid' => $uuid]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			if (!$row) {
				CookieManager::clearCookie(self::COOKIE_NAME);
				$status = self::CONN_INVALID;
			}

			if ($row) {
				$status = self::CONN_EXPIRED;
				if ($row['is_active'] === true) {
					$status = self::CONN_OK;
				}
				if ($status === self::CONN_EXPIRED) {
					self::logout();
				}
			}
		}

		return $status;
	}

	public static function logout(): void {
		if (CookieManager::cookieExists(self::COOKIE_NAME)) {
			$uuid = $_COOKIE[self::COOKIE_NAME];

			try {
				$pdo = Database::getPDO();
				$sql = "DELETE FROM public.auth_codes WHERE codeUUID = :uuid";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(['uuid' => $uuid]);
			} catch (Exception $e) {
			}

			CookieManager::clearCookie(self::COOKIE_NAME);
		}
	}
}
