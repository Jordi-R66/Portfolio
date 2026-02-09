<?php

/**
 * facadeLogin.php
 * Ce script gère la réception du formulaire de connexion.
 * Il agit comme un contrôleur frontal pour l'authentification.
 */

// On inclut le contrôleur utilisateur.
// Note : Le chemin est relatif à l'emplacement de ce fichier (supposé à la racine avec login.php)
require_once __DIR__ . '/backend/Users/UserController.php';

// 1. Sécurité : On s'assure que la requête est bien de type POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Si quelqu'un tente d'accéder à ce fichier directement via l'URL (GET),
    // on le renvoie vers le formulaire.
    header('Location: https://portfolio.jordi-rocafort.fr/login.php');
    exit;
}

// 2. Récupération et nettoyage des données
// On utilise filter_input pour plus de propreté que $_POST direct.

// Pour le username : on nettoie les caractères spéciaux HTML pour éviter les XSS basiques,
// bien que UserController utilise des requêtes préparées (PDO) qui protègent déjà de l'injection SQL.
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);

// Pour le password : ON NE LE NETTOIE PAS.
// Le mot de passe peut contenir des caractères <, >, &, etc. Si on les modifie,
// le hash ne correspondra plus. On le récupère brut.
$password = $_POST['password'] ?? '';

// 3. Vérification de la présence des champs obligatoires
if (empty($username) || empty($password)) {
    // Si un champ est vide, retour avec erreur (statut 0)
    header('Location: https://portfolio.jordi-rocafort.fr/login.php?statut=0');
    exit;
}

// 4. Appel de la logique métier (UserController)
// La méthode login() s'occupe de vérifier le hash, générer l'UUID, l'insérer en base et poser le cookie.
$loginSuccess = UserController::login($username, $password);

if ($loginSuccess) {
    // Cas SUCCÈS

    // Vérifie si une page cible était demandée
    if (isset($_POST['target']) && !empty($_POST['target'])) {
        $target = $_POST['target'];

        // Petite sécurité : on s'assure que la redirection reste sur le site (commence par /)
        // ou est une page relative simple.
        if (strpos($target, '/') === 0 || strpos($target, 'http') === false) {
            header("Location: " . $target);
            exit;
        }
    }

    // Comportement par défaut (si pas de cible ou cible invalide)
    // Note: Rediriger vers login.php?statut=1 affiche "Succès", mais rediriger vers index.php est souvent mieux.
    header('Location: https://portfolio.jordi-rocafort.fr/login.php?statut=1');
    exit;
} else {
    // Cas ÉCHEC
    header('Location: https://portfolio.jordi-rocafort.fr/login.php?statut=0');
    exit;
}
