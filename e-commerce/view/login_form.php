<?php
$title = "MVC_STORE - LOGIN";
ob_start();
?>

<div class="login-container d-flex justify-content-center align-items-center vh-100">
  <form action="index.php?action=login" method="POST" class="glass-card p-4 rounded shadow">
    <h2 class="text-center text-white mb-4">Connexion</h2>

    <div class="mb-3">
      <label for="email" class="form-label text-white">Email</label>
      <div class="input-group">
        <span class="input-group-text bg-transparent text-warning border-warning"><i class="bi bi-envelope-fill"></i></span>
        <input type="email" class="form-control bg-dark text-white border-warning" id="email" name="email" placeholder="Votre adresse email" required>
      </div>
    </div>

    <div class="mb-4">
      <label for="password" class="form-label text-white">Mot de passe</label>
      <div class="input-group">
        <span class="input-group-text bg-transparent text-warning border-warning"><i class="bi bi-lock-fill"></i></span>
        <input type="password" class="form-control bg-dark text-white border-warning" id="password" name="password" placeholder="Votre mot de passe" required>
      </div>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-warning fw-bold text-uppercase">Se connecter</button>
    </div>
  </form>
</div>

<!-- 🌈 STYLES CUSTOM -->
<!-- <style>
  body {
    background: linear-gradient(135deg, #1e1e1e, #2c2c2c);
    font-family: 'Segoe UI', sans-serif;
  }

  .glass-card {
    backdrop-filter: blur(12px);
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.15);
    width: 100%;
    max-width: 400px;
  }

  .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.3);
    border-color: #FFD700;
  }

  .input-group-text {
    border-right: 0;
  }

  .form-control {
    border-left: 0;
  }
</style> -->

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

<?php
$content = ob_get_clean();
require "view/template.php";
?>
