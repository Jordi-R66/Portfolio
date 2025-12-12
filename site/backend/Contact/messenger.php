<?php

require_once "ContactCredentials.php";
require_once __DIR__ . '/../DB/Database.php';

function transformerIP(string $ip): string {
	return bin2hex(inet_pton($ip));
}

function checkIp(string $ip): bool {
	$output = false;

	$msg_time = new DateTime();
	$msg_ts = $msg_time->getTimestamp();

	$pdo = Database::getPDO();
	$sql = "SELECT timestampMessage FROM historiqueContact WHERE ipMessage = :ip ORDER BY timestampMessage DESC LIMIT 1;";

	$stmt = $pdo->prepare($sql);

	$stmt->execute([
		"ip" => transformerIP($ip)
	]);

	$row = $stmt->fetch();

	var_dump($row);

	if ($row != false) {
		$ts = intval($row[0]);

		if (($msg_ts - $ts) >= (5 * 60)) {
			$output = true;
		}
	} else {
		$output = true;
	}

	return $output;
}

function ajouterMessage($ip, $sujet, $corps, $tel, $mail) {
	$msg_time = new DateTime();
	$msg_ts = $msg_time->getTimestamp();
	$canSend = checkIp($ip);

	if ($canSend) {
		$pdo = Database::getPDO();
		$sql = "INSERT INTO historiqueContact (ipMessage,timestampMessage,sujetMessage,corpsMessage,telephone,email)
		VALUES (:ip, :msgTS, :sujet, :corps, :tel, :mail);";

		$stmt = $pdo->prepare($sql);

		$stmt->execute([
			"ip" => transformerIP($ip),
			"msgTS" => $msg_ts,
			"sujet" => $sujet,
			"corps" => $corps,
			"tel" => $tel,
			"mail" => $mail
		]);
	}
}

?>
