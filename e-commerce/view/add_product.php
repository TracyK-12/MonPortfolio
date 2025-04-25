<?php
$title = "MVC_STORE - AJOUTER UN PRODUIT";
ob_start();
?>
<div class="container d-flex justify-content-center align-items-center py-5">
  <form action="index.php?action=add_prod" method="POST" enctype="multipart/form-data" class="glass-form p-4 rounded shadow-lg text-white" style="width: 100%; max-width: 600px;">
    <h2 class="text-center mb-4 text-warning">➕ Ajouter un produit</h2>

    <div class="mb-3">
      <label for="nom" class="form-label">Nom du produit</label>
      <input type="text" class="form-control input-style" id="nom" name="nom" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control input-style" id="description" name="description" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label for="categorie" class="form-label">Catégorie</label>
      <select class="form-select input-style" id="categorie" name="categorie" required>
        <option selected disabled>-- Choisir une catégorie --</option>
        <?php foreach ($cats as $cat): ?>
          <option value="<?= $cat->getId() ?>"><?= $cat->getNom() ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="prix" class="form-label">Prix (€)</label>
      <input type="number" step="0.01" class="form-control input-style" id="prix" name="prix" required>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Image du produit</label>
      <input type="file" class="form-control input-style" id="image" name="image" accept="image/*">
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-warning fw-bold text-dark text-uppercase shadow">Valider l'ajout</button>
    </div>
    <div class="text-center mt-3">
      <a href="index.php?action=get_all_prods" class="text-decoration-none text-white">Retour à la liste des produits</a>
  </form>
</div>
<?php
$content = ob_get_clean();
require "view/template.php";
?>