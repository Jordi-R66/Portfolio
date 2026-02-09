<?php

require_once __DIR__ . '/backend/Users/UserController.php';
require_once __DIR__ . '/backend/pageloader/PageLoader.php';
require_once __DIR__ . '/backend/Traduction/LanguageHandler.php';
require_once __DIR__ . '/backend/Messagerie/messagerie.php';
require_once __DIR__ . '/backend/misc.php';

if (UserController::validateConnection()) {
	header("Location: https://portfolio.jordi-rocafort.fr/login.php");
	exit;
} else {
	$page = getCurrentPage();
	$content = PageLoader::loadHTML($page);

	$msgList = listerMessages();
	$msgBlocks = "";

	foreach ($msgList as $msg) {
		$msgBlocks .= $msg->toHTML();
	}

	$tagDict = array(
		"messages" => $msgBlocks,
		"copyright_year" => date("Y")
	);

	$tagDict = array_merge($tagDict, LanguageHandler::getPageText("fr", "header"));
	$tagDict = array_merge($tagDict, LanguageHandler::getPageText("fr", "footer"));

	$content = PageLoader::replaceTextTag($tagDict, $content);

	echo $content;

	exit;
}
