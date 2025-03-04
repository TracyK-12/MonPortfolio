<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    // Création de l'objet PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Serveur SMTP de Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'tracy.marie149@gmail.com'; // Remplace par ton email Gmail
        $mail->Password = 'YummyProduct2'; // Remplace par ton mot de passe (ou ton App Password si tu as l'authentification à 2 facteurs)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Expéditeur et destinataire
        $mail->setFrom($email, "$nom $prenom");
        $mail->addAddress('tracy.marie149@gmail.com'); // Remplace par ton email de réception
        $mail->addReplyTo($email);

        // Contenu de l'email
        $mail->isHTML(false);
        $mail->Subject = "Nouveau message de $nom $prenom";
        $mail->Body = "Nom: $nom\nPrénom: $prenom\nEmail: $email\nMessage:\n$message";

        // Envoi du mail
        $mail->send();
        echo "<script>alert('Message envoyé avec succès !'); window.location.href='index.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Erreur lors de l\'envoi du message: {$mail->ErrorInfo}'); window.history.back();</script>";
    }
}
?>
