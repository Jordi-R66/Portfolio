<?php

class LanguageHandler {
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
		$dossier = './files';

		// Le pattern '/*' sélectionne tout le contenu, le flag ne garde que les dossiers
		$sousDossiers = glob($dossier . '/*', GLOB_ONLYDIR);

		foreach ($sousDossiers as $cheminComplet) {
			// glob retourne le chemin complet (ex: ./mon-dossier/images)
			echo basename($cheminComplet) . "<br>"; // Affiche juste le nom (ex: images)
		}

		return $sousDossiers;
	}
}

LanguageHandler::getKnownLanguages();
