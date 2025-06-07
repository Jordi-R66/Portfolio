<style>
	.centrer {
		text-align: center;
	}

	img {
		display: block;
		margin: 0 auto;
	}
</style>

<h1 class="centrer">Portfolio</h1>
<p class="centrer">Jordi Rocafort | S4 - 2024-2025</p>

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

<p class="centrer" style="font-style: italic;">En raison d'un changement de PC et d'un premier portfolio peu rempli je n'ai aucune archive du premier semestre</p>

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
<img src="image-1.png">

La SAE 1.02 portait quant à elle sur une étude mathématique du jeu, en particulier sur la comparaison d'algorithmes pour aborder le jeu. Elle mobilisait donc la compétence 2 avec notamment la R1.07 (Maths Discrètes).

<img src="image-2.png">

<h5 class="centrer">SAÉ 1.03 - Installation d'un poste</h5>

Au cours de cette SAÉ nous devions en binôme réaliser l'installation sur machine virtuelle ainsi qu'en dual boot d'une distribution linux de notre choix, notre choix s'était porté sur Linux Mint.

Cette SAÉ avait pour but de mobiliser la compétence 3 et s'associait à la R1.04 (Intro Systèmes) et la R1.10 (Anglais)

<img src="image.png">
