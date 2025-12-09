<?php

require_once "Credentials.php";

class Database {
	private static $instance = null;
	private $pdo;

	private $host = '10.8.0.1';
	private $port = '5243';
	private Credentials $creds;

	private function __construct() {
		try {
			$this->creds = Credentials::getInstance();
			$db_name = $this->creds->getDatabase();

			$this->pdo = new PDO(
				"pgsql:host=$this->host;port=$this->port;dbname=$db_name",
				$this->creds->getUsername(),
				$this->creds->getPassword()
			);

			// Forcer UTF-8 pour PostgreSQL
			$this->pdo->exec("SET NAMES 'UTF8'");

			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Erreur de connexion : " . $e->getMessage();
		} catch (Exception $e) {
			echo "Erreur d'initialisation : " . $e->getMessage();
		}
	}

	public static function getInstance() {
		if (self::$instance === null) {
			self::$instance = new Database();
		}
		return self::$instance;
	}

	public static function getPDO() {
		return self::getInstance()->pdo;
	}

	public static function testConnexion() {
		try {
			$pdo = self::getPDO();
		} catch (PDOException $e) {
			echo "Erreur de test : " . $e->getMessage();
		}
	}
}

Database::testConnexion();