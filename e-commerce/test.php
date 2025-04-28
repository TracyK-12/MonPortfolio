<?php
require_once "model/produit.php";
require_once "model/categorie.php";
require_once "model/user.php";

// Création d'un nouvel utilisateur
$user = new User();
$user->setNom("Terrieur")
     ->setPrenom("Jean")
     ->setEmail("jean.terrieur@test.com")
     ->setPassword("password123")
     ->setStatut("admin");

// Insertion de l'utilisateur
$ret = addUser($user);

if ($ret) {
    echo "<p>✅ Utilisateur ajouté avec succès !</p>";

    // Récupération de tous les utilisateurs
    $users = getAllUsers();
    
    echo "<h2>Liste des utilisateurs :</h2><ul>";
    foreach ($users as $u) {
        echo "<li>" . htmlspecialchars($u->getPrenom()) . " " . htmlspecialchars($u->getNom()) . " - " . htmlspecialchars($u->getEmail()) . "</li>";
    }
    echo "</ul>";

} else {
    echo "<p>❌ Erreur lors de l'ajout de l'utilisateur.</p>";
}
?>
