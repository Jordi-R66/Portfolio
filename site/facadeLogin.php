<?php

require_once __DIR__ . '/backend/Users/UserController.php';

$requestMethod = $_SERVER['REQUEST_METHOD'] ?? '';
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$password = $_POST['password'] ?? '';
$targetParam = $_POST['target'] ?? '';

$redirectUrl = "https://portfolio.jordi-rocafort.fr/login.php?statut=0";

if ($requestMethod === 'POST' && !empty($username) && !empty($password)) {
    $loginSuccess = UserController::login($username, $password);

    if ($loginSuccess === true) {
        $redirectUrl = "https://portfolio.jordi-rocafort.fr/login.php?statut=1";

        if (!empty($targetParam)) {
            if (strpos($targetParam, '/') === 0 || strpos($targetParam, 'http') === false) {
                $redirectUrl = $targetParam;
            }
        }
    }
}

if ($requestMethod !== 'POST') {
    $redirectUrl = "https://portfolio.jordi-rocafort.fr/login.php";
}

header("Location: " . $redirectUrl);
exit();
