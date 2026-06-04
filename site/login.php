<?php

require_once __DIR__ . '/backend/pageloader/PageLoader.php';
require_once __DIR__ . '/backend/Traduction/LanguageHandler.php';
require_once __DIR__ . '/backend/misc.php';

$page = getCurrentPage();
$content = PageLoader::loadHTML($page);
$currentLang = LanguageHandler::pickLanguage();

$translations = LanguageHandler::getPageText($currentLang, "login");
$errorParam = $_GET['error'] ?? '0';
$targetParam = $_GET['target'] ?? '';

$statusText = "";
if ($errorParam === '1') {
	$statusText = $translations['msg_error'] ?? '';
}

$targetUrl = "facadeLogin.php";
if (!empty($targetParam)) {
	$targetUrl .= "?target=" . urlencode($targetParam);
}

$tagDict = [
	"copyright_year" => date("Y"),
	"MESSAGE_STATUS" => $statusText,
	"form_target_input" => $targetUrl
];

$tagDict = array_merge($tagDict, LanguageHandler::getPageText($currentLang, "header"));
$tagDict = array_merge($tagDict, LanguageHandler::getPageText($currentLang, "footer"));
$tagDict = array_merge($tagDict, $translations);

$content = PageLoader::replaceTextTag($tagDict, $content);

echo $content;
exit();
