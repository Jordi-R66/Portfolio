<?php

require_once "langMenuGenerator.php";
require_once __DIR__ . "/../CookieManager.php";

class LangCookieManager {
	private const COOKIE_TTL = 86400;
	private const COOKIE_NAME = "lang";

	static function setCookie(string $lang): void {
		CookieManager::setCookie(self::COOKIE_NAME, $lang, self::COOKIE_TTL);
	}

	static function cookieExists(): bool {
		return CookieManager::cookieExists(self::COOKIE_NAME);
	}

	static function readCookie(): string {
		return self::cookieExists() ? $_COOKIE[self::COOKIE_NAME] : "en";
	}

	static function clearCookie(): void {
		CookieManager::clearCookie(self::COOKIE_NAME);
	}
}

class LanguageHandler {
	private const DOSSIER_LANGUES = __DIR__ . '/lang/';

	static function getClientLanguages(): array {
		$httpAcceptLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';

		if (empty($httpAcceptLanguage)) {
			return [];
		}

		$languages = [];
		// On sépare les différentes entrées par la virgule
		foreach (explode(',', $httpAcceptLanguage) as $part) {
			$parts = explode(';', $part);
			$lang = explode("_", trim($parts[0]))[0];
			$lang = explode("-", trim($parts[0]))[0];
			$q = 1.0; // Priorité par défaut

			// On cherche le paramètre 'q=' s'il existe
			if (isset($parts[1])) {
				$attr = explode('=', $parts[1]);
				if (isset($attr[1]) && trim($attr[0]) === 'q') {
					$q = (float) $attr[1];
				}
			}

			$languages[$lang] = $q;
		}

		// Tri décroissant par valeur (le coefficient 'q')
		arsort($languages);

		// On retourne uniquement les clés (les codes langues 'fr-FR', 'en', etc.)
		return array_keys($languages);
	}

	static function getKnownLanguages(): array {
		// Le pattern '/*' sélectionne tout le contenu, le flag ne garde que les dossiers
		$sousDossiers = glob(self::DOSSIER_LANGUES . '*', GLOB_ONLYDIR);

		foreach ($sousDossiers as $i => $path) {
			$sousDossiers[$i] = str_replace(self::DOSSIER_LANGUES, "", $sousDossiers[$i]);
		}

		return $sousDossiers;
	}

	static function getCommonLanguages(): array {
		return array_intersect(self::getClientLanguages(), self::getKnownLanguages());
	}

	static function getTranslatedPages($lang): array {
		$cleanLang = basename($lang);
		$pattern = self::DOSSIER_LANGUES . DIRECTORY_SEPARATOR . $cleanLang . '/*.tsv';
		$files = glob($pattern) ?: [];

		$output = array_map(fn($f) => basename($f, '.tsv'), $files);

		return $output;
	}

	/**
	 * @param string $lang: the language code
	 * @param string $page: the name of the page without the file extension
	 */
	static function getPageText(string $lang, string $page): array {
		$output = array();

		$cleanLang = basename($lang);
		$filePath = self::DOSSIER_LANGUES . DIRECTORY_SEPARATOR . $cleanLang . DIRECTORY_SEPARATOR . "$page.tsv";

		if (($handle = fopen($filePath, 'r')) !== false) {
			// On parcourt ligne par ligne
			// 0 = longueur illimitée de la ligne
			// "\t" = le séparateur est une tabulation
			while (($data = fgetcsv($handle, 0, "\t")) !== false) {
				// Sécurité : On s'assure qu'on a bien au moins 2 colonnes (code et texte)
				// et on ignore les lignes vides
				if (count($data) >= 2) {
					$key = trim($data[0]);
					$value = trim($data[1]);

					// Optionnel : On saute la ligne d'en-tête si elle existe
					if ($key === 'text_code') {
						continue;
					}

					$output[$key] = $value;
				}
			}

			fclose($handle);
		}

		if ($page === 'header') {
			// On appelle le générateur qui renvoie le <li> complet
			$output['lang_menu'] = LangMenuGenerator::generate($lang);
		}

		return $output;
	}

	static function pickLanguage(): string {
		$output = "";

		if (!LangCookieManager::cookieExists()) {
			if (!isset($_GET["lang"])) {
				$commonLangs = self::getCommonLanguages();
				$output = count($commonLangs) > 0 ? $commonLangs[0] : "fr";
			} else {
				$lang = $_GET["lang"];
				$output = in_array($lang, self::getKnownLanguages()) ? $lang : "fr";
			}
		} else {
			$output = LangCookieManager::readCookie();
		}

		return $output;
	}
}
?>

