<?php
$title = "OPTIMAL - FORMULAIRE UTILISATEUR";
ob_start();

// Préparation sécurisée des données utilisateur
$nom = $user->getNom() ?? '';
$prenom = $user->getPrenom() ?? '';
$email = $user->getEmail() ?? '';
$statut = $user->getStatut() ?? '';
$id = null;

try {
  $id = $user->getId();
} catch (Throwable $e) {
  $id = null;
}
?>

<div class="container d-flex justify-content-center align-items-center py-5">
  <form action="" method="POST" class="glass-form p-4 rounded shadow-lg text-white" style="width: 100%; max-width: 600px;">
    <h2 class="text-center mb-4 text-warning">
      <?= $id ? '✏️ Modifier un utilisateur' : '➕ Ajouter un utilisateur' ?>
    </h2>

    <?php if ($id): ?>
      <input type="hidden" name="id" value="<?= $id ?>">
    <?php endif; ?>

    <div class="mb-3">
      <label for="nom" class="form-label">Nom</label>
      <input type="text" class="form-control input-style" id="nom" name="nom" required value="<?= htmlspecialchars($nom) ?>">
    </div>

    <div class="mb-3">
      <label for="prenom" class="form-label">Prénom</label>
      <input type="text" class="form-control input-style" id="prenom" name="prenom" required value="<?= htmlspecialchars($prenom) ?>">
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control input-style" id="email" name="email" required value="<?= htmlspecialchars($email) ?>">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Mot de passe</label>
      <input type="password" class="form-control input-style" id="password" name="password" required>
    </div>

    <div class="mb-4">
      <label for="statut" class="form-label">Statut</label>
      <select name="statut" id="statut" class="form-select input-style" required>
        <option value="">-- Choisir un statut --</option>
        <option value="admin" <?= $statut === 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="user" <?= $statut === 'user' ? 'selected' : '' ?>>User</option>
      </select>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-warning fw-bold text-dark text-uppercase shadow">
        <?= $id ? 'Mettre à jour' : 'Ajouter' ?>
      </button>
    </div>
  </form>
</div>

<?php
$content = ob_get_clean();
require "view/template.php";
?>
