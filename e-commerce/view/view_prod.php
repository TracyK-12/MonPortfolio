<?php
$title = "Détail : " . htmlspecialchars($prod->getNom());
ob_start();
?>
<div class="container py-5">
  <div class="row">
    <div class="col-md-6 text-center">
      <img src="<?= $prod->getImage() ?>" class="img-fluid rounded shadow" alt="<?= htmlspecialchars($prod->getNom()) ?>">
    </div>
    <div class="col-md-6">
      <h2 class="text-warning"><?= htmlspecialchars($prod->getNom()) ?></h2>
      <p class="text-white"><?= htmlspecialchars($prod->getDescription()) ?></p>
      <p><strong>Catégorie :</strong> <?= htmlspecialchars($prod->getCategorieName()) ?></p>
      <p class="fs-4 text-white">💰 <?= number_format($prod->getPrix(),2,',',' ') ?> €</p>
      <a href="index.php?action=add_to_cart&id=<?= $prod->getId() ?>" class="btn btn-success me-2">🛒 Ajouter au panier</a>
      <a href="index.php?action=get_all_prods" class="btn btn-secondary">← Retour à la liste</a>
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
require 'view/template.php';
