<?php
require_once "model/user.php";

// Chargement de l'utilisateur si la session existe
$currentUser = (isset($_SESSION['user']) && $_SESSION['user'] instanceof User) ? $_SESSION['user'] : null;

// Calcul du total des articles dans le panier
$totalqty = 0;
if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $qty) {
        $totalqty += $qty;
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background: linear-gradient(90deg, #000000 0%, #FFD700 100%); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
  <div class="container-fluid">
    <a class="navbar-brand text-white fw-bold" href="index.php?action=home" style="font-size: 1.8rem; letter-spacing: 1px;">⚡ OPTIMAL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link nav-link-custom" href="index.php?action=home">Accueil</a></li>
        <li class="nav-item"><a class="nav-link nav-link-custom" href="index.php?action=get_all_prods">Produits</a></li>

        <?php if ($currentUser && $currentUser->getStatut() === "admin"): ?>
          <li class="nav-item"><a class="nav-link nav-link-custom" href="index.php?action=get_all_cats">Catégories</a></li>
          <li class="nav-item"><a class="nav-link nav-link-custom" href="index.php?action=get_all_users">Utilisateurs</a></li>
        <?php endif; ?>

        <?php if (!$currentUser): ?>
          <li class="nav-item"><a class="nav-link nav-link-custom" href="index.php?action=user_register">Enregistrement</a></li>
        <?php endif; ?>
      </ul>

      <!-- Panier visible pour tous -->
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item position-relative me-4">
          <a class="nav-link nav-link-custom position-relative" href="index.php?action=show_cart" style="font-size: 1.3rem;">
            🛒
            <?php if ($totalqty > 0): ?>
              <span class="badge bg-warning text-dark position-absolute top-0 start-100 translate-middle rounded-circle" style="font-size: 0.75rem;">
                <?= $totalqty ?>
              </span>
            <?php endif; ?>
          </a>
        </li>
      </ul>

      <!-- Connexion + Bonjour -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if ($currentUser): ?>
          <li class="nav-item d-flex align-items-center me-3 text-white fw-semibold">
            Bonjour, <?= htmlspecialchars($currentUser->getNom()) ?>
          </li>
        <?php endif; ?>
        <?php
          $cnxLink = $currentUser ? "index.php?action=logout" : "index.php?action=login";
          $cnxLabel = $currentUser ? "Déconnexion" : "Connexion";
        ?>
        <li class="nav-item"><a class="nav-link nav-link-custom" href="<?= $cnxLink ?>"><?= $cnxLabel ?></a></li>
      </ul>
    </div>
  </div>
</nav>
