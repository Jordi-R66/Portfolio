<?php

require_once __DIR__ . '/backend/pageloader/PageLoader.php';
require_once __DIR__ . '/backend/Traduction/LanguageHandler.php';
require_once __DIR__ . '/backend/misc.php';

$page = getCurrentPage();
$content = PageLoader::loadHTML($page);
$currentLang = LanguageHandler::pickLanguage();

$translations = LanguageHandler::getPageText($currentLang, "contact");
$statusParam = $_GET['statut'] ?? '-1';

$statusText = "";
if ($statusParam === '0') {
	$statusText = $translations['msg_error'] ?? '';
}
if ($statusParam === '1') {
	$statusText = $translations['msg_success'] ?? '';
}

$tagDict = [
	"copyright_year" => date("Y"),
	"MESSAGE_STATUS" => $statusText
];

$tagDict = array_merge($tagDict, LanguageHandler::getPageText($currentLang, "header"));
$tagDict = array_merge($tagDict, LanguageHandler::getPageText($currentLang, "footer"));
$tagDict = array_merge($tagDict, $translations);

$content = PageLoader::replaceTextTag($tagDict, $content);

echo $content;
exit();
