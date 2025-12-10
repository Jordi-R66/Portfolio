<?php
class DatabaseCredentials {
	private static $instance = null;
	private static $initialized = false;

	private $dbname;
	private $pass;
	private $uname;

	private function __construct() {
		$fp = fopen(__DIR__ . "/credentials.txt", "r");

		if ($fp) {
			while (($line = fgets($fp)) !== false) {
				$line = str_replace("\n", "", $line);
				$key_vals = explode("=", $line);

				if (strcmp($key_vals[0], "password") == 0) {
					$this->pass = $key_vals[1];
				} else if (strcmp($key_vals[0], "username") == 0) {
					$this->uname = $key_vals[1];
				} else if (strcmp($key_vals[0], "database") == 0) {
					$this->dbname = $key_vals[1];
				} else if (!str_starts_with($line, "//")) {
					throw new Exception("Impossible de lire le fichier des credentials", 1);
				}
			}

			fclose($fp);

			self::$initialized = true;
		}
	}

	public function getPassword() {
		return $this->pass;
	}

	public function getUsername() {
		return $this->uname;
	}

	public function getDatabase() {
		return $this->dbname;
	}

	public static function getInstance() {
		if (!self::$initialized) {
			self::$instance = new DatabaseCredentials();
		}

		return self::$instance;
	}
}

?>