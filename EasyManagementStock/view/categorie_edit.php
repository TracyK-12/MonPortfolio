
<?php // view/categorie_edit.php
$title = $title ?? "Modifier Catégorie";
ob_start();
?>
<div class="container py-5">
  <h2 class="text-center text-primary mb-4">Modifier la catégorie</h2>
  <form method="POST" action="index.php?action=update_categorie" class="card p-4 shadow-lg">
    <input type="hidden" name="id" value="<?= $categorie->getId() ?>">
    <div class="mb-3">
      <label for="name" class="form-label">Nom</label>
      <input type="text" name="name" id="name" value="<?= htmlspecialchars($categorie->getName()) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea name="description" id="description" class="form-control" rows="3" required><?= htmlspecialchars($categorie->getDescription()) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
  </form>
</div>
<?php $content = ob_get_clean(); require "view/template.php"; ?>
