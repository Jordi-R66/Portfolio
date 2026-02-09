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
    // Cas SUCCÈS :
    // On redirige vers login.php avec le statut 1 (Vert).
    // Note : Dans une vraie app, on redirigerait souvent vers "dashboard.php" ou "index.php".
    // Mais je respecte ta logique actuelle qui affiche le message de succès sur login.php.
    header('Location: https://portfolio.jordi-rocafort.fr/login.php?statut=1');
    exit;
} else {
    // Cas ÉCHEC :
    // Mauvais mot de passe ou utilisateur inconnu.
    // On redirige avec le statut 0 (Rouge).
    header('Location: https://portfolio.jordi-rocafort.fr/login.php?statut=0');
    exit;
}