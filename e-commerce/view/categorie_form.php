<?php
$title = "MVC_STORE - AJOUTER UNE CATEGORIE";
ob_start();
?>

<div class="container d-flex justify-content-center align-items-center py-5">
  <form action="index.php?action=add_cat" method="POST" class="glass-form p-4 rounded shadow-lg text-white" style="width: 100%; max-width: 600px;">
    <h2 class="text-center mb-4 text-warning">🗂️ Nouvelle Catégorie</h2>

    <div class="mb-3">
      <label for="nom" class="form-label">Nom</label>
      <input type="text" class="form-control input-style" id="nom" name="nom" required>
    </div>

    <div class="mb-4">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control input-style" id="description" name="description" rows="3" required></textarea>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-warning fw-bold text-dark text-uppercase shadow">Ajouter la catégorie</button>
    </div>
    <div class="text-center mt-3">
      <a href="index.php?action=get_all_cats" class="text-decoration-none text-white">Retour à la liste des catégories</a>
  </form>
</div>

<!-- STYLES -->
<!-- <style>
  body {
    background: linear-gradient(135deg, #2f2f2f, #3c3c3c);
    font-family: 'Segoe UI', sans-serif;
    color: #fff;
  }

  .glass-form {
    background: rgba(255, 255, 255, 0.07);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .input-style {
    background-color: rgba(255, 255, 255, 0.12);
    border: none;
    color: #fff;
  }

  .input-style::placeholder {
    color: #bbb;
  }

  .form-control:focus,
  textarea:focus {
    background-color: rgba(255, 255, 255, 0.18);
    border-color: #FFD700;
    box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
    color: #fff;
  }

  .btn-warning:hover {
    background-color: #e6c200;
  }
</style> -->

<?php
$content = ob_get_clean();
require "view/template.php";
?>
