<?php

class Message {
	private int $id;
	private int $timestamp;
	private string $sujet;
	private string $contenu;
	private string $telephone;
	private string $email;
	private bool $lu;

	public function __construct(int $idMsg, string $tsMsg, string $sujetMsg, string $contenuMsg, string $telMsg, string $mailMsg, bool $msgLu) {
		$this->id = $idMsg;
		$this->timestamp = $tsMsg;
		$this->sujet = $sujetMsg;
		$this->contenu = $contenuMsg;
		$this->telephone = $telMsg;
		$this->email = $mailMsg;
		$this->lu = $msgLu;
	}

	public static function MessageFromArray(array $arr): Message {
		$id = $arr["idmessage"];
		$timestamp = $arr["timestampmessage"];
		$sujet = $arr["sujetmessage"];
		$contenu = $arr["corpsmessage"];
		$telephone = $arr["telephone"];
		$email = $arr["email"];
		$lu = $arr["lu"];

		return new Message($id, $timestamp, $sujet, $contenu, $telephone, $email, $lu);
	}

	public function toHTML(): string {
		$output = "";

		$texteLecture = $this->lu ? "LU" : "NON LU";
		$date_heure = date("d/m/Y à H:i:s", $this->timestamp);

		$output .= "<div id=\"message_$this->id\">\n";
		$output .= "\t<p>Message n°$this->id - ($texteLecture) - Reçu le $date_heure UTC</p>\n";
		$output .= "\t<p>Sujet: $this->sujet</p>\n";
		$output .= "\t<p>Corps: $this->contenu</p>\n";
		$output .= "\t<p>Email: $this->email</p>\n";
		$output .= "\t<p>Tél: $this->telephone</p>\n";
		$output .= "</div>\n";

		return $output;
	}
}

?>