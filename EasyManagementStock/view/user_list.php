<?php 
$title = "NISHAPPART - Utilisateurs";
ob_start();
$currentUser = isset($_SESSION['user_id']) ? getUserById($_SESSION['user_id']) : null;
?>

<style>
  .user-header {
    background-color: #B35028;
    color: white;
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    margin-bottom: 2rem;
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
  }

  .user-header h1 {
    font-weight: 800;
    letter-spacing: 0.5px;
  }

  .table th, .table td {
    vertical-align: middle;
  }

  .table img {
    object-fit: cover;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    border: 2px solid #ffc107;
  }

  .btn-outline-light:hover {
    background-color: #ffc107;
    color: #000;
  }

  .btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
  }

  .modal-content {
    border-radius: 1rem;
  }

  .table thead {
    background-color: #ffcf9c;
    color: #2e2e2e;
    font-weight: bold;
  }

  .btn-add-user {
    background-color: #B35028;
    color: white;
    border: none;
  }

  .btn-add-user:hover {
    background-color: #8a361c;
    color: white;
  }
</style>

<div class="container py-5">
  <div class="user-header">
    <h1 class="display-5 fw-bold mb-0">👥 Utilisateurs enregistrés</h1>
    <p class="mb-0">Gérez les comptes administrateurs et employés depuis cette interface.</p>
  </div>

  <div class="table-responsive">
    <table class="table table-dark table-bordered table-hover text-center align-middle shadow-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Nom</th>
          <th>Email</th>
          <th>Statut</th>
          <th>Profil</th>
          <th>Créé le</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $u): ?>
          <tr>
            <td><?= $u->getId() ?></td>
            <td><?= htmlspecialchars($u->getName()) ?></td>
            <td><?= htmlspecialchars($u->getEmail()) ?></td>
            <td><?= ucfirst($u->getStatus()) ?></td>
            <td>
              <?php if ($u->getProfile_image()): ?>
                <img src="uploads/<?= htmlspecialchars($u->getProfile_image()) ?>" alt="Photo">
              <?php else: ?>
                <span class="text-muted">Aucune</span>
              <?php endif; ?>
            </td>
            <td><?= $u->getCreated_at()?->format('d/m/Y H:i') ?></td>
            <td>
              <a href="index.php?action=update_user_form&id=<?= $u->getId() ?>" class="btn btn-sm btn-outline-light">✏️</a>
              <a href="#" class="btn btn-sm btn-outline-danger" onclick="openConfirmModal(<?= $u->getId() ?>, '<?= addslashes($u->getName()) ?>')">🗑️</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-center mt-4">
    <a href="index.php?action=add_user_form" class="btn btn-add-user fw-bold shadow-sm px-4 py-2">➕ Ajouter un utilisateur</a>
  </div>
</div>

<!-- Modal confirmation suppression -->
<div id="confirmModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white border-warning">
      <div class="modal-header">
        <h5 class="modal-title text-warning">Confirmation</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p id="confirmMessage">Voulez-vous vraiment supprimer cet utilisateur ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <a id="confirmBtn" href="#" class="btn btn-danger">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<script>
  function openConfirmModal(userId, userName) {
    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    document.getElementById('confirmMessage').textContent =
      `Voulez-vous vraiment supprimer l'utilisateur "${userName}" ?`;
    document.getElementById('confirmBtn').href = `index.php?action=delete_user&id=${userId}`;
    modal.show();
  }
</script>


<?php 
$content = ob_get_clean();
require "view/template.php";
?>
