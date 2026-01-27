<?php

class PageLoader {
	private const HTML_DIR = __DIR__ . "/../html";

	static function loadHTML(string $pageName) {
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

				$output = "$output$line";
			}

			fclose($fp);
		}

		return $output;
	}
}

?>