<?php

require_once __DIR__ . '/backend/Traduction/LanguageHandler.php';

$allowedLanguages = LanguageHandler::getKnownLanguages();
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'fr';

if (in_array($lang, $allowedLanguages)) {
	if (LangCookieManager::cookieExists()) {
		LangCookieManager::clearCookie();
	}

	LangCookieManager::setCookie($lang);
}

$redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';

if (strpos($redirect_url, $_SERVER['HTTP_HOST']) === false && strpos($redirect_url, 'http') === 0) {
	$redirect_url = 'index.php';
}

header("Location: " . $redirect_url);
exit();
?>
