<?php

class CookieManager {

	/**
	 * @param string $cookieName The name associated to the cookie
	 * @param string $cookieValue The value associated to the cookie
	 * @param int $cookieTTL The cookies's time to live in seconds
	 */
	static function setCookie(string $cookieName, string $cookieValue, int $cookieTTL): void {
		setcookie($cookieName, $cookieValue, time() + $cookieTTL, "/", "portfolio.jordi-rocafort.fr", true, true);
	}

	static function cookieExists(string $cookieName): bool {
		return isset($_COOKIE[$cookieName]);
	}

	static function clearCookie(string $cookieName) {
		if (isset($_COOKIE[$cookieName])) {
			unset($_COOKIE[$cookieName]);
			setcookie($cookieName, "", 1, "/", "portfolio.jordi-rocafort.fr", true, true);
		}
	}
}

?>
