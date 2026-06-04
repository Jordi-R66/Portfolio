<?php

require_once __DIR__ . '/backend/pageloader/PageLoader.php';
require_once __DIR__ . '/backend/Traduction/LanguageHandler.php';
require_once __DIR__ . '/backend/misc.php';

$page = getCurrentPage();
$content = PageLoader::loadHTML($page);
$currentLang = LanguageHandler::pickLanguage();

$tagDict = [
	"copyright_year" => date("Y")
];

$tagDict = array_merge($tagDict, LanguageHandler::getPageText($currentLang, "header"));
$tagDict = array_merge($tagDict, LanguageHandler::getPageText($currentLang, "footer"));
$tagDict = array_merge($tagDict, LanguageHandler::getPageText($currentLang, "experience"));

$content = PageLoader::replaceTextTag($tagDict, $content);

echo $content;
exit();
