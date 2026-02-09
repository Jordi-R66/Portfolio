<?php
require_once __DIR__ . '/backend/Users/UserController.php';
require_once __DIR__ . '/backend/pageloader/PageLoader.php';
require_once __DIR__ . '/backend/Traduction/LanguageHandler.php';
require_once __DIR__ . '/backend/misc.php';

// 1. Initialisation
$page = getCurrentPage();
$lang = "fr";
$content = PageLoader::loadHTML($page);
$statusHTML = ""; // Variable vide par défaut

// 2. Vérification de la connexion active
// Si l'utilisateur est déjà connecté (cookie valide), on le redirige immédiatement.
if (UserController::validateConnection() === UserController::CONN_OK) {
	header("Location: https://portfolio.jordi-rocafort.fr/index.php");
	exit;
} else {
	// 3. Gestion des messages d'erreur/succès via $_GET
	if (isset($_GET["statut"])) {

		// Base de style commune pour toutes les alertes (CSS Inline)
		$baseStyle = "padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; font-family: sans-serif; text-align: center; font-size: 0.95em;";

		switch ($_GET["statut"]) {
			case "0": // ÉCHEC
				// Style Rouge (Erreur)
				$style = $baseStyle . "color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;";
				$message = "<strong>Erreur :</strong> Identifiant ou mot de passe incorrect.";
				break;

			case "1": // SUCCÈS
				// Style Vert (Succès)
				$style = $baseStyle . "color: #155724; background-color: #d4edda; border-color: #c3e6cb;";
				$message = "<strong>Succès !</strong> Connexion autorisée. Redirection...";
				break;

			case "2": // EXPIRÉ (Optionnel, si tu veux gérer le timeout plus tard)
				// Style Orange (Avertissement)
				$style = $baseStyle . "color: #856404; background-color: #fff3cd; border-color: #ffeeba;";
				$message = "<strong>Session expirée :</strong> Veuillez vous reconnecter.";
				break;

			default:
				$style = "";
				$message = "";
		}

		// Si on a un message défini, on construit le HTML
		if (!empty($message)) {
			$statusHTML = "<div style=\"$style\">$message</div>";
		}
	}

	// 4. Remplacement des tags et affichage
	// On injecte le bloc HTML complet dans le tag MESSAGE_STATUS
	$tagDict = array("MESSAGE_STATUS" => $statusHTML, "copyright_year" => date("Y"));
	$tagDict = array_merge($tagDict, LanguageHandler::getPageText($lang, "header"));

	if (!isset($tagDict["lang_code"])) {
		$tagDict["lang_code"] = $lang;
	}

	$content = PageLoader::replaceTextTag($tagDict, $content);

	echo $content;
	exit;
}
