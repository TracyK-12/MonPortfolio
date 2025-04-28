<?php 
$title = $title ?? "NISHAPPART : Rapports des employés";
$currentUser = isset($_SESSION['user_id']) ? getUserById($_SESSION['user_id']) : null;
ob_start();
?>

<style>
  .report-header {
    background-color: #2e6e5c;
    color: white;
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    margin-bottom: 2rem;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
  }

  .report-card {
    cursor: pointer;
    transition: transform 0.2s ease;
  }

  .report-card:hover {
    transform: scale(1.01);
  }

  .card.border-warning {
    border-width: 2px;
  }

  .modal-lg {
    max-width: 700px;
  }
</style>

<div class="container py-5">
  <div class="report-header">
    <h1 class="display-5 fw-bold mb-0">📋 <?= htmlspecialchars($title) ?></h1>
    <p class="mb-0">Consultez ou créez vos rapports selon votre rôle.</p>
  </div>

  <?php if (empty($feedbacks)): ?>
    <div class="alert alert-info text-center">Aucun rapport pour le moment.</div>
  <?php else: ?>
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <?php foreach($feedbacks as $index => $fb): 
        $user = $fb->getUser();
      ?>
        <div class="col">
          <div class="card report-card bg-dark text-white h-100 border-warning shadow-sm" data-bs-toggle="modal" data-bs-target="#modalFeedback<?= $index ?>">
            <div class="card-body d-flex align-items-center">
              <?php if ($user && $user->getProfile_image()): ?>
                <img src="uploads/<?= htmlspecialchars($user->getProfile_image()) ?>" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
              <?php endif; ?>
              <div>
                <h6 class="mb-0 fw-bold"><?= htmlspecialchars($user?->getName() ?? 'Utilisateur inconnu') ?></h6>
                <small class="text-white">🕒 <?= $fb->getCreated_at()?->format("d/m/Y H:i") ?></small>
                <div class="d-flex gap-2">
                <?php if ($currentUser && $currentUser->getStatus() === "employee" && $currentUser->getId() === $fb->getUser_id()): ?>
                  <a href="index.php?action=update_report_form&id=<?= $fb->getId() ?>" class="btn btn-sm btn-outline-light">✏️</a>
                <?php endif; ?>
                <?php if ($currentUser && in_array($currentUser->getStatus(), ["employee", "admin"])): ?>
                  <a href="index.php?action=delete_report&id=<?= $fb->getId() ?>" class="btn btn-sm btn-outline-danger">🗑️</a>
                <?php endif; ?>
              </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal pour détails du rapport -->
        <div class="modal fade" id="modalFeedback<?= $index ?>" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-white">
              <div class="modal-header border-warning">
                <h5 class="modal-title">📝 Détail du rapport</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <?php if ($fb->getImage()): ?>
                  <img src="uploads/<?= htmlspecialchars($fb->getImage()) ?>" class="img-fluid mb-3 rounded" alt="rapport">
                <?php endif; ?>
                <p><?= nl2br(htmlspecialchars($fb->getMessage())) ?></p>
              </div>
              <div class="modal-footer border-warning">
                <small class="me-auto">Posté par : <strong><?= htmlspecialchars($user?->getName() ?? 'Inconnu') ?></strong></small>
                <small>🕒 <?= $fb->getCreated_at()?->format("d/m/Y H:i") ?></small>
              </div>
            </div>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php if ($currentUser && $currentUser->getStatus() === "employee"): ?>
  <div class="d-flex justify-content-center mt-4">
    <a href="index.php?action=add_report_form" class="btn btn-warning fw-bold shadow">➕ Créer un rapport</a>
  </div>
<?php endif; ?>

<?php 
$content = ob_get_clean();
require "view/template.php";
?>
