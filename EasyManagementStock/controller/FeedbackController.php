<?php
require_once "model/feedback.php";
require_once "model/user.php";



/**
 * 👤 Formulaire d'envoi de rapport (employé ou admin)
 */
function ctlSendFeedbackForm() {
    if (!isUserConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    $feedback = new Feedback(); // Pour éviter undefined dans la vue
    $title = "Envoyer un rapport";

    ob_start();
    require "view/feedback_form.php";
    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * 💾 Traitement du rapport soumis (employé ou admin)
 */
function ctlCreateFeedback() {
    if (!isUserConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    $feedback = new Feedback();
    $feedback->setUser_id((int) $_SESSION['user_id']);
    $feedback->setMessage(trim($_POST['message'] ?? ''));
    $feedback->setCreated_at(new DateTime());

    // ✅ Upload de l'image
    if (!empty($_FILES['image']['name'])) {
        $filename = uniqid() . '_' . basename($_FILES['image']['name']);
        $target = "uploads/" . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $feedback->setImage($filename);
        }
    }

    if (!empty($feedback->getMessage())) {
        if (createFeedback($feedback)) {
            header("Location: index.php?action=feedback_success");
            exit;
        } else {
            $error = "❌ Erreur lors de l’envoi du rapport.";
        }
    } else {
        $error = "⚠️ Le message est requis.";
    }

    // Recharge formulaire avec message d'erreur
    $title = "Envoyer un rapport";
    ob_start();
    require "view/feedback_form.php";
    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * ✅ Message de confirmation après envoi
 */
function ctlFeedbackSuccess() {
    $title = "Rapport envoyé";
    ob_start();
    echo "<div class='container py-5'><h3 class='text-success text-center'>✅ Rapport envoyé avec succès.</h3></div>";
    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * 🔐 Liste complète des rapports (admin uniquement)
 */
function ctlGetAllFeedbacks() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    $feedbacks = getAllFeedback();
    $title = "Tous les rapports";

    ob_start();
    require "view/feedback_list.php";
    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * 👤 Affiche uniquement les rapports de l'utilisateur connecté
 */
function ctlGetUserFeedbacks() {
    if (!isUserConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    $userId = (int)$_SESSION['user_id'];
    $feedbacks = getFeedbacksByUserId($userId);
    $title = "Mes rapports";

    ob_start();
    require "view/feedback_list.php";
    $content = ob_get_clean();
    require "view/template.php";
}

function ctlUpdateReportForm() {
    if (!isUserConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header("Location: index.php?action=my_feedbacks");
        exit;
    }

    $feedback = getFeedbackById((int) $_GET['id']);

    // Vérifie que c’est bien l’auteur ou un admin
    if (!$feedback || ($feedback->getUser_id() != $_SESSION['user_id'] && !isAdminConnected())) {
        header("Location: index.php?action=access_denied");
        exit;
    }

    $title = "Modifier un rapport";
    ob_start();
    require "view/feedback_form.php";
    $content = ob_get_clean();
    require "view/template.php";
}

function ctlUpdateReport() {
    if (!isUserConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        header("Location: index.php?action=my_feedbacks");
        exit;
    }

    $feedback = getFeedbackById((int) $_POST['id']);

    if (!$feedback || ($feedback->getUser_id() != $_SESSION['user_id'] && !isAdminConnected())) {
        header("Location: index.php?action=access_denied");
        exit;
    }

    $feedback->setMessage(trim($_POST['message']));
    
    if (!empty($_FILES['image']['name'])) {
        $filename = uniqid() . '_' . basename($_FILES['image']['name']);
        $target = "uploads/" . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $feedback->setImage($filename);
        }
    }

    updateFeedback($feedback);
    header("Location: index.php?action=my_feedbacks");
    exit;
}

function ctlDeleteReport() {
    if (!isUserConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header("Location: index.php?action=my_feedbacks");
        exit;
    }

    $feedback = getFeedbackById((int) $_GET['id']);

    if (!$feedback || ($feedback->getUser_id() != $_SESSION['user_id'] && !isAdminConnected())) {
        header("Location: index.php?action=access_denied");
        exit;
    }

    deleteFeedback((int) $_GET['id']);
    header("Location: index.php?action=my_feedbacks");
    exit;
}

