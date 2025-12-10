<!DOCTYPE html>
<html>
<head>
	<?php require_once "backend/html/head.html"; ?>
	<meta name="robots" content="noindex">
	<link href="css/contact.css" rel="stylesheet" type="text/css">

	<title>Jordi Rocafort - Contact</title>
</head>
<body>
	<?php require_once "backend/html/header.html"; ?>

	<main>
		<div id="info-contact-box">
			<h3>Comment me contacter</h3>

			<p>Suite à des abus commis sur mon adresse mail, j'ai décidé de la retirer du portfolio, merci de me contacter soit par LinkedIn/GitHub soit par le formulaire ci-dessous</p>

			<div id="info-contact-leftbox">
				<li class="contact-links">
					<a class="liens-contact" href="https://linkedin.com/in/jordi-rocafort"><img class="socials-icon" src="img/linkedin_icon.svg" alt="LinkedIn">LinkedIn</a>
					<a class="liens-contact" href="https://github.com/Jordi-R66/"><img class="socials-icon" src="img/github_icon.svg" alt="GitHub">GitHub</a>
				</li>
			</div>

			<div id="info-contact-formulaire">
				<form action="facadeMessager.php" method="POST">
					<input id="objet" name="objet" type="text" required>
					<input id="corps" name="corps" type="text" required>
					<input id="telephone" name="telephone" type="tel" pattern="\+?(\d{1,3})?[\s.-]?(?:\(?\d{1,4}\)?[\s.-]?)*\d{1,4}">
					<input id="email" name="email" type="email" pattern="(?:[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+)*|&quot;(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*&quot;)@(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z]{2,}|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-zA-Z0-9-]*[a-zA-Z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])">
					<button type="submit">
				</form>
			</div>
		</div>
	</main>

	<?php require_once "backend/html/footer.html"; ?>
</body>
</html>
