<style>
	.centrer {
		text-align: center;
	}

	img.centrerImg {
		display: block;
		margin: 0 auto;
	}
</style>

<h1 class="centrer">Portfolio</h1>
<p class="centrer">Jordi Rocafort | S4 - 2024-2025</p>
<p class="centrer" style="font-style: italic;">Bonne chance pour lire toutes les pages</p>

<h2 class="centrer">Rappel des compétences</h2>

- **Compétence 1** : Réaliser un développement d'application
	- **SP 1** : Élaborer une application informatique
	- **SP 2** : Faire évoluer une application informatique
	- **SP 3** : Maintenir en conditions opérationnelles une application informatique

	- **AC 1** : Implémenter des conceptions simples
	- **AC 2** : Élaborer des conceptions simples
	- **AC 3** : Faire des essais et évaluer leurs résultats en regard des spécifications
	- **AC 4** : Développer des interfaces utilisateurs
- **Compétence 2** : Optimiser des applications
	- **SP 1** : Améliorer les performances des programmes dans des contextes contraints
	- **SP 2** : Limiter l'impact environnemental d'une applications informatique
	- **SP 3** : Mettre en place des applications informatiques adaptées et innovantes

	- **AC 1** : Analyser un problème avec méthode
	- **AC 2** : Comparer des algorithmes pour des problèmes classiques
	- **AC 3** : Formaliser et mettre en œuvre des outils mathématiques pour l'informatique
- **Compétence 3** : Administrer des systèmes informatiques communicants complexes
	- **SP 1** : Déployer une nouvelle architecture technique
	- **SP 2** : Améliorer une infrastructure existante
	- **SP 3** : Sécuriser les applications et les services

	- **AC 1** : Identifier les différents composants d'un système numérique
	- **AC 2** : Utiliser les fonctionnalités de base d'un système multitâches / multiutilisateurs
	- **AC 3** : Installer et configurer un système d'exploitation et des outils de développement
	- **AC 4** : Configurer un poste de travail dans un réseau d'entreprise
- **Compétence 4** : Gérer des données de l'information
	- **SP 1** : Lancer un nouveau projet
	- **SP 2** : Sécuriser des données
	- **SP 3** : Exploiter des données pour la prise de décisions

	- **AC 1** : Mettre à jour et interroger une base de données relationnelle
	- **AC 2** : Visualiser des données
	- **AC 3** : Concevoir une base de données relationnelle à partir d'un cahier des charges
- **Compétence 5** : Conduire un projet
	- **SP 1** : Lancer un nouveau projet
	- **SP 2** : Piloter le maintien d'un projet en conditions opérationnelles
	- **SP 3** : Faire évoluer un système d'information

	- **AC 1** : Appréhender les besoins du client et de l'utilisateur
	- **AC 2** : Mettre en place les outils de gestion de projet
	- **AC 3** : Identifier les acteurs et les différentes phases d'un cycle de développement
- **Compétence 6** : Collaborer au sein d'une équipe informatique
	- **SP 1** : Lancer un nouveau projet
	- **SP 2** : Organiser son travail en relation avec celui de son équipe
	- **SP 3** : Élaborer, gérer et transmettre de l'information

	- **AC 1** : Appréhender l'écosystème numérique
	- **AC 2** : Découvrir les aptitudes requises selon les différents secteurs informatiques
	- **AC 3** : Identifier les status, les fonctions et les rôles de chaque membre d'une équipe pluridisciplinaire
	- **AC 4** : Acquérir les compétences interpersonnelles pour travailler en équipe

*AC : Apprentissage critique* et 
*SP : Situations professionnelles*

| Compétence | DACS        | IAMSI       | RACDV       |
|:----------:|:-----------:|:-----------:|:-----------:|
| C1         | **Majeure** | **Majeure** | **Majeure** |
| C2         | Mineure     | Mineure     | **Majeure** |
| C3         | **Majeure** | Mineure     | Mineure     |
| C4         | Mineure     | Mineure     | Mineure     |
| C5         | Mineure     | **Majeure** | Mineure     |
| C6         | **Majeure** | **Majeure** | **Majeure** |

---

<h2 class="centrer">Première Année</h2>

<h3 class="centrer">Premier Semestre</h3>

<p class="centrer" style="font-style: italic;">En raison d'un changement de PC et d'un premier portfolio peu rempli je n'ai plus certaines archives du premier semestre</p>

<h4 class="centrer">SAÉs</h4>

<h5 class="centrer">SAÉ 1.01 & 1.02 - Développement AKA 421</h5>

Les SAÉs 1.01 et 1.02 ont été réunies sous une SAÉ : le jeu du 421 qui se joue avec 3 dés et entre au moins 2 joueurs.

Elles étaient toutes les deux à réaliser en binôme.

La 1.01 portait sur la partie développement du jeu et mobilisait donc la compétence 1, elle était divisée en 3 livrables. Voici des extraits de code, plusieurs fonctions devaient être réalisées par nous-même

```java
public static void ordonnerResultat(int[] resultat) {
	// Il s'agit d'une implémentation de Bubble Sort
	// (certes c'est du O(n^2) mais pour 3 éléments ça va)
	int n = resultat.length;

	boolean ValeurEchangée;

	do {
		ValeurEchangée = false;

		for (int i = 0; i < (n - 1); i++) {
			if (resultat[i] > resultat[i + 1]) {
				echangerElementsTableau(resultat, i, i + 1);
				ValeurEchangée = true;
			}
		}

		n--;
	} while (ValeurEchangée);
}
```

