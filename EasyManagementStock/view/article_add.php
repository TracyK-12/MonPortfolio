<?php
$title = "NISHAPPART - FORMULAIRE ARTICLE";
ob_start();

// Pré-remplissage des champs si édition
$name = $article->getName() ?? '';
$category = $article->getCategory() ?? '';
$quantity = $article->getQuantity() ?? 0;
$threshold = $article->getAlert_threshold() ?? 0;
$image = $article->getImage() ?? null;
$id = $article->getId() ?? null;
?>

<div class="container d-flex justify-content-center align-items-center py-5">
  <form action="index.php?action=<?= $id ? 'update_article' : 'create_article' ?>" 
        method="POST" 
        enctype="multipart/form-data"
        class="glass-form p-4 rounded shadow-lg text-white" 
        style="width: 100%; max-width: 600px; background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px);">

    <h2 class="text-center mb-4 text-warning">
      <?= $id ? '✏️ Modifier un article' : '➕ Ajouter un article' ?>
    </h2>

    <?php if ($id): ?>
      <input type="hidden" name="id" value="<?= $id ?>">
    <?php endif; ?>

    <div class="mb-3">
      <label for="name" class="form-label text-dark">Nom de l'article</label>
      <input type="text" class="form-control" name="name" id="name" required value="<?= htmlspecialchars($name) ?>">
    </div>

    <div class="mb-3">
      <label for="category" class="form-label text-dark">Catégorie</label>
      <input type="text" class="form-control" name="category" id="category" required value="<?= htmlspecialchars($category) ?>">
    </div>

    <div class="mb-3">
      <label for="quantity" class="form-label text-dark">Quantité</label>
      <input type="number" class="form-control" name="quantity" id="quantity" required min="0" value="<?= $quantity ?>">
    </div>

    <div class="mb-3">
      <label for="threshold" class="form-label text-dark">Seuil d'alerte</label>
      <input type="number" class="form-control" name="alert_threshold" id="threshold" required min="0" value="<?= $threshold ?>">
    </div>

    <div class="mb-3">
      <label for="image" class="form-label text-dark">Image</label>
      <input type="file" class="form-control" name="image" id="image" accept="image/*">
      
      <?php if ($image): ?>
        <div class="mt-2">
          <p class="text-dark mb-1">Image actuelle :</p>
          <img src="uploads/<?= htmlspecialchars($image) ?>" alt="article" class="img-thumbnail" width="120">
        </div>
      <?php endif; ?>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-warning fw-bold text-dark text-uppercase shadow">
        <?= $id ? 'Mettre à jour' : 'Ajouter' ?>
      </button>
    </div>
  </form>
</div>

<?php
$content = ob_get_clean();
require "view/template.php";
?>
