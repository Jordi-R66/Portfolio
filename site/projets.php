<!DOCTYPE html>
<html>
<head>
	<?php require_once "backend/html/head.html"; ?>
	<meta name="robots" content="noindex">
	<link href="css/projets.css" rel="stylesheet" type="text/css">

	<title>Jordi Rocafort - Projets</title>
</head>
<body>
	<?php require_once "backend/html/header.html"; ?>

	<main>
		<div class="projet" id="tle-decoder">
			<h2>TLE-Decoder</h2>
			<div class="infos-projet">
				<p>Projet personnel</p>
				<hr>
				<table class="langages-projet">
					<tr>
						<th>Langage</th>
						<th>Utilisation</th>
					</tr>
					<tr>
						<td>C</td>
						<td>Programme principal</td>
					</tr>
					<tr>
						<td>Python</td>
						<td>Téléchargement des données préalables & Prototypage</td>
					</tr>
				</table>
			</div>

			<img class="illus-projet" src="img/TLE-Decoder 25544.png">

			<div class="description-projet">
				<p>Ayant (presque) toujours été passionné par l'aérospatial, je me suis forcément intéressé à la manière dont l'on pouvait "prédire" la position de n'importe quel objet en orbite, et la calculer en temps réel.</p>

				<p>À la fin de la Terminale, en 2024, j'ai donc commencé à travailler sur ce projet. Je me base sur les lois de Kepler pour ensuite déterminer l'emplacement de n'importe quel satellite en orbite terrestre. À l'origine comme le nom l'indique c'était dédié au parsing des TLE (Two Line Elements), à savoir le format dans lequel sont encodées toutes les données nécessaires à tout algorithme ayant pour but de calculer l'emplacement d'un satellite. Ensuite, je me suis dit que quittes à avoir un moyen d'obtenir et décoder ces données, autant me servir de ces données, j'ai donc fini par coder ce projet</p>

				<p>Je suis à la fois fier et honteux de ce projet, (j'ai tort d'en avoir honte j'en suis conscient), en effet les matrices de transformations pour passer de coordonnées 2D vers 3D sont incorrectes, je me retrouve souvent avec des coordonnées qui indiquent une position du satellite au centre de la Terre et quelques secondes plus tard à l'apogée de l'orbite voire plus loin. Aussi, le code source contient beaucoup de vestigent de l'époque où je ne connaissais que trop mal le C. Ce sont donc mes deux raisons d'avoir un peu honte de ce projet</p>
			</div>
		</div>
		<hr>
		<div class="projet" id="jav-enchere">
			<h2>Jav'Enchère</h2>
			<div class="infos-projet">
				<p>Projet académique</p>
				<hr>
				<table class="langages-projet">
					<tr>
						<th>Langage</th>
						<th>Utilisation</th>
					</tr>
					<tr>
						<td>Java</td>
						<td>Entièreté</td>
					</tr>
				</table>
			</div>
		</div>
		<hr>
		<div class="projet" id="myownclib">
			<h2>myOwnCLib</h2>
			<div class="infos-projet">
				<p>Projet personnel</p>
				<hr>
				<table class="langages-projet">
					<tr>
						<th>Langage</th>
						<th>Utilisation</th>
					</tr>
					<tr>
						<td>C</td>
						<td>Entièreté</td>
					</tr>
				</table>
			</div>
		</div>
	</main>

	<?php require_once "backend/html/footer.html"; ?>
</body>
</html>
