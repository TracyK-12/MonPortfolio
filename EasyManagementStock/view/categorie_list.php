<?php // view/categorie_list.php
$title = "Liste des Catégories";
$currentUser = $_SESSION['user'] ?? null;
ob_start();
?>

<div class="container py-5">
  <div class="text-center mb-4">
    <h1 class="display-6 fw-bold text-uppercase text-warning">Catégories</h1>
    <p class="text-muted">Liste des catégories enregistrées dans le système.</p>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped align-middle">
      <thead class="table-warning text-dark">
        <tr>
          <th>#</th>
          <th>Nom</th>
          <th>Description</th>
          <th>Créé le</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categories as $cat): ?>
          <tr>
            <td><?= $cat->getId() ?></td>
            <td><?= htmlspecialchars($cat->getName()) ?></td>
            <td><?= htmlspecialchars($cat->getDescription()) ?></td>
            <td><?= $cat->getCreated_at()?->format('d/m/Y H:i') ?></td>
            <td>
              <a href="index.php?action=update_categorie_form&id=<?= $cat->getId() ?>" class="btn btn-sm btn-outline-dark">✏️</a>
              <a href="index.php?action=delete_categorie&id=<?= $cat->getId() ?>" class="btn btn-sm btn-outline-danger">🗑️</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php if ($currentUser->getStatus() === "admin"): ?>
    <div class="text-center mt-4">
      <a href="index.php?action=add_categorie_form" class="btn btn-warning fw-bold">➕ Ajouter une catégorie</a>
    </div>
  <?php endif; ?>

</div>

<?php $content = ob_get_clean(); require "view/template.php"; ?>
