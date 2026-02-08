<?php

require_once __DIR__ . '/../DB/Database.php';
require_once "Message.php";

function listerMessages(): array {
	$output = array();

	$pdo = Database::getPDO();
	$sql = "SELECT idMessage, timestampMessage, sujetMessage, corpsMessage, telephone, email, lu FROM messagesFormulaire ORDER BY timestampMessage DESC";

	$stmt = $pdo->query($sql);

	foreach ($stmt as $msg) {
		array_push($output, Message::MessageFromArray($msg));
	}

	return $output;
}