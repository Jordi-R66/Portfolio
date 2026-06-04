<?php

require_once "ContactCredentials.php";
require_once __DIR__ . '/../DB/Database.php';

function transformerIP(string $ip): string {
	return bin2hex(inet_pton($ip));
}

function getTimestamp(): int {
	return (new DateTime())->getTimestamp();
}

function envoyerSms(string $texte): int {
	$statusCode = 500;
	$creds = ContactCredentials::getInstance(0);
	$apiUrlBase = "https://smsapi.free-mobile.fr/sendmsg";

	if ($creds) {
		$dataParams = [
			"user" => $creds->getIdFree(),
			"pass" => $creds->getApiKey(),
			"msg" => $texte
		];

		$fullUrl = $apiUrlBase . '?' . http_build_query($dataParams);
		$ch = curl_init($fullUrl);

		if ($ch) {
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_exec($ch);

			$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
		}
	}

	return $statusCode;
}

function checkIp(string $ip): bool {
	$status = false;
	$msgTs = (new DateTime())->getTimestamp();
	$pdo = Database::getPDO();

	$sql = "SELECT timestampMessage FROM messagesFormulaire WHERE ipMessage = :ip ORDER BY timestampMessage DESC LIMIT 1;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(["ip" => transformerIP($ip)]);
	$row = $stmt->fetch();

	if (!$row) {
		$status = true;
	}

	if ($row) {
		$ts = intval($row[0]);
		if (($msgTs - $ts) >= (15 * 60)) {
			$status = true;
		}
	}

	return $status;
}

function ajouterMessage($ip, $sujet, $corps, $tel, $mail): void {
	$msgTs = (new DateTime())->getTimestamp();
	$pdo = Database::getPDO();

	$sql = "INSERT INTO messagesFormulaire (ipMessage, timestampMessage, sujetMessage, corpsMessage, telephone, email)
            VALUES (:ip, :msgTS, :sujet, :corps, :tel, :mail);";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		"ip" => transformerIP($ip),
		"msgTS" => $msgTs,
		"sujet" => $sujet,
		"corps" => $corps,
		"tel" => $tel,
		"mail" => $mail
	]);
}

function ajouterSMS(string $texte, int $code): void {
	$pdo = Database::getPDO();
	$sql = "INSERT INTO public.sms (timeMsg, content, codeStatut) VALUES (:tsMsg, :msg, :codeSms)";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		"tsMsg" => getTimestamp(),
		"msg" => $texte,
		"codeSms" => $code
	]);
}
