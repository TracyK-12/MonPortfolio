<?php // view/categorie_add.php
$title = $title ?? "Ajouter une Catégorie";
ob_start();
?>
<div class="container py-5">
  <h2 class="text-center text-success mb-4">Ajouter une nouvelle catégorie</h2>
  <form method="POST" action="index.php?action=create_categorie" class="card p-4 shadow-lg">
    <div class="mb-3">
      <label for="name" class="form-label">Nom</label>
      <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-success w-100">Enregistrer</button>
  </form>
</div>
<?php $content = ob_get_clean(); require "view/template.php"; ?>
