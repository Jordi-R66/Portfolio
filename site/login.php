<?php
require_once __DIR__ . '/backend/Users/UserController.php';
require_once __DIR__ . '/backend/pageloader/PageLoader.php';
require_once __DIR__ . '/backend/Traduction/LanguageHandler.php';
require_once __DIR__ . '/backend/misc.php';

$page = getCurrentPage();
$lang = "fr";

$content = PageLoader::loadHTML($page);

$status = "";

if (isset($_GET["statut"]) && ($_GET["statut"] === "0" || $_GET["statut"] === "1")) {
	$sent = intval($_GET["statut"]) == 1;

	$color = $sent == true ? "green" : "red";
	$texte = $sent == true ? "Authentification validée, connexion autorisée pendant une heure" : "Authentification impossible";

	$status = "<h4 style=\"color: $color;\">$texte</h4>";
}

$tagDict = array("MESSAGE_STATUS" => $status, "copyright_year" => date("Y"));
$tagDict = array_merge($tagDict, LanguageHandler::getPageText($lang, "header"));

if (!isset($tagDict["lang_code"])) {
	$tagDict["lang_code"] = $lang;
}

$content = PageLoader::replaceTextTag($tagDict, $content);

echo $content;
exit;
?>