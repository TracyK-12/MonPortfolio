<?php 
$title = "NISHAPPART - Inventaire";
ob_start();
$currentUser = null;

if (isset($_SESSION['user_id'])) {
    $currentUser = getUserById($_SESSION['user_id']);
}
?>

<style>
  .article-header {
    background-color: #B35028;
    color: white;
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    margin-bottom: 2rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  }

  .table th,
  .table td {
    vertical-align: middle;
  }

  .table img {
    object-fit: cover;
    border-radius: 10px;
    width: 60px;
    height: 60px;
  }

  .table-danger {
    background-color: rgba(255, 0, 0, 0.08) !important;
  }

  .badge-stock {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 5px 10px;
    border-radius: 0.5rem;
  }

  .badge-ok {
    background-color: #28a745;
    color: white;
  }

  .badge-low {
    background-color: #dc3545;
    color: white;
  }

  .btn-outline-light:hover {
    background-color: #ffc107;
    color: black;
  }

  .btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
  }

  .modal-content {
    border-radius: 1rem;
  }
</style>

<div class="container py-5">
  <div class="article-header">
    <h1 class="display-5 fw-bold mb-0">📦 Inventaire des articles</h1>
    <p class="mb-0">Suivez tous les articles en stock et soyez alerté en cas de seuil critique.</p>
  </div>

  <div class="table-responsive">
    <table class="table table-dark table-bordered table-hover text-center align-middle shadow">
      <thead class="table-warning text-dark">
        <tr>
          <th>#</th>
          <th>Image</th>
          <th>Nom</th>
          <th>Catégorie</th>
          <th>Quantité</th>
          <th>Seuil</th>
          <th>État</th>
          <th>Créé le</th>
          <?php if ($currentUser && $currentUser->getStatus() === "admin"): ?>
            <th>Actions</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($articles as $a): ?>
          <?php
            $isCritical = $a->getQuantity() <= $a->getAlert_threshold();
          ?>
          <tr class="<?= $isCritical ? 'table-dark' : '' ?>">
            <td><?= $a->getId() ?></td>
            <td>
              <?php if ($a->getImage()): ?>
                <img src="uploads/<?= htmlspecialchars($a->getImage()) ?>" alt="image">
              <?php else: ?>
                <span class="text-muted">Aucune</span>
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($a->getName()) ?></td>
            <td><?= htmlspecialchars($a->getCategory()) ?></td>
            <td><?= $a->getQuantity() ?></td>
            <td><?= $a->getAlert_threshold() ?></td>
            <td>
              <span class="badge-stock <?= $isCritical ? 'badge-low' : 'badge-ok' ?>">
                <?= $isCritical ? 'Stock bas' : 'OK' ?>
              </span>
            </td>
            <td><?= $a->getCreated_at()?->format('d/m/Y H:i') ?></td>

            <?php if ($currentUser && $currentUser->getStatus() === "admin"): ?>
            <td>
              <a href="index.php?action=update_article_form&id=<?= $a->getId() ?>" class="btn btn-sm btn-outline-light">✏️</a>
              <a href="#" class="btn btn-sm btn-outline-danger" onclick="openConfirmModal(<?= $a->getId() ?>, '<?= addslashes($a->getName()) ?>')">🗑️</a>
            </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php if ($currentUser && $currentUser->getStatus() === "admin"): ?>
  <div class="d-flex justify-content-center mt-4">
    <a href="index.php?action=add_article_form" class="btn btn-warning fw-bold shadow-sm">➕ Ajouter un article</a>
  </div>
  <?php endif; ?>
</div>

<!-- Modal de suppression -->
<div class="modal fade" id="confirmModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white border-warning">
      <div class="modal-header">
        <h5 class="modal-title text-warning">Confirmer la suppression</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p id="confirmMessage">Voulez-vous vraiment supprimer cet article ?</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <a id="confirmBtn" href="#" class="btn btn-danger">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<script>
  function openConfirmModal(id, name) {
    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    document.getElementById('confirmMessage').textContent = `Voulez-vous supprimer l’article "${name}" ?`;
    document.getElementById('confirmBtn').href = `index.php?action=delete_article&id=${id}`;
    modal.show();
  }
</script>


<?php 
$content = ob_get_clean();
require "view/template.php";
?>
