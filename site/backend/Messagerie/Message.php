<?php

class Message
{
	// ... (gardez vos propriétés et le constructeur existants inchangés) ...
	private int $id;
	private int $timestamp;
	private string $sujet;
	private string $contenu;
	private string $telephone;
	private string $email;
	private bool $lu;

	public function __construct(int $idMsg, string $tsMsg, string $sujetMsg, string $contenuMsg, string $telMsg, string $mailMsg, bool $msgLu)
	{
		$this->id = $idMsg;
		$this->timestamp = $tsMsg;
		$this->sujet = $sujetMsg;
		$this->contenu = $contenuMsg;
		$this->telephone = $telMsg;
		$this->email = $mailMsg;
		$this->lu = $msgLu;
	}

	public static function MessageFromArray(array $arr): Message
	{
		// ... (inchangé) ...
		$id = $arr["idmessage"];
		$timestamp = $arr["timestampmessage"];
		$sujet = $arr["sujetmessage"];
		$contenu = $arr["corpsmessage"];
		$telephone = $arr["telephone"];
		$email = $arr["email"];
		$lu = $arr["lu"];

		return new Message($id, $timestamp, $sujet, $contenu, $telephone, $email, $lu);
	}

	// --- NOUVELLE MÉTHODE TOHTML ---
	public function toHTML(): string
	{
		$date_heure = date("d/m/Y H:i", $this->timestamp);

		// Classes CSS dynamiques selon l'état
		$statusClass = $this->lu ? "is-read" : "not-read";
		$statusText = $this->lu ? "Lu" : "Nouveau";

		// Sécurisation de l'affichage (XSS)
		$safeSujet = htmlspecialchars($this->sujet);
		$safeContenu = htmlspecialchars($this->contenu);
		$safeEmail = htmlspecialchars($this->email);
		$safeTel = htmlspecialchars($this->telephone);

		// Icônes SVG inline pour éviter de devoir charger des images
		$iconMail = '<svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>';
		$iconPhone = '<svg viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>';

		return <<<HTML
        <div class="message-card $statusClass" id="message_$this->id">
            <div class="msg-header">
                <span class="msg-id">#$this->id</span>
                <span class="msg-status">$statusText</span>
            </div>

            <h3 class="msg-subject">$safeSujet</h3>
            
            <div class="msg-body">$safeContenu</div>

            <div class="msg-footer">
                <div class="msg-info">
                    $iconMail <span><a href="mailto:$safeEmail" style="color:inherit;">$safeEmail</a></span>
                </div>
                <div class="msg-info">
                    $iconPhone <span>$safeTel</span>
                </div>
                <div class="msg-date">Reçu le $date_heure UTC</div>
            </div>
        </div>
HTML;
	}
}
