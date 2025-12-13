<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/php-error.log');

var_dump($_POST);

$format_temps = "[d/m/Y @ H:i:s]";

$REGEX_MAIL = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
$REGEX_TEL = '/^\+?(\d{1,3})?[\s.-]?(?:\(?\d{1,4}\)?[\s.-]?)*\d{1,4}$/';

$sujet = $_POST["objet"];
$corps = $_POST["corps"];
$telephone = $_POST["telephone"];
$email = $_POST["email"];

$continuer = true;

// Vérif num téléphone / email

$continuer = $continuer && ((!is_null($telephone)) || (!is_null($email)));
$continuer = $continuer && (preg_match($REGEX_MAIL, $email) || preg_match($REGEX_TEL, $telephone));

if ($continuer) {
	$ip = $_SERVER["REMOTE_ADDR"];

	if (is_null($telephone)) {
		$telephone = "";
	}

	if (is_null($email)) {
		$email = "";
	}

	require_once "backend/Contact/messenger.php";

	$temps = date($format_temps);
	$texteSMS = "$temps Nouveau message déposé sur le portfolio";

	ajouterMessage($ip, $sujet, $corps, $telephone, $email);
	$codeRetour = envoyerSms($texteSMS);

	ajouterSMS($texteSMS, $codeRetour);

	header("Location: https://jordi-rocafort.fr/portfolio/contact.php", true, 204);
}

?>
