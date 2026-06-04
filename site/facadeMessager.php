<?php

$format_temps = "[d/m/Y @ H:i:s]";
$regexMail = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
$regexTel = '/^\+?(\d{1,3})?[\s.-]?(?:\(?\d{1,4}\)?[\s.-]?)*\d{1,4}$/';

$sujet = $_POST["objet"] ?? '';
$corps = $_POST["corps"] ?? '';
$telephone = $_POST["telephone"] ?? '';
$email = $_POST["email"] ?? '';

$rt = 0;
$ip = $_SERVER["REMOTE_ADDR"] ?? '';

require_once "backend/Contact/messenger.php";

$hasContactInfo = (!empty($telephone) || !empty($email));
$isValidFormat = (preg_match($regexMail, $email) || preg_match($regexTel, $telephone));

if ($hasContactInfo && $isValidFormat && !empty($ip) && checkIp($ip)) {
	$temps = date($format_temps);
	$texteSMS = "$temps Nouveau message déposé sur le portfolio";

	ajouterMessage($ip, $sujet, $corps, $telephone, $email);
	$codeRetour = envoyerSms($texteSMS);
	ajouterSMS($texteSMS, $codeRetour);

	$rt = 1;
}

header("Location: https://portfolio.jordi-rocafort.fr/contact.php?statut=" . $rt);
exit();
