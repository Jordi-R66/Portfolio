<?php

require_once __DIR__ . '/backend/Users/UserController.php';
require_once __DIR__ . '/backend/pageloader/PageLoader.php';
require_once __DIR__ . '/backend/Traduction/LanguageHandler.php';
require_once __DIR__ . '/backend/Messagerie/messagerie.php';
require_once __DIR__ . '/backend/misc.php';

$isAuthorized = (UserController::validateConnection() === UserController::CONN_OK);
$targetLocation = "";

if (!$isAuthorized) {
	$target = urlencode($_SERVER['REQUEST_URI']);
	$targetLocation = "https://portfolio.jordi-rocafort.fr/login.php?target=" . $target;
}

if (!$isAuthorized) {
	header("Location: " . $targetLocation);
	exit();
}

$page = getCurrentPage();
$content = PageLoader::loadHTML($page);
$msgList = listerMessages();
$msgBlocks = "";

foreach ($msgList as $msg) {
	$msgBlocks .= $msg->toHTML();
}

$tagDict = [
	"messages" => $msgBlocks,
	"copyright_year" => date("Y")
];

$tagDict = array_merge($tagDict, LanguageHandler::getPageText("fr", "header"));
$tagDict = array_merge($tagDict, LanguageHandler::getPageText("fr", "footer"));
$content = PageLoader::replaceTextTag($tagDict, $content);

echo $content;
exit();