```java
public static void genererFiguresEtPoints(int[][] figures, int[] pointsFigures) {
	int[][] figuresSpeciales = new int[][] {
		{ 3, 2, 1 }, { 4, 3, 2 }, { 5, 4, 3 }, { 6, 5, 4 },
		{ 2, 1, 1 }, { 2, 2, 2 }, { 3, 1, 1 }, { 3, 3, 3 },
		{ 4, 1, 1 }, { 4, 4, 4 }, { 5, 1, 1 }, { 5, 5, 5 },
		{ 6, 1, 1 }, { 6, 6, 6 }, { 1, 1, 1 }, { 4, 2, 1 }
	};

	int[] pointFiguresSpeciales = new int[] { 
		2, 2, 2, 2, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 11};

	int i = 0;

	for (int x1 = 1; x1 <= 6; x1++) {
		for (int x2 = 1; x2 <= x1; x2++) {
			for (int x3 = 1; x3 <= x2; x3++) {
				int[] r = new int[] { x1, x2, x3 };
				ordonnerResultatDec(r);

				if (!contientFigureTabFigures(r, figuresSpeciales)) {
					figures[i] = r;
					i++;
				}
			}
		}
	}

	for (int j = 0; j < figuresSpeciales.length; j++) {
		figures[i + j] = figuresSpeciales[j];
	}

	for (i = 0; i < figures.length; i++) {
		for (int j = 0; j < figuresSpeciales.length; j++) {
			if (figuresIdentiques(figures[i], figuresSpeciales[j])) {
				pointsFigures[i] = pointFiguresSpeciales[j];
			}
		}

		if (pointsFigures[i] == 0) {
			pointsFigures[i] = 1;
		}
	}
}
```

<img class="centrerImg" src="image-1.png">

La SAE 1.02 portait quant à elle sur une étude mathématique du jeu, en particulier sur la comparaison d'algorithmes pour aborder le jeu. Elle mobilisait donc la compétence 2 avec notamment la R1.07 (Maths Discrètes).

<img class="centrerImg" src="image-2.png">

<h5 class="centrer">SAÉ 1.03 - Installation d'un poste</h5>

Au cours de cette SAÉ nous devions en binôme réaliser l'installation sur machine virtuelle ainsi qu'en dual boot d'une distribution linux de notre choix, notre choix s'était porté sur Linux Mint.

Cette SAÉ avait pour but de mobiliser la compétence 3 et s'associait à la R1.04 (Intro Systèmes) et la R1.10 (Anglais)

<img class="centrerImg" src="image.png">

<h5 class="centrer">SAÉ 1.04 - Création d'une base de données</h5>

Pour cette SAÉ de BDD (R1.05) portant sur la compétence 4 nous étions par groupes de 4, nous entrions dans le rôle d'une entreprise qui construisait une base de données. Dans notre cas nous étions un studio de jeux vidéos, la base de données contenait donc des villes, des prix, des catégories, des employés et beaucoup d'autres informations.

Nous devions fournir un schéma Entité/Association, un jeu de données, des scripts de création des tables et de chargement des données, des questions formulées comme des exercices se basant à la fois sur notre schéma et sur notre jeu de données.

Nous devions aussi évaluer le rendu d'un autre groupe.

<img class="centrerImg" src="image-3.png">

<h5 class="centrer">SAÉ 1.05 - Recueil de besoins</h5>

Pour cette SAÉ nous avions la tâche de recueillir les besoins d'une autre équipe dans l'optique de réaliser la communication autour d'un escape game dont ils ont choisi le thème.

Nous devions d'abord choisir parmi 5 propositions aléatoires qui nous étaient données via ChallengeMe. On les a évalué et ensuite on a choisi celle dont on allait faire la communication web, l'affiche/flyer ainsi que le pitch des énigmes.

Nous avions proposé un Escape Game sur le thème Star Trek mais je pense pas qu'un groupe en ai fait la communication.

On a choisi un Escape Game dans lequel un jet privé était détourné par des hackers qui allait faire s'écraser l'avion, il fallait donc s'échapper en sautant en parachute. Le sujet nous inspirait plus que les autres et avec mes connaissances de passionné de l'aéronautique je pouvais donc apporter des connaissances techniques aux épreuves. Déjà que l'équipe qui a eu l'idée du thème avait glissé quelques détails propres au domaine.

Cette SAÉ portait sur la compétence 5, la communication (R1.11) et le développement web (R1.02).

Voilà une capture d'écran du site. Malheureusement je n'ai plus le flyer.

<img class="centrerImg" src="image-4.png" height="50%">

<br>

<p class="centrer">Voilà la note que j'ai eu à cette SAÉ</p>

<br>

<img class="centrerImg" src="image-5.png">

<h5 class="centrer">SAÉ 1.06 - Controverse</h5>

Il s'agit là de la SAÉ de communication (R1.11) elle combinait aussi l'économie durable et numérique (R1.09) et concernait la compétence 6, nous devions choisir une controverse liée aux algorithmes utilisant les statistiques pour influencer les choix

Dans notre cas c'était sur les décisions en Ressources Humaines et l'impact des décisions prises via ces algorithmes sur la vie des individus.

Nous devions réaliser un poster scientifique sur la controverse ainsi qu'un site web.

<img class="centrerImg" src="image-6.png">

---

<h4 class="centrer">Les résultats du semestre</h4>

<img src="image-7.png">

<img src="image-8.png">

<img src="image-9.png">

<img src="image-10.png">
<img src="image-11.png">

<img src="image-12.png">

<img src="image-13.png">

À la fin du semestre 1 je visais le parcours RACDV pour lequel les compétences majeures sont C1, C2 et C6.

Au vu de mes résultats dans mes compétences je m'en sortais partout mais c'était pas non plus formidable. Je devais donc améliorer mes notes mais dans l'ensemble ça allait.

---

<h3 class="centrer">Deuxième Semestre</h3>

