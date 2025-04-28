<?php
require_once "model/dashboard.php";

function ctlDashboard() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $user = getUserById($_SESSION['user_id']);
    if (!$user) {
        header("Location: index.php?action=logout");
        exit;
    }

    $stats = getDashboardStats();
    $title = "Dashboard - Easy Management Stock";

    ob_start();
    require "view/dashboard.php";
    $content = ob_get_clean();
    require "view/template.php";
}
