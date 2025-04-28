<?php
require_once "model/dbaccess.php";

$ctx = dbConnect();

if ($ctx) {
    echo "✅ Connexion réussie à la base de données !";
} else {
    echo "❌ Connexion échouée.";
}

// Forçons un test direct de connexion PDO brut
try {
    $pdo = new PDO('mysql:host=localhost;dbname=data_store;charset=utf8', 'root', '');
    echo "✅ Connexion directe PDO OK";
} catch (PDOException $e) {
    echo "❌ Erreur PDO : " . $e->getMessage();
}
?>
