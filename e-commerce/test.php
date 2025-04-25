<?php
require_once "model/produit.php";
require_once "model/categorie.php";
require_once "model/user.php";
$user = new User();
$user->setNom("Terrieur")
     ->setPrenom("Jean")
     ->setEmail("jean.terrieur@test.com")
     ->setPassword("password123")
     ->setStatut("admin");
   
     $ret = addUser($user);
if ($ret) {
   $user= getAllUsers();
}         
 
//     }
?>
