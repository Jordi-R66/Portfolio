<!DOCTYPE html>
<html>

<head>
	<?php require_once "backend/html/head.html"; ?>
	<meta name="description" content="Portfolio de Jordi Rocafort - Étudiant en Informatique (DACS) passionné par l'aérospatial et le développement bas niveau.">
	<link href="css/index.css" rel="stylesheet" type="text/css">
	<title>Jordi Rocafort - Accueil</title>
</head>

<body>
	<?php require_once "backend/html/header.html"; ?>

	<main>
		<section class="hero-section">
			<div class="hero-content">
				<h1>Jordi <span class="highlight">Rocafort</span></h1>
				<p class="subtitle">Étudiant BUT Informatique • Parcours DACS</p>
				<p class="intro-text">
					Passionné par le développement bas niveau, la simulation scientifique et l'aérospatial.
					Je conçois des solutions robustes pour comprendre ce qui se passe "sous le capot".
				</p>
				<div class="hero-buttons">
					<a href="projets.php" class="btn btn-primary">Voir mes projets</a>
					<a href="moi.php" class="btn btn-secondary">En savoir plus sur moi</a>
				</div>
			</div>
		</section>

		<section class="cards-section">

			<a href="projets.php" class="nav-card">
				<div class="card-icon">🚀</div>
				<h3>Mes Projets</h3>
				<p>De la simulation orbitale (TLE) au moteur de jeu 3D, découvrez mes réalisations techniques.</p>
				<span class="card-link">Explorer &rarr;</span>
			</a>

			<a href="moi.php" class="nav-card">
				<div class="card-icon">👨‍💻</div>
				<h3>Mon Profil</h3>
				<p>Mon parcours, mes compétences techniques (C, Java, Système) et ma philosophie de développeur.</p>
				<span class="card-link">Découvrir &rarr;</span>
			</a>

			<a href="contact.php" class="nav-card">
				<div class="card-icon">📬</div>
				<h3>Me Contacter</h3>
				<p>Une question technique, une proposition de stage ou simplement envie d'échanger ?</p>
				<span class="card-link">Envoyer un message &rarr;</span>
			</a>

		</section>
	</main>

	<?php require_once "backend/html/footer.html"; ?>
</body>

</html>