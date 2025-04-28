<?php
require_once "model/user.php";
require "access.php";

function ctlRegister() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = htmlspecialchars($_POST['name']);
        $prenom = htmlspecialchars($_POST['surname']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $user = new User();
        $user->setNom($nom)
             ->setPrenom($prenom)
             ->setEmail($email)
             ->setPassword($user->encryptPassword($password))
             ->setStatut('client');

        if (addUser($user)) {
            $_SESSION['flash'] = "✅ Inscription réussie. Vous pouvez vous connecter.";
            header('Location: index.php?action=login');
            exit();
        } else {
            $_SESSION['flash'] = "❌ Erreur lors de l'inscription.";
        }
    }
    require 'view/register_form.php';
}

function ctlLogin() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $user = getUserByEmail($email);
        if ($user && $user->checkPassword($password)) {
            $_SESSION['user'] = $user;
            header('Location: index.php?action=home');
            exit();
        } else {
            $_SESSION['flash'] = "❌ Email ou mot de passe incorrect.";
        }
    }
    require 'view/login_form.php';
}

function logout() {
    session_destroy();
    header('Location: index.php?action=home');
}


// security

function getAccess(string $action) {
    global $accessList;
    $ret = false;
    $actionStatus = [];
    
    // Liste des statuts pour l'action demandée
    if(isset($accessList[$action])) {
        // action inconnue
        $actionStatus = $accessList[$action];
    } 
    else {
        return $ret;
    }
  
    if(count($actionStatus) == 0) {
        // Pas de restriction d'accès
        return true;
    }
    elseif (isset($_SESSION['user']) && in_array($_SESSION['user']->getStatut(), $actionStatus)){
        // Accès autorisé
        return true;
    }
    
    // Accès interdit
    return $ret;
  }
  
  function ctlAccessDenied() {
    require "view/access_denied.php";
  
  }
?>
