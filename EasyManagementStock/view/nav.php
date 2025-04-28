<?php
require_once "model/user.php";

$currentUser = null;
if (isset($_SESSION['user_id'])) {
    $currentUser = getUserById($_SESSION['user_id']);
}
?>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow" style="background-color: #2e0f02;">
  <div class="container-fluid">
    <!-- Logo et Titre -->
    <a class="navbar-brand d-flex align-items-center" href="index.php?action=home">
      <img src="public/images/EMSLogo.png" alt="Logo" class="me-2" style="height: 50px; border-radius: 8px;">
      <span class="fw-bold fs-5">EMS</span>
    </a>

    <!-- Burger -->
    <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenu Navbar -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <?php if ($currentUser): ?>
          <li class="nav-item d-flex align-items-center text-white px-2">
            Bonjour, <strong class="ms-1"><?= htmlspecialchars($currentUser->getName()) ?></strong>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php?action=home"><i class="fas fa-home me-1"></i> Accueil</a>
          </li>

          <?php if ($currentUser->getStatus() === "admin"): ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=get_all_users"><i class="fas fa-users me-1"></i> Utilisateurs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=get_all_articles"><i class="fas fa-boxes-stacked me-1"></i> Articles</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=get_all_categories"><i class="fas fa-tags me-1"></i> Catégories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=get_all_feedbacks"><i class="fas fa-clipboard-list me-1"></i> Rapports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=dashboard"><i class="fas fa-chart-pie me-1"></i> Dashboard</a>
            </li>
          <?php elseif ($currentUser->getStatus() === "employee"): ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=get_all_articles"><i class="fas fa-box-open me-1"></i> Articles</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=my_feedbacks"><i class="fas fa-file-alt me-1"></i> Mes Rapports</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=get_all_categories"><i class="fas fa-tags me-1"></i> Catégories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?action=dashboard"><i class="fas fa-chart-pie me-1"></i> Dashboard</a>
            </li>

          <?php endif; ?>

          <li class="nav-item">
            <a class="nav-link text-danger" href="index.php?action=logout"><i class="fas fa-sign-out-alt me-1"></i> Déconnexion</a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>

