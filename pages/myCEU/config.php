<?php
// Paramètres de connexion à la base de données
$host = "localhost";       // Serveur MySQL (par défaut : localhost)
$username = "root";        // Nom d'utilisateur MySQL (par défaut : root pour WAMP)
$password = "";            // Mot de passe MySQL (vide par défaut pour WAMP)
$dbname = "ceu";           // Nom de la base de données que vous avez créée (par exemple : ceu)

// Connexion à la base de données
$conn = new mysqli($host, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Optionnel : pour afficher un message si la connexion est réussie
// echo "Connexion à la base de données réussie !";
?>
