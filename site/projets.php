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
						<th>Technologie</th>
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

				<p>Je suis à la fois fier et honteux de ce projet, en effet les matrices de transformations pour passer de coordonnées 2D vers 3D sont incorrectes, je me retrouve souvent avec des coordonnées qui indiquent une position du satellite au centre de la Terre et quelques secondes plus tard à l'apogée de l'orbite voire plus loin. Aussi, le code source contient beaucoup de vestiges de l'époque où je ne connaissais que trop mal le C. Ce sont donc mes deux raisons d'avoir un peu honte de ce projet.</p>
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
						<th>Technologie</th>
						<th>Utilisation</th>
					</tr>
					<tr>
						<td>Java</td>
						<td>Entièreté</td>
					</tr>
				</table>
			</div>

			<img class="illus-projet" src="img/Screenshot-Javenchère.png" alt="Vous pouvez voir sur l'interface des comptes prédéfinis, il s'agit là d'un choix pratique pour les démonstrations">

			<div class="description-projet">
				<p>Dans le cadre de la SAÉ du troisème semestre de mon BUT Informatique, j'ai participé au développement d'un système d'enchères sécurisées à plis fermés (Lors des enchères personne ne connaît les prix que les acheteurs proposent, et sont révélés à la fin de la phase d'enchère). Pour être plus précis, il s'agit des enchères de Vickrey, une forme d'enchères reposant sur la théorie des jeux. Dans ce modèle, celui qui a proposé le plus haut prix remporte l'enchère mais ne paye que le deuxième plus haut prix.</p>

				<p>Au cours de ce projet je me suis principalement chargé de l'élaboration de la communication entre le logiciel utilisateur et la partie serveur. J'ai écrit tout le code nécessaire à communication entre les utilisateurs et le serveur et assuré le chiffrement en utilisant SSL/TLS via un certificat auto-signé, et l'emploi de RSA 4096. L'interface graphique ainsi que la logique de la gestion des enchères ont été réalisées par les autres membres de l'équipe.</p>

				<p>J'aimerais saluer <a class="lien inclusion_texte" href="https://flothival.github.io/Florent_LABROUSSE-LHUISSIER/"target="_blank" rel="noopener noreferrer">Florent</a> et <a class="lien inclusion_texte" href=""target="_blank" rel="noopener noreferrer">Rayane</a> pour leur investissement dans cette SAÉ.</p>
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
						<th>Technologie</th>
						<th>Utilisation</th>
					</tr>
					<tr>
						<td>C</td>
						<td>Entièreté</td>
					</tr>
				</table>
			</div>
		</div>
		<hr>
		<div class="projet" id="cgj2025">
			<h2>Symphony Of Stars - CGJ 2025</h2>
			<div class="infos-projet">
				<p>Projet parascolaire</p>
				<hr>
				<table class="langages-projet">
					<tr>
						<th>Technologie</th>
						<th>Utilisation</th>
					</tr>
					<tr>
						<td>Java</td>
						<td>Entièreté</td>
					</tr>
					<tr>
						<td>libGDX</td>
						<td>library graphique/audio</td>
					</tr>
				</table>
			</div>

			<img class="illus-projet" src="img/CodeGameJam2.gif">

			<div class="description-projet">
				<p>En Janvier 2025, je faisais partie d'une équipe participant à la Code Game Jam, un événement ouvert à tous les étudiants du public dans la francophonie au cours duquel nous avions une trentaine d'heures pour développer tout un jeu vidéo autour d'un thème. Cette année-là, le thème était "Mélodie à l'infini".</p>

				<p>Nous avons donc décidé de développer le jeu "Symphony of Stars", inspiré très légérement de jeux comme Elite Dangerous ou encore Star Citizen, avec l'ajout d'une dimension musicale pour correspondre au thème.</p>

				<p>Ma participation au jeu portait sur l'élaboration des différents systèmes de coordonnées nécessaires au jeu. En effet, libGDX ne gère pas nativement la 3D, il s'agit d'une librairie sommaire directement basée sur LWJGL (lib derrière minecraft). Cela veut dire que les seules coordonnées que la lib connaisse sont les coordonnées X, Y des pixels dans sa fenêtre.</p>

				<p>J'ai donc élaboré le système de coordonnées 3D permettant de placer les étoiles, un système 3D relatif au vaisseau, ainsi qu'un système de coordonnées polaires 3D pour servir d'intermédiaire à la caméra. De manière plus anecdotiques j'ai aussi codé le calcul de la taille apparente des étoiles. Car ce n'est pas de la vraie 3D dans notre jeu, simplement de la trigonométrie de niveau 3ème-2nde.</p>

				<p>J'ai aussi aidé à réaliser le code de déplacement du vaisseau sur et autour de ses axes. En effet, le vaisseau peut translater et pivoter sur ses 3 axes : X, Y et Z.</p>

				<p>Je tiens à remercier <a class="lien inclusion_texte" href="https://bastienluben.dev/" target="_blank" rel="noopener noreferrer">Bastien</a>, <a class="lien inclusion_texte" href="https://rybois-dev.github.io/portfolio/src/index.html" target="_blank" rel="noopener noreferrer">Clément</a> et <a class="lien inclusion_texte" href="https://dellarolir.github.io/Romain_Dellaroli.github.io/" target="_blank" rel="noopener noreferrer">Romain</a> pour leur participation à la CGJ 2025, en particulier pour la passion investie pendant cette trentaine d'heures.</p>
			</div>
		</div>
	</main>

	<?php require_once "backend/html/footer.html"; ?>
</body>

</html>