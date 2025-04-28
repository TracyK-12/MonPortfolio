<?php
$title = "NISHAPPART - FORMULAIRE UTILISATEUR";
ob_start();

// Sécurisation des champs (en cas de formulaire d’édition)
$name = $user->getName() ?? '';
$email = $user->getEmail() ?? '';
$status = $user->getStatus() ?? '';
$profile_image = $user->getProfile_image() ?? '';
$id = $user->getId() ?? null;
?>

<div class="container d-flex justify-content-center align-items-center py-5">
  <form action="index.php?action=<?= $id ? 'update_user' : 'create_user' ?>" 
        method="POST" enctype="multipart/form-data"
        class="glass-form p-4 rounded shadow-lg text-white" 
        style="width: 100%; max-width: 600px;">

    <h2 class="text-center mb-4 text-warning">
      <?= $id ? '✏️ Modifier un utilisateur' : '➕ Ajouter un utilisateur' ?>
    </h2>

    <?php if ($id): ?>
      <input type="hidden" name="id" value="<?= $id ?>">
    <?php endif; ?>

    <div class="mb-3">
      <label for="name" class="form-label text-dark">Nom complet</label>
      <input type="text" class="form-control input-style" id="name" name="name" required value="<?= htmlspecialchars($name) ?>">
    </div>

    <div class="mb-3">
      <label for="email" class="form-label text-dark">Email</label>
      <input type="email" class="form-control input-style" id="email" name="email" required value="<?= htmlspecialchars($email) ?>">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label text-dark">Mot de passe <?= $id ? '(laisser vide pour conserver)' : '' ?></label>
      <input type="password" class="form-control input-style" id="password" name="password" <?= $id ? '' : 'required' ?>>
    </div>

    <div class="mb-3">
      <label for="status" class="form-label text-dark">Statut</label>
      <select name="status" id="status" class="form-select input-style" required>
        <option value="">-- Choisir un statut --</option>
        <option value="admin" <?= $status === 'admin' ? 'selected' : '' ?>>Administrateur</option>
        <option value="employee" <?= $status === 'employee' ? 'selected' : '' ?>>Employé</option>
      </select>
    </div>

    <div class="mb-4">
      <label for="profile_image" class="form-label text-dark">Photo de profil</label>
      <input type="file" class="form-control input-style" id="profile_image" name="profile_image">
      <?php if ($profile_image): ?>
        <small class="text-warning text-dark">Image actuelle : <?= htmlspecialchars($profile_image) ?></small>
      <?php endif; ?>
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
