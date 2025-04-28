<?php
require_once "model/article.php";
require_once "model/feedback.php";
require_once "model/user.php";

function getDashboardStats(): array {
    $articles = getAllArticles();
    $feedbacks = getAllFeedback();
    $users = getAllUsers();

    $lowStock = array_filter($articles, fn($a) => $a->getQuantity() <= $a->getAlert_threshold());

    return [
        'total_articles' => count($articles),
        'low_stock' => count($lowStock),
        'total_feedbacks' => count($feedbacks),
        'total_users' => count($users),
    ];
}
