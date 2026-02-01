<?php

class LangMenuGenerator {
	public static function generate(string $currentLang): string {
		$languages = LanguageHandler::getKnownLanguages();

		$upperLangCode = strtoupper($currentLang);

		// On ajoute un ID ou une classe pour le ciblage JS si besoin, 
		// mais ici on va utiliser "this.parentNode" pour faire simple.
		$html = '<li class="dropdown-item">';

		// MODIFICATION ICI : Ajout du toggle de classe 'open' sur le parent <li>
		$html .= '<a href="#" class="dropdown-toggle" onclick="this.parentNode.classList.toggle(\'open\'); return false;">';
		$html .= "<img src=\"img/flags/{$currentLang}.svg\" alt=\"$upperLangCode\" class=\"nav-flag\">" . ' <span class="arrow">▼</span>';
		$html .= '</a>';

		$html .= '<ul class="dropdown-menu">';

		foreach ($languages as $langCode) {
			if ($langCode === $currentLang) {
				continue;
			}

			$upperLangCode = strtoupper($langCode);

			$queryParams['lang'] = $langCode;
			$url = 'https://portfolio.jordi-rocafort.fr/changeLanguage.php?' . http_build_query($queryParams);
			$label = "<img src=\"img/flags/{$langCode}.svg\" alt=\"$upperLangCode\" class=\"nav-flag\">";

			$html .= "<li><a href=\"{$url}\">{$label}</a></li>";
		}

		$html .= '</ul>';
		$html .= '</li>';

		return $html;
	}
}
