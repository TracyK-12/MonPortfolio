<?php 

require_once "model/produit.php";




// Tous les produits
function ctlGetAllProd() {
    $prods = getAllProds();

    foreach ($prods as $p) {
        // Injecte le nom de la catégorie
        $cat = getCatById($p->getCategorieId());
        if ($cat) {
            $p->setCategorieName($cat->getNom());
        }

        // Corrige le chemin de l’image si besoin
        if ($p->getImage()) {
            $p->setImage('uploads/' . basename($p->getImage()));
        }
    }

    require "view/show_prods.php";
}


// Ajouter un produit
function ctlAddProd() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $categorie = (int) $_POST['categorie'];
        $prix = (float) $_POST['prix'];
        $imagePath = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $filename = uniqid() . '_' . basename($_FILES['image']['name']);
            $uploadPath = $uploadDir . $filename;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
            $imagePath = $uploadPath;
        }

        $prod = new Produit();
        $prod->setNom($nom)
             ->setDescription($description)
             ->setCategorieId($categorie)
             ->setPrix($prix)
             ->setImage($imagePath);

        $res = addProd($prod);

        if ($res) {
            header("Location: index.php?action=get_all_prods");
            exit();
        } else {
            echo "<p class='text-danger text-center'>Erreur lors de l'ajout du produit.</p>";
        }
    }

    $cats = getAllCats();
    require "view/add_product.php";
}

// Modifier un produit
function ctlUpdateProd() {
    $id = $_GET['id'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $categorie = (int) $_POST['categorie'];
        $prix = (float) $_POST['prix'];

        $prod = getProdById($id);
        $imagePath = $prod->getImage(); // conserver l'image actuelle si non modifiée

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $filename = uniqid() . '_' . basename($_FILES['image']['name']);
            $uploadPath = $uploadDir . $filename;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
            $imagePath = $uploadPath;
        }

        $prod->setNom($nom)
             ->setDescription($description)
             ->setCategorieId($categorie)
             ->setPrix($prix)
             ->setImage($imagePath);

        $res = updateProd($prod);

        if ($res) {
            header("Location: index.php?action=get_all_prods");
            exit();
        } else {
            echo "<p class='text-danger text-center'>Erreur lors de la mise à jour du produit.</p>";
        }
    } else {
        $prod = getProdById($id);
        $cats = getAllCats();
        require "view/update_product.php";
    }
}

// Supprimer un produit
function ctlDeleteProd() {
    $id = $_GET['id'] ?? null;
    if ($id) {
        deleteProd((int)$id);
        header("Location: index.php?action=get_all_prods");
        exit();
    }
}

function getProdsFromCart(){
    $prods = [];

    // Extraire du panier la liste des produits (clé)
    $prodIds = array_keys($_SESSION['panier']);
    if(!empty($prodIds)) {

        // Récupérer le détails des produits du panier
        $prods = getSelectedProds($prodIds);
        return $prods;
    }

}
// visusaliser un produit
function cltViewProd(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    if (!$id) {
        header('Location: index.php?action=get_all_prods');
        exit;
    }
    // Récupère le produit et sa catégorie
    $prod = getProdById($id);
    $cat  = getCatById($prod->getCategorieId());
    if ($cat) {
        $prod->setCategorieName($cat->getNom());
    }
    require 'view/view_prod.php';
}


// 

// function ctlAddToCart() {
//     $id = $_GET['id'] ?? null;
    
//     if (!$id) {
//         header("Location: index.php?action=get_all_prods");
//         exit();
//     }

//     // Si utilisateur NON connecté
//     if (!isset($_SESSION['user'])) {
//         $_SESSION['flash'] = "Veuillez vous connecter pour poursuivre votre achat.";
//         header("Location: index.php?action=login");
//         exit();
//     }

//     // Ajouter au panier
//     if (!isset($_SESSION['cart'])) {
//         $_SESSION['cart'] = [];
//     }

//     $_SESSION['cart'][] = (int)$id;
//     $_SESSION['flash'] = "Produit ajouté au panier.";
//     header("Location: index.php?action=get_all_prods");
//     exit();
// }

?>
