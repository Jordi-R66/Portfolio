<?php
require_once __DIR__ . '/backend/pageloader/PageLoader.php';
require_once __DIR__ . '/backend/Traduction/LanguageHandler.php';
require_once __DIR__ . '/backend/misc.php';

$page = getCurrentPage();

$content = PageLoader::loadHTML($page);

$tagDict = array();
$tagDict = array_merge($tagDict, LanguageHandler::getPageText("fr", "header"));
$tagDict = array_merge($tagDict, LanguageHandler::getPageText("fr", "footer"));
$tagDict = array_merge($tagDict, LanguageHandler::getPageText("fr", $page));

$content = PageLoader::replaceTextTag($tagDict, $content);

echo $content;
exit;
?>