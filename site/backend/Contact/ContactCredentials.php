<?php
class ContactCredentials {
	private static $instance = null;
	private static $initialized = false;

	private $id_free;
	private $api_key;

	private function __construct() {
		$fp = fopen(__DIR__ . "/credentials.txt", "r");

		if ($fp) {
			while (($line = fgets($fp)) !== false) {
				$line = str_replace("\n", "", $line);
				$key_vals = explode("=", $line);

				if (strcmp($key_vals[0], "ID_FREE") == 0) {
					$this->id_free = $key_vals[1];
				} else if (strcmp($key_vals[0], "API_KEY") == 0) {
					$this->api_key = $key_vals[1];
				} else if (!str_starts_with($line, "//")) {
					throw new Exception("Impossible de lire le fichier des credentials", 1);
				}
			}

			fclose($fp);

			self::$initialized = true;
		}
	}

	public function getIdFree() {
		return $this->id_free;
	}

	public function getApiKey() {
		return $this->api_key;
	}

	public static function getInstance() {
		if (!self::$initialized) {
			self::$instance = new ContactCredentials();
		}

		return self::$instance;
	}
}

?>