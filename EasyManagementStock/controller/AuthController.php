<?php
require_once "model/user.php";

function ctlLogin() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim($_POST['password']);

        $user = getUserByEmail($email);

        if ($user && $user instanceof User && $user->checkPassword($password)) {
            // ✅ Stocker l'utilisateur complet pour gérer les rôles
            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user->getId(); // utile pour les feedbacks, etc.

            header('Location: index.php?action=home');
            exit;
        } else {
            $error = "❌ Identifiants incorrects.";
        }
    }

    $title = "Connexion";
    ob_start();
    require "view/login.php";
    $content = ob_get_clean();
    require "view/template_guest.php";
}

function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Supprimer toutes les données utilisateur de la session
    unset($_SESSION['nishuser'], $_SESSION['user_id']);
    session_destroy();
    setcookie('PHPSESSID', '', time() - 3600, '/');

    header("Location: index.php?action=login");
    exit;
}
