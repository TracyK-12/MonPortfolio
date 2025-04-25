<?php
require_once "model/user.php";
require "access.php";

function ctlLogin() {
  if (isset($_POST['email'], $_POST['password'])) {
      $email = htmlspecialchars($_POST['email']);
      $password = htmlspecialchars($_POST['password']);

      $user = getUserByEmail($email);
      if ($user && $user->checkPassword($password)) {
          $_SESSION['user'] = $user;
          header("Location: index.php?action=home");
          exit();
      } else {
          $_SESSION['flash'] = "Identifiants incorrects.";
      }
  }

  require "view/login_form.php";
}


function logout(){
   unset($_SESSION['user']);
   setcookie('PHPSESSID', '', time() - 3600, '/');
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
