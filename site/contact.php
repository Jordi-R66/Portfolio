<?php

require_once __DIR__ . '/backend/pageloader/PageLoader.php';

$content = PageLoader::loadHTML("contact");

$status = "";

if (isset($_GET["statut"]) && ($_GET["statut"] === "0" || $_GET["statut"] === "1")) {
	$sent = intval($_GET["statut"]) == 1;

	$color = $sent == true ? "green" : "red";
	$texte = $sent == true ? "Votre message a pu être envoyé !" : "Votre message n'a pas pu être envoyé, veuillez réessayer plus tard";

	$status = "<h4 style=\"color: $color;\">$texte</h4>";
}

$lookup = array("MESSAGE_STATUS" => $status);

$content = PageLoader::replaceTextTag($lookup, $content);

echo $content;
exit;
?>
