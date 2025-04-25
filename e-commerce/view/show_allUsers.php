<?php 
$title = "MVC_STORE: UTILISATEURS";
ob_start();
?>

<div class="container py-5">
  <h1 class="text-center text-warning mb-4">👥 Tous les Utilisateurs</h1>

  <table class="table table-dark table-hover text-center rounded">
    <thead class="table-warning text-dark">
      <tr>
        <th>#</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Statut</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($users as $u): ?>
        <tr>
          <td><?= $u->getId() ?></td>
          <td><?= $u->getNom() ?></td>
          <td><?= $u->getPrenom() ?></td>
          <td><?= $u->getEmail() ?></td>
          <td><?= ucfirst($u->getStatut()) ?></td>
          <td>
            <a href="index.php?action=update_user&id=<?= $u->getId() ?>" class="btn btn-sm btn-outline-light">✏️</a>
            <a href="index.php?action=delete_user&id=<?= $u->getId() ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Confirmer la suppression ?')">🗑️</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="d-flex justify-content-center mt-4">
    <a href="index.php?action=add_user" class="btn btn-warning fw-bold">➕ Ajouter un utilisateur</a>
  </div>
</div>

<?php 
$content = ob_get_clean();
require "view/template.php";
?>
