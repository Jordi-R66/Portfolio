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
	$creds = ContactCredentials::getInstance(0); 
	$url_api_base = "https://smsapi.free-mobile.fr/sendmsg";

	$data_params = [
		"user" => $creds->getIdFree(),
		"pass" => $creds->getApiKey(),
		"msg" => $texte
	];

	$full_url = $url_api_base . '?' . http_build_query($data_params);

	$ch = curl_init($full_url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

	$response = curl_exec($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	/*echo "URL de la requête (pour debug) : " . htmlspecialchars($full_url) . "<br>";
	echo "Réponse du serveur : $response<br>";
	echo "Code de statut HTTP : $status_code<br>";*/

	// Ces dumps montrent les données que vous avez encodées, pas la requête brute.
	// var_dump($data_params); 
	// var_dump($response);

	curl_close($ch);

	return $status_code;
}

function checkIp(string $ip): bool {
	$output = true;

	$msg_time = new DateTime();
	$msg_ts = $msg_time->getTimestamp();

	$pdo = Database::getPDO();
	$sql = "SELECT timestampMessage FROM messagesFormulaire WHERE ipMessage = :ip ORDER BY timestampMessage DESC LIMIT 1;";

	$stmt = $pdo->prepare($sql);

	$stmt->execute([
		"ip" => transformerIP($ip)
	]);

	$row = $stmt->fetch();

	if ($row != false) {
		$ts = intval($row[0]);

		if (($msg_ts - $ts) >= (15 * 60 * 0)) {
			$output = true;
		} else {
			$output = false;
		}
	}

	return $output;
}

function ajouterMessage($ip, $sujet, $corps, $tel, $mail) {
	$msg_time = new DateTime();
	$msg_ts = $msg_time->getTimestamp();

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
