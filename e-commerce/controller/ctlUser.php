<?php
require_once "model/user.php";

// Tous les utilisateurs
function ctlGetAllUsers() {
    $users = getAllUsers();
    require "view/show_allUsers.php";
}

// Ajouter un utilisateur
function ctlAddUser() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = new User();
        $user->setNom($_POST['nom'])
             ->setPrenom($_POST['prenom'])
             ->setEmail($_POST['email'])
             ->setPassword($_POST['password']) // Encrypted dans le modèle
             ->setStatut($_POST['statut']);

        $res = addUser($user);

        if ($res) {
            header("Location: index.php?action=get_all_users");
            exit();
        } else {
            echo "<p class='text-danger text-center'>Erreur lors de l'ajout de l'utilisateur.</p>";
        }
    }

    $user = new User(); //initialise un utilisateur vide
    require "view/user_form.php";
    
}

// Modifier un utilisateur
function ctlUpdateUser() {
    $id = $_GET['id'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user = new User();
        $user->setId($_POST['id'])
             ->setNom($_POST['nom'])
             ->setPrenom($_POST['prenom'])
             ->setEmail($_POST['email'])
             ->setPassword($_POST['password']) // Encrypted dans le modèle
             ->setStatut($_POST['statut']);

        $res = updateUser($user);

        if ($res) {
            header("Location: index.php?action=get_all_users");
            exit();
        } else {
            echo "<p class='text-danger text-center'>Erreur lors de la mise à jour.</p>";
        }
    } else {
        $user = getUserById($id);
        require "view/user_form.php";
    }
}

// Supprimer un utilisateur
function ctlDeleteUser() {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $res = deleteUser((int)$id);
        header("Location: index.php?action=get_all_users");
        exit();
    }
}
?>
