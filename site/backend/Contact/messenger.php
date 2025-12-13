<?php

require_once "ContactCredentials.php";
require_once __DIR__ . '/../DB/Database.php';

function transformerIP(string $ip): string {
	return bin2hex(inet_pton($ip));
}

function getTimestamp(): int {
	return (new DateTime())->getTimestamp();
}

function checkIp(string $ip): bool {
	$output = false;

	$msg_time = new DateTime();
	$msg_ts = $msg_time->getTimestamp();

	$pdo = Database::getPDO();
	$sql = "SELECT timestampMessage FROM messagesFormulaire WHERE ipMessage = :ip ORDER BY timestampMessage DESC LIMIT 1;";

	$stmt = $pdo->prepare($sql);

	$stmt->execute([
		"ip" => transformerIP($ip)
	]);

	$row = $stmt->fetch();

	//var_dump($row);

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
		$sql = "INSERT INTO messagesFormulaire (ipMessage,timestampMessage,sujetMessage,corpsMessage,telephone,email)
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

function envoyerSms(string $texte): int {
	$creds = ContactCredentials::getInstance(0);
	$url_api = "https://smsapi.free-mobile.fr/sendmsg";

	$data = [
		"user" => $creds->getIdFree(),
		"pass" => $creds->getApiKey(),
		"msg" => $texte
	];

	$ch = curl_init($url_api);

	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

	$response = curl_exec($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	curl_close($ch);

	return $status_code;
}

function ajouterSMS(string $texte, int $code) {
	$pdo = Database::getPDO();
	$sql = "INSERT INTO public.sms (timeMsg,content,codeStatut) VALUES (:tsMsg,:msg,:codeSms)";

	$stmt = $pdo->prepare($sql);

	$data = [
		"tsMsg" => getTimestamp(),
		"msg" => $texte,
		"codeSms" => $code
	];

	$stmt->execute($data);
}

?>
