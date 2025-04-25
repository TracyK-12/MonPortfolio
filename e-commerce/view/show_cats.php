<?php 
$title = "MVC_STORE: CATEGORIES";
ob_start();
?>

<div class="container py-5">
  <h1 class="text-center mb-5 text-warning fw-bold display-5">📁 Nos Catégories</h1>

  <div class="row g-4">
    <?php foreach($cats as $c): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-lg category-card h-100 text-white">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-uppercase fw-bold"><?= $c->getNom() ?></h5>
            <p class="card-text text-muted"><?= $c->getDescription() ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="d-flex justify-content-center mt-5">
    <a href="index.php?action=add_cat" class="btn btn-warning fw-bold px-4 py-2 shadow-sm">➕ Créer une catégorie</a>
  </div>
</div>

<!-- STYLES -->
<!-- <style>
  body {
    background: linear-gradient(to right, #2e2e2e, #3f3f3f);
    font-family: 'Segoe UI', sans-serif;
    color: #fff;
  }

  .category-card {
    background: rgba(255, 255, 255, 0.07);
    backdrop-filter: blur(8px);
    border-radius: 1rem;
    transition: transform 0.3s ease;
  }

  .category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(255, 215, 0, 0.2);
  }

  .card-text {
    color: #cccccc !important;
  }

  .btn-warning {
    background-color: #FFD700;
    border: none;
  }

  .btn-warning:hover {
    background-color: #e6c200;
  }
</style> -->

<?php 
$content = ob_get_clean();
require "view/template.php";
?>

