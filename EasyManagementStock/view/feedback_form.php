<?php
$title = "Envoyer un rapport";
ob_start();

$feedback ??= new Feedback();
$message = $feedback->getMessage() ?? '';

?>

<div class="container py-5 d-flex justify-content-center">
  <form action="index.php?action=create_feedback" method="POST" enctype="multipart/form-data"
        class="glass-form p-4 rounded shadow-lg text-white" style="max-width: 600px; width: 100%;">
        
    <h2 class="text-center text-warning mb-4">📝 Nouveau Rapport</h2>

    <?php if (isset($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="mb-3">
      <label for="message" class="form-label">Message</label>
      <textarea name="message" id="message" rows="4" class="form-control input-style" required><?= htmlspecialchars($message) ?></textarea>
    </div>

    <div class="mb-4">
      <label for="image" class="form-label">Photo (facultatif)</label>
      <input type="file" class="form-control input-style" name="image" id="image" accept="image/*">
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-warning fw-bold text-dark text-uppercase shadow">
        Envoyer
      </button>
    </div>
  </form>
</div>

<?php
$content = ob_get_clean();
require "view/template.php";
?>
