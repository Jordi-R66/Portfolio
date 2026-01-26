<?php

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
			$lang = trim($parts[0]);
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
		$sousDossiers = glob(self::DOSSIER_LANGUES . '/*', GLOB_ONLYDIR);
		return $sousDossiers;
	}

	static function getTranslatedPages($lang): array {
		$cleanLang = basename($lang);
		$pattern = self::DOSSIER_LANGUES . DIRECTORY_SEPARATOR . $cleanLang . '/*.csv';
		$files = glob($pattern) ?: [];

		$output = array_map(fn($f) => basename($f, '.csv'), $files);

		return $output;
	}

	/**
	 * $lang: the language code
	 * $page: the name of the page without the file extension
	 */
	static function getPage($lang, $page): array {
		return array();
	}
}

LanguageHandler::getTranslatedPages("fr");
?>

