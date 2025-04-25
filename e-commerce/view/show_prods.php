<?php
$title = "MVC_STORE: PRODUITS";
ob_start();
?>
<div class="container py-5">
<?php if (isset($_SESSION['flash'])): ?>
  <div id="flash-message" class="flash-message">
    <?= $_SESSION['flash'] ?>
  </div>
  <?php unset($_SESSION['flash']); ?>
<?php endif; ?>


  <h1 class="text-center mb-5 text-white">🛒 Nos Produits</h1>

  <div class="row g-4">
    <?php foreach ($prods as $p): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card product-card h-100 border-0 shadow-sm">
          <?php if ($p->getImage()): ?>
            <a href="index.php?action=view_prod&id=<?= $p->getId() ?>">
            <img src="<?= $p->getImage() ?>" class="card-img-top product-image" alt="<?= htmlspecialchars($p->getNom()) ?>">
            </a>
          <?php endif; ?>

          <div class="card-body py-3 px-3 d-flex flex-column">
            <h5 class="card-title text-warning fw-bold mb-1"><?= $p->getNom() ?></h5>
            <p class="card-text text-muted small mb-2"><?= $p->getDescription() ?></p>
            <span class="badge bg-secondary text-uppercase mb-2" style="font-size: 0.75rem;">
              Catégorie : <?= $p->getCategorieName() ?>
            </span>

            <div class="mt-auto d-flex justify-content-between align-items-center">
              <span class="fs-6 fw-bold text-white">💰 <?= number_format($p->getPrix(), 2, ',', ' ') ?> €</span>

              <?php if (isset($_SESSION['user']) && $_SESSION['user']->getStatut() === 'admin'): ?>
                <div class="d-flex gap-2">
                  <a href="index.php?action=update_prod&id=<?= $p->getId() ?>" class="btn btn-sm btn-outline-warning py-1 px-2" title="Modifier">✏️</a>
                  <a href="index.php?action=delete_prod&id=<?= $p->getId() ?>" class="btn btn-sm btn-outline-danger py-1 px-2" onclick="return confirm('Confirmer la suppression ?')" title="Supprimer">🗑️</a>
                </div>
              <?php endif; ?>
            </div>

            <?php if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']->getStatut() === 'user')): ?>
              <div class="d-flex justify-content-around mt-3">
  <!-- Panier (accessible même hors connexion) -->
  <a href="index.php?action=add_to_cart&id=<?= $p->getId() ?>" 
   class="btn btn-sm btn-outline-success rounded-circle" title="Ajouter au panier">
  🛒
</a>


  <!-- Liker (redirection si non connecté) -->
  <a href="index.php?action=<?= isset($_SESSION['user']) ? 'like_prod&id=' . $p->getId() : 'login' ?>" 
     class="btn btn-sm btn-outline-danger rounded-circle" title="Liker">
    ❤️
  </a>

  <!-- Acheter (redirection si non connecté) -->
  <a href="index.php?action=<?= isset($_SESSION['user']) ? 'buy&id=' . $p->getId() : 'login' ?>" 
     class="btn btn-sm btn-outline-warning rounded-circle text-dark" title="Acheter">
    🧾
  </a>
</div>

            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Bouton d'ajout produit visible par admin et user -->
  <?php if (isset($_SESSION['user']) && in_array($_SESSION['user']->getStatut(), ['admin', 'user'])): ?>
    <div class="d-flex justify-content-center mt-5">
      <a href="index.php?action=add_prod" class="btn btn-warning px-4 py-2 fw-bold shadow-sm">➕ Ajouter un nouveau produit</a>
    </div>
  <?php endif; ?>
</div>

<style>
  .btn.rounded-circle {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
  }
  .btn.rounded-circle:hover {
    transform: scale(1.1);
    transition: 0.2s ease-in-out;
  }
</style>

<?php
$content = ob_get_clean();
require "view/template.php";
?>
