<?php

class PageLoader {
	private const HTML_DIR = __DIR__ . "/../html";

	/**
	 * @param array $lookup An array with the tag name as a key, and the value to replace with
	 * @param string $html self-explanatory
	 * @return string the full html page
	 */
	static function replaceTextTag(array $lookup, string $html): string {
		$output = $html;

		foreach ($lookup as $tagName => $tagValue) {
			$output = str_replace("TXT\t$tagName;", $tagValue, $output);
		}

		return $output;
	}

	/**
	 * @param string pageName directly used to load the matching html file
	 * @return string the full html page
	 */
	static function loadHTML(string $pageName): string {
		$output = "";

		$fp = fopen(PageLoader::HTML_DIR . "/$pageName.html", "r");

		if ($fp) {
			while (($line = fgets($fp)) !== false) {
				$line = str_replace("\n", "", $line);
				$temp_line = str_replace("\t", "", $line);

				if (str_starts_with($temp_line, "REQ ")) {
					$requirement = explode(" ", $temp_line)[1];
					$line = PageLoader::loadHTML(str_replace(".html", "", $requirement));
				}

				$output = "$output$line\n";
			}

			fclose($fp);
		}

		return $output;
	}
}

?>