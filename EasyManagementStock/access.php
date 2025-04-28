<?php

$accessList = [
    'home' => ['admin', 'employee'],
    'login' => [],
    'logout' => [],
    'access_denied' => [],

    // 👤 Utilisateurs
    'get_all_users' => ['admin'],
    'add_user_form' => ['admin'],
    'create_user' => ['admin'],
    'update_user' => ['admin'],
    'update_user_form' => ['admin'],
    'delete_user' => ['admin'],

    // 📦 Articles
    'get_all_articles' => ['admin', 'employee'], // les 2 peuvent voir
    'add_article_form' => ['admin'],
    'create_article' => ['admin'],
    'update_article' => ['admin'],
    'update_article_form' => ['admin'],
    'delete_article' => ['admin'],

    // 📝 Rapports
    'get_all_feedbacks' => ['admin'],
    'my_feedbacks' => ['employee'],
    'add_report_form' => ['employee', 'admin'],
    'create_feedback' => ['employee', 'admin'],
    'feedback_success' => ['employee', 'admin'],
    'delete_report' => ['admin', 'employee'],
    // 🔖 Catégories
    'get_all_categories' => ['admin', 'employee'],
    'add_categorie_form' => ['admin'],
     'create_categorie' => ['admin'],
    'update_categorie_form' => ['admin'],
    'update_categorie' => ['admin'],
    'delete_categorie' => ['admin'],
    // 📊 Dashboard
    'dashboard' => ['admin', 'employee'],

    // 🔒 Par défaut
    'access_denied' => [],
];
