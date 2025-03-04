<?php
include 'config.php'; // Inclure le fichier de connexion

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $campaign_message = $_POST['campaign'];

    // Gestion de l'upload de photo
    $photo = $_FILES['photo']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($photo);

    // Déplacer la photo téléchargée
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        // Requête SQL pour insérer les données
        $sql = "INSERT INTO candidats (first_name, last_name, email, phone, course, campaign_message, photo) 
                VALUES ('$first_name', '$last_name', '$email', '$phone', '$course', '$campaign_message', '$photo')";

        if ($conn->query($sql) === TRUE) {
            echo "Candidat ajouté avec succès.";
        } else {
            echo "Erreur : " . $conn->error;
        }
    } else {
        echo "Erreur lors de l'upload de la photo.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
<div class="text-center mt-4">
    <a href="index.php" class="btn btn-outline-primary"> <i class="fa-solid fa-left-long"></i> Retour à l'accueil</a> 
</div>
</body>
</html>