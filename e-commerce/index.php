<?php 

require_once "model/user.php";
require_once "controller/ctlsecurity.php";
require_once "controller/ctlProduct.php";
require_once "controller/ctlCategorie.php";
require_once "controller/ctlUser.php";
require_once "controller/ctlCartController.php";

session_start();
// Page d'accueil
function home() {
    $title = "OPTIMAL";
  
    ob_start();
  ?>
    <div class="home-hero d-flex align-items-center justify-content-center text-center">
      <div class="text-white">
        <h1 class="display-3 fw-bold text-gold mb-3">Bienvenue sur OPTIMAL</h1>
        <p class="lead mb-4">🛍️ La boutique ultime où vous trouverez votre bonheur !</p>
        <a href="index.php?action=get_all_prods" class="btn btn-warning fw-bold px-4 py-2 shadow-sm">Explorer nos produits</a>
      </div>
    </div>
  
    <div class="container py-5">
      <h2 class="text-white text-center mb-4">🔎 Nos Catégories</h2>
      <div class="row g-4">
        <?php foreach (getAllCats() as $cat): ?>
          <div class="col-md-6 col-lg-4">
            <div class="card bg-dark text-white h-100 shadow-lg border-light category-card">
              <div class="card-body">
                <h5 class="card-title text-warning"><?= $cat->getNom() ?></h5>
                <p class="card-text"><?= $cat->getDescription() ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  
    <!-- <style>
      body {
        background: linear-gradient(to right, #2c2c2c, #1f1f1f);
        font-family: 'Segoe UI', sans-serif;
      }
  
      .home-hero {
        min-height: 80vh;
        background: url('https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=1470&q=80') no-repeat center center / cover;
        position: relative;
        padding: 2rem;
      }
  
      .home-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1;
      }
  
      .home-hero > .text-white {
        position: relative;
        z-index: 2;
      }
  
      .text-gold {
        color: #FFD700;
        text-shadow: 1px 1px 10px rgba(255, 215, 0, 0.3);
      }
  
      .category-card {
        transition: transform 0.3s ease;
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(6px);
        border-radius: 1rem;
      }
  
      .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(255, 215, 0, 0.2);
      }
  
      .btn-warning:hover {
        background-color: #e6c200;
      }
    </style> -->
  <?php
    $content = ob_get_clean();
    require "view/template.php";
  }
  

// ROUTEUR PRINCIPAL
if (isset($_GET['action'])) {
    $action = htmlspecialchars($_GET['action']);


    // ********
    // ROUTEUR
    // ********
   
      // Controle d'accès
      // ****************
      if(!getAccess($action)) {
          $action = 'access_denied';
      }

    switch ($action) {
        // Page d'accueil
        case 'home':
            home();
            break;

        // Produits
        case 'get_all_prods':
            ctlGetAllProd();
            break;

        case 'add_prod': //  Gère l'ajout de produit
          if(getAccess($action)) {
            ctlAddProd();
        }
            break;
        case 'update_prod':
                ctlUpdateProd();
                break;
        case 'delete_prod':
                ctlDeleteProd();
                break;

              case 'view_prod':
                cltViewProd();
                break;
              // Gestion du panier
              case 'show_cart':
                ctlShowCart();
                break;

            case 'add_to_cart':
                ctlAddProdCart();
                break;
                
                case 'remove_from_cart':
                  ctlRemoveFromCart();
                  break;
              
              case 'clear_cart':
                  ctlClearCart();
                  break;
              

                // case 'increase_article':
                //   ctlIncreaseProdCart();
                //   break;

               case 'reduce_article':
                ctlReduceProdCart();
                    break;
                  
            

        // Catégories
        case 'get_all_cats':
          if(getAccess($action)) {
            ctlGetAllCats();
        }
            break;

            case 'add_cat':
              if(getAccess($action)) {
                ctlAddCat();
              }
              break;


            // gestion des utilisateurs
            case 'get_all_users':
              if(getAccess('get_all_users')) {
                ctlGetAllUsers();
              }
              else {
                  header('location: index.php?action=home');
              }
              break;
              
              case 'add_user':
                ctlAddUser();
                break;
              
              case 'update_user':
                ctlUpdateUser();
                break;
              
              case 'delete_user':
                ctlDeleteUser();
                break;
              

        // Sécurité
        case 'login':
            ctlLogin();
            break;

        case 'register':
            ctlRegister();
            break;

        case 'logout':
            logout();
            break;
            // 

        // Par défaut, redirection vers l'accueil
        default:
            header("Location: index.php?action=home");
            break;
    }

} else {
    // Si aucune action, rediriger vers la page d'accueil
    header("Location: index.php?action=home");
}
?>
