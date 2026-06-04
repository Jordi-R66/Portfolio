<?php

require_once __DIR__ . '/backend/Traduction/LanguageHandler.php';

$allowedLanguages = LanguageHandler::getKnownLanguages();
$lang = $_GET['lang'] ?? 'fr';
$redirectUrl = 'index.php';

if (in_array($lang, $allowedLanguages)) {
	if (LangCookieManager::cookieExists()) {
		LangCookieManager::clearCookie();
	}
	LangCookieManager::setCookie($lang);
}

if (isset($_SERVER['HTTP_REFERER'])) {
	if (strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) !== false || strpos($_SERVER['HTTP_REFERER'], 'http') !== 0) {
		$redirectUrl = $_SERVER['HTTP_REFERER'];
	}
}

header("Location: " . $redirectUrl);
exit();
