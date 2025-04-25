<?php 
require_once 'model/produit.php';

/**
 * Initialiser le Panier dans $_SESSION
 */
function createCart(): bool {
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
    return true;
}

/**
 * Supprimer tout le panier
 */
function deleteCart(): void {
    if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
        unset($_SESSION['panier']);
    }
}


/**
 * Affiche le contenu du panier
 */
function ctlShowCart(): void {
    $prods = [];

    if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
        $prods = getProdsFromCart(); // À implémenter dans ton modèle produit
      
    }

    require "view/show_cart.php";
}

/**
 * Ajouter un produit au panier
 */
function ctlAddProdCart(): void {
    if (isset($_GET['id'])) {
        $prodId = (int) $_GET['id'];

        if (function_exists('createCart') && createCart()) {
            if (isset($_SESSION['panier'][$prodId])) {
                $_SESSION['panier'][$prodId]++;
            } else {
                $_SESSION['panier'][$prodId] = 1;
            }

            // On affiche le message SEULEMENT si ce n'est PAS un ajout depuis le panier
            $mode = $_GET['mode'] ?? '';
            if ($mode !== "cart") {
                $_SESSION['flash'] = "✅ Produit ajouté au panier !";
            }
        }
    }

    // Redirection
    $mode = $_GET['mode'] ?? '';
    if ($mode === "cart") {
        header('Location: index.php?action=show_cart');
    } else {
        header('Location: index.php?action=get_all_prods');
    }

    exit();
}




/**
 * Reduire un produit du panier (ou le décrémenter)
 */
function ctlReduceProdCart(): void {
    if (isset($_GET['id'])) {
        $prodId = $_GET['id'];

        if (isset($_SESSION['panier'][$prodId])) {
            $_SESSION['panier'][$prodId]--;

            if ($_SESSION['panier'][$prodId] == 0) {
                unset($_SESSION['panier'][$prodId]);

            }
        } 
    }
    
    header('Location: index.php?action=show_cart');
    exit();
}
// supprimer un produit du panier
function ctlRemoveFromCart() {
    $id = $_GET['id'] ?? null;

    if ($id && isset($_SESSION['panier'][$id])) {
        unset($_SESSION['panier'][$id]);
    }

    header("Location: index.php?action=show_cart");
    exit();
}



// Vider le panier
function ctlClearCart(): void {
    if (isset($_SESSION['panier'])) {
        unset($_SESSION['panier']);
    }

    $_SESSION['flash'] = "Panier vidé avec succès !";
    header("Location: index.php?action=show_cart");
    exit();
}


// 

// Augmenter un produit dans le panier
// function ctlIncreaseProdCart() : void{
//     if (isset($_GET['id'])) {
//         $prodId = $_GET['id'];

//         if (isset($_SESSION['panier'][$prodId])) {
//             $_SESSION['panier'][$prodId]++;
//         } else {
//             $_SESSION['panier'][$prodId] = 1;
//         }
//     }
//     header('Location: index.php?action=show_cart');
//     exit();
// }
?>
