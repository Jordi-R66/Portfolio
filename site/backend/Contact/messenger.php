<?php

require_once "ContactCredentials.php";
require_once __DIR__ . '/../DB/Database.php';

function transformerIP(string $ip): string {
	return bin2hex(inet_pton($ip));
}

function ajouterMessage($ip, $sujet, $corps, $tel, $mail) {
	$pdo = Database::getPDO();
	$sql = "INSERT INTO historiqueContact (ipMessage,sujetMessage,corpsMessage,telephone,email)
	VALUES (:ip, :sujet, :corps, :tel, :mail);";

	$stmt = $pdo->prepare($sql);

	$stmt->execute([
		"ip" => transformerIP($ip),
		"sujet" => $sujet,
		"corps" => $corps,
		"tel" => $tel,
		"mail" => $mail
	]);
}

?>
