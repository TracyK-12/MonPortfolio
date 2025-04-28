<?php
require_once "model/user.php";

/**
 * Vérifie si l’utilisateur est connecté et admin
 */
function isAdminConnected(): bool {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user_id'])) return false;

    $user = getUserById($_SESSION['user_id']);
    return $user && $user->getStatus() === 'admin' ;
}
// 🔐 Vérifie si un utilisateur (admin ou employé) est connecté
function isUserConnected(): bool {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user_id'])) return false;
    $user = getUserById($_SESSION['user_id']);
    return $user !== null;
}

/**
 * 🎯 Affiche tous les utilisateurs (admin uniquement)
 */
function ctlGetAllUsers() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    $users = getAllUsers();
    $title = "Liste des utilisateurs";

    ob_start();
    require "view/user_list.php";
    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * 📝 Formulaire d’ajout d’un utilisateur
 */
function ctlAddUserForm() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    $user = new User(); // utilisateur vide pour préremplir le formulaire
    $title = "Ajouter un utilisateur";
    ob_start();
    require "view/user_add.php";
    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * ➕ Crée un utilisateur (admin)
 */
function ctlCreateUser() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    // Vérifie que tous les champs requis sont remplis
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['status'])) {
        $user = new User();
        $user->setName(htmlspecialchars(trim($_POST['name'])))
             ->setEmail(filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL))
             ->encryptPassword(trim($_POST['password']))
             ->setStatus(htmlspecialchars(trim($_POST['status'])))
             ->setCreated_at(new DateTime());

        if (createUser($user)) {
            header("Location: index.php?action=get_all_users");
            exit;
        } else {
            $error = "❌ Une erreur est survenue lors de l'ajout.";
        }
    } else {
        $error = "⚠️ Tous les champs sont obligatoires.";
    }

    $title = "Ajouter un utilisateur";
    $user = new User();
    ob_start();
    require "view/user_add.php";
    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * 📝 Formulaire de modification d’un utilisateur
 */
function ctlUpdateUserForm() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header("Location: index.php?action=get_all_users");
        exit;
    }

    $user = getUserById((int)$_GET['id']);

    if (!$user) {
        header("Location: index.php?action=get_all_users");
        exit;
    }

    $title = "Modifier un utilisateur";
    ob_start();
    require "view/user_add.php";
    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * ✅ Traitement de la mise à jour d’un utilisateur
 */

/**
 * ✅ Enregistre les modifications d’un utilisateur
 */
function ctlUpdateUser() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $user = getUserById((int)$_POST['id']);

        if ($user) {
            $user->setName(trim($_POST['name']));
            $user->setEmail(trim($_POST['email']));
            $user->setStatus(trim($_POST['status']));
            $user->setCreated_at(new DateTime()); // Facultatif : ou garder l'ancienne date

            // Mot de passe (uniquement s’il est rempli)
            if (!empty($_POST['password'])) {
                $user->encryptPassword($_POST['password']);
            }

            // Image de profil
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['profile_image']['tmp_name'];
                $original_name = basename($_FILES['profile_image']['name']);
                $extension = pathinfo($original_name, PATHINFO_EXTENSION);
                $filename = uniqid() . "." . strtolower($extension);

                // Crée le dossier s’il n’existe pas
                if (!is_dir('uploads') && !mkdir('uploads', 0777, true) && !is_dir('uploads')) {
                    throw new RuntimeException('Failed to create uploads directory.');
                }

                move_uploaded_file($tmp_name, "uploads/" . $filename);
                $user->setProfile_image($filename);
            }

            if (updateUser($user)) {
                header("Location: index.php?action=get_all_users");
                exit;
            } else {
                $error = "❌ Erreur lors de la mise à jour.";
            }
        }
    }

    // En cas d'erreur, recharger le formulaire
    $title = "Modifier un utilisateur";
    ob_start();
    require "view/user_add.php";
    $content = ob_get_clean();
    require "view/template.php";
}


/**
 * 🗑️ Supprimer un utilisateur
 */
function ctlDeleteUser() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }
        if (!deleteUser((int)$_GET['id'])) {
            $error = "❌ Erreur lors de la suppression.";
        }
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        deleteUser((int)$_GET['id']);
    }

    header("Location: index.php?action=get_all_users");
    exit;
}
