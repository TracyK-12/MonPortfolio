<?php

require_once "model/user.php";
require_once "model/article.php";
require_once "model/feedback.php";
require_once "model/categorie.php"; // Modèle Catégorie
require_once "model/dashboard.php"; // Modèle Dashboard

// Contrôleurs
require_once "controller/AuthController.php";
require_once "controller/UserController.php";
require_once "controller/ArticleController.php";
require_once "controller/FeedbackController.php";
require_once "controller/CategorieController.php"; // Modèle Catégorie
require_once "controller/DashboardController.php"; // Modèle Dashboard
require_once "controller/SecurityController.php"; // getAccess()
require_once "access.php"; // contient $accessList

// ✅ Ensuite démarrer la session
session_start();

// ======== Page d'accueil sécurisée ========
function home() {
  if (!isset($_SESSION['user_id'])) {
      header("Location: index.php?action=login");
      exit;
  }

  $user = getUserById($_SESSION['user_id']);
  if (!$user) {
      header("Location: index.php?action=logout");
      exit;
  }

  $title = "EASY MANAGEMENT STOCK";
  ob_start();
  ?>
  
  <style>
    .hero-banner {
      background: linear-gradient(to bottom, #B35028, #a23c1f);
      color: white;
      padding: 70px 20px;
      text-align: center;
      background-image: url('public/images/EMSLogo.png');
      background-repeat: no-repeat;
      background-position: center right;
      background-size: contain;
      border-radius: 15px;
      margin-top: 20px;
      position: relative;
      overflow: hidden;
    }

    .hero-banner::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.4);
    }

    .hero-banner .content {
      position: relative;
      z-index: 1;
      max-width: 800px;
      margin: 0 auto;
    }

    .hero-banner h1 {
      font-size: 2.8rem;
      font-weight: 800;
      text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }

    .feature-box {
      background-color: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      height: 100%;
    }

    .feature-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .feature-box i {
      color: #B35028;
    }

    .section-features h5 {
      font-weight: bold;
      color: #B35028;
    }

    .section-features p {
      color: #555;
      font-size: 0.95rem;
    }
  </style>

  <div class="hero-banner mb-5">
    <div class="content">
      <img src="public/images/EMSLogo.png" alt="Logo" class="mb-4" style="max-width: 180px; border-radius: 8px;">
      <h1>Bienvenue sur <br> EASY MANAGEMENT STOCK</h1>
      <p class="lead">Un outil moderne pour optimiser la gestion de vos stocks, articles et rapports.</p>
    </div>
  </div>

  <div class="container section-features py-5">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature-box text-center">
          <i class="fa-solid fa-file-alt fa-2x mb-3"></i>
          <h5>Gestion de rapports</h5>
          <p>Les employés peuvent soumettre leurs rapports quotidiens avec pièces jointes et commentaires détaillés.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="feature-box text-center">
          <i class="fa-solid fa-users-gear fa-2x mb-3"></i>
          <h5>Contrôle d'accès</h5>
          <p>Accès sécurisés pour les employés et les administrateurs selon leurs rôles dans l'entreprise.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="feature-box text-center">
          <i class="fa-solid fa-boxes-stacked fa-2x mb-3"></i>
          <h5>Suivi des stocks</h5>
          <p>Visualisez l’état des articles, recevez des alertes en cas de seuil critique ou de rupture.</p>
        </div>
      </div>
    </div>
  </div>

  <?php
  $content = ob_get_clean();
  require "view/template.php";
}


// ======== ROUTEUR PRINCIPAL ========
$action = $_GET['action'] ?? 'home';

// 🔐 Vérification des droits d'accès
if (!getAccess($action)) {
    $action = 'access_denied';
}

switch ($action) {

    // ========== Accueil ==========
    case 'home':
        home();
        break;

    // ========== Utilisateurs ==========
    case 'get_all_users':
        ctlGetAllUsers();
        break;
    case 'add_user_form':
        ctlAddUserForm();
        break;
    case 'create_user':
        ctlCreateUser();
        break;
    case 'update_user_form':
        ctlUpdateUserForm();
        break;
    case 'update_user':
        ctlUpdateUser();
        break;
    case 'delete_user':
        ctlDeleteUser();
        break;

    // ========== Articles ==========
    case 'get_all_articles':
        ctlGetAllArticles();
        break;
    case 'add_article_form':
        ctlAddArticleForm();
        break;
    case 'create_article':
        ctlCreateArticle();
        break;
    case 'update_article_form':
        ctlUpdateArticleForm();
        break;
    case 'update_article':
        ctlUpdateArticle();
        break;
    case 'delete_article':
        ctlDeleteArticle();
        break;

    // ========== Feedback (rapports) ==========
    case 'get_all_feedbacks':
        ctlGetAllFeedbacks();
        break;
    case 'my_feedbacks':
        ctlGetUserFeedbacks();
        break;
    case 'add_report_form':
        ctlSendFeedbackForm();
        break;
    case 'create_feedback':
        ctlCreateFeedback();
        break;
    case 'feedback_success':
        ctlFeedbackSuccess();
        break;
    case 'delete_report':
        ctlDeleteReport();
        break;

        // ========= Catégories ==========

        case 'get_all_categories':
          ctlGetAllCats();
          break;
      case 'add_categorie_form':
          ctlAddCatForm();
          break;
      case 'create_categorie':
        ctlCreateCat(); 
          break;
      case 'update_categorie_form':
          ctlUpdateCatForm();
          break;
      case 'update_categorie':
          ctlUpdateCat();
          break;
      case 'delete_categorie':
          ctlDeleteCat();
          break;
          // ========= Dashboard ==========
          case 'dashboard':
            ctlDashboard();
            break;
        
      
    // ========== Authentification ==========
    case 'login':
        ctlLogin();
        break;
    case 'logout':
        logout();
        break;

    // ========== Accès refusé ==========
    case 'access_denied':
        $title = "Accès refusé";
        ob_start();
        echo "<div class='container py-5'><h3 class='text-danger text-center'>⛔ Accès non autorisé.</h3></div>";
        $content = ob_get_clean();
        require "view/template.php";
        break;

    // ========== Par défaut ==========
    default:
        header("Location: index.php?action=home");
        break;
}
?>
