<?php
require_once "model/article.php";

/**
 * ✅ Liste tous les articles (admin et employé)
 */
function ctlGetAllArticles() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $articles = getAllArticles();
    $title = "Liste des articles";

    ob_start();
    require "view/article_list.php";
    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * ➕ Formulaire d'ajout d'article (admin uniquement)
 */
function ctlAddArticleForm() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    $article = new Article();
    $title = "Ajouter un article";
    ob_start();
    require "view/article_add.php";
    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * ➕ Création d'un article (admin uniquement)
 */
function ctlCreateArticle() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (!empty($_POST['name']) && !empty($_POST['category']) && isset($_POST['quantity'], $_POST['alert_threshold'])) {
        $article = new Article();
        $article->setName(trim($_POST['name']))
                ->setCategory(trim($_POST['category']))
                ->setQuantity((int)$_POST['quantity'])
                ->setAlert_threshold((int)$_POST['alert_threshold'])
                ->setCreated_at(new DateTime());

        if (!empty($_FILES['image']['name'])) {
            $filename = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetPath = 'uploads/' . $filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $article->setImage($filename);
            }
        }

        if (createArticle($article)) {
            header("Location: index.php?action=get_all_articles");
            exit;
        } else {
            $error = "❌ Échec de l'enregistrement.";
        }
    } else {
        $error = "⚠️ Tous les champs sont obligatoires.";
    }

    $title = "Ajouter un article";
    $article = new Article();
    ob_start();
    require "view/article_add.php";
    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * ✏️ Formulaire de modification d'un article (admin uniquement)
 */
function ctlUpdateArticleForm() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header("Location: index.php?action=get_all_articles");
        exit;
    }

    $article = getArticleById((int)$_GET['id']);
    if (!$article) {
        header("Location: index.php?action=get_all_articles");
        exit;
    }

    $title = "Modifier un article";
    ob_start();
    require "view/article_add.php";
    $content = ob_get_clean();
    require "view/template.php";
}

/**
 * 📈 Traitement de la mise à jour (admin uniquement)
 */
function ctlUpdateArticle() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        header("Location: index.php?action=get_all_articles");
        exit;
    }

    $article = getArticleById((int)$_POST['id']);
    if (!$article) {
        header("Location: index.php?action=get_all_articles");
        exit;
    }

    $article->setName(trim($_POST['name']))
            ->setCategory(trim($_POST['category']))
            ->setQuantity((int) $_POST['quantity'])
            ->setAlert_threshold((int) $_POST['alert_threshold']);

    if (!empty($_FILES['image']['name'])) {
        $imgName = time() . '_' . basename($_FILES['image']['name']);
        $target = "uploads/" . $imgName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $article->setImage($imgName);
        }
    }

    updateArticle($article);
    header("Location: index.php?action=get_all_articles");
    exit;
}

/**
 * 🗑️ Suppression d'article (admin uniquement)
 */
function ctlDeleteArticle() {
    if (!isAdminConnected()) {
        header("Location: index.php?action=login");
        exit;
    }

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        deleteArticle((int)$_GET['id']);
    }

    header("Location: index.php?action=get_all_articles");
    exit;
}
