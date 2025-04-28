<?php
require_once "model/categorie.php";

// ✅ Lister les catégories
function ctlGetAllCats() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $categories = getAllCategories();
    $title = "Liste des catégories";

    ob_start();
    require "view/categorie_list.php";
    $content = ob_get_clean();
    require "view/template.php";
}

// ➕ Formulaire d'ajout
function ctlAddCatForm() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    $categorie = new Categorie();
    $title = "Ajouter une catégorie";
    ob_start();
    require "view/categorie_add.php";
    $content = ob_get_clean();
    require "view/template.php";
}

// 💾 Création
function ctlCreateCat() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (!empty($_POST['name']) && !empty($_POST['description'])) {
        $categorie = new Categorie();
        $categorie->setName(trim($_POST['name']))
                  ->setDescription(trim($_POST['description']))
                  ->setCreated_at((new DateTime())->format('Y-m-d H:i:s'));


        if (createCategorie($categorie)) {
            header("Location: index.php?action=get_all_categories");
            exit;
        } else {
            $error = "❌ Erreur lors de la création de la catégorie.";
        }
    } else {
        $error = "⚠️ Veuillez remplir tous les champs.";
    }

    $title = "Ajouter une catégorie";
    ob_start();
    require "view/categorie_add.php";
    $content = ob_get_clean();
    require "view/template.php";
}

// ✏️ Formulaire de modification
function ctlUpdateCatForm() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header("Location: index.php?action=categorie_list");
        exit;
    }

    $categorie = getCategorieById((int)$_GET['id']);
    if (!$categorie) {
        header("Location: index.php?action=categorie_list");
        exit;
    }

    $title = "Modifier la catégorie";
    ob_start();
    require "view/categorie_edit.php";
    $content = ob_get_clean();
    require "view/template.php";
}

// 📌 Traitement modification
function ctlUpdateCat() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        header("Location: index.php?action=categorie_list");
        exit;
    }

    $categorie = getCategorieById((int)$_POST['id']);
    if (!$categorie) {
        header("Location: index.php?action=categorie_list");
        exit;
    }

    if (!empty($_POST['name']) && !empty($_POST['description'])) {
        $categorie->setName(trim($_POST['name']))
                  ->setDescription(trim($_POST['description']));

        if (updateCategorie($categorie)) {
            header("Location: index.php?action=categorie_list");
            exit;
        } else {
            $error = "❌ Erreur lors de la mise à jour.";
        }
    } else {
        $error = "⚠️ Tous les champs sont requis.";
    }

    $title = "Modifier la catégorie";
    ob_start();
    require "view/categorie_edit.php";
    $content = ob_get_clean();
    require "view/template.php";
}

// 🗑️ Suppression
function ctlDeleteCat() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header("Location: index.php?action=get_all_categories");
        exit;
    }

    if (deleteCategorie((int)$_GET['id'])) {
        header("Location: index.php?action=get_all_categories");
        exit;
    } else {
        $error = "❌ Erreur lors de la suppression.";
        $categories = getAllCategories(); // Pour recharger la liste
        $title = "Liste des catégories";
        ob_start();
        require "view/categorie_list.php";
        $content = ob_get_clean();
        require "view/template.php";
    }
}
?>
