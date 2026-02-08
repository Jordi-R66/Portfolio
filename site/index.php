<?php
require_once __DIR__ . '/backend/pageloader/PageLoader.php';
require_once __DIR__ . '/backend/Traduction/LanguageHandler.php';
require_once __DIR__ . '/backend/misc.php';

$page = getCurrentPage();
$lang = LanguageHandler::pickLanguage();

$content = PageLoader::loadHTML($page);

$tagDict = array(
	"copyright_year" => date("Y"));
$tagDict = array_merge($tagDict, LanguageHandler::getPageText($lang, "header"));
$tagDict = array_merge($tagDict, LanguageHandler::getPageText($lang, "footer"));
$tagDict = array_merge($tagDict, LanguageHandler::getPageText($lang, $page));

if (!isset($tagDict["lang_code"])) {
	$tagDict["lang_code"] = $lang;
}

$content = PageLoader::replaceTextTag($tagDict, $content);

echo $content;
exit;
?>