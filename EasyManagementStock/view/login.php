<?php ob_start(); ?>

<style>
  body {
    margin: 0;
    padding: 0;
    background-color: #B35028 !important;
    font-family: 'Segoe UI', sans-serif;
  }

  .login-wrapper {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(to bottom right,rgb(226, 132, 95),rgb(236, 102, 48));
    padding: 2rem;
  }

  .login-card {
    background: #fff;
    border-radius: 1.5rem;
    overflow: hidden;
    display: flex;
    flex-direction: row;
    width: 90%;
    max-width: 950px;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
  }

  .login-left {
    background-color:rgb(87, 28, 5);
    color: white;
    flex: 1;
    padding: 3rem 2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
  }

  .login-left img {
    max-width: 180px;
    margin: 0 auto 1.5rem;
  }

  .login-left h2 {
    font-weight: bold;
    font-size: 2rem;
    margin-bottom: 1rem;
  }

  .login-left p {
    font-size: 1rem;
    opacity: 0.85;
  }

  .login-right {
    flex: 1;
    padding: 3rem 2rem;
  }

  .login-right h3 {
    font-weight: bold;
    margin-bottom: 1.5rem;
    color: rgb(236, 102, 48)
  }

  .form-control {
    border-radius: 0.5rem;
    padding: 0.75rem;
  }

  .form-control:focus {
    border-color: rgb(236, 102, 48);
    box-shadow: 0 0 0 0.2rem rgba(46, 110, 92, 0.25);
  }

  .btn-login {
    background-color: rgb(236, 102, 48);
    color: white;
    font-weight: bold;
    border-radius: 0.5rem;
    transition: 0.3s;
  }

  .btn-login:hover {
    background-color: rgb(82, 26, 5);
  }

  .text-small {
    font-size: 0.9rem;
    text-align: center;
  }

  .text-small a {
    color: #2e6e5c;
    text-decoration: none;
  }

  .text-small a:hover {
    text-decoration: underline;
  }
</style>

<div class="login-wrapper">
  <div class="login-card">

    <!-- Colonne gauche avec logo et branding -->
    <div class="login-left">
      <img src="public/images/EMSLogo.png" alt="Logo EMS">
      <h2>Bienvenue sur <br>EASY MANAGEMENT STOCK</h2>
      <p>Accédez à votre tableau de bord pour gérer efficacement vos rapports, articles et utilisateurs.</p>
    </div>

    <!-- Colonne droite avec le formulaire -->
    <div class="login-right">
      <h3>Connexion</h3>

      <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" action="index.php?action=login">
        <div class="mb-3">
          <label for="email" class="form-label">Adresse email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Votre email" required>
        </div>
        <div class="mb-4">
          <label for="password" class="form-label">Mot de passe</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" required>
        </div>
        <button type="submit" class="btn btn-login w-100">Se connecter</button>
      </form>

      <div class="text-small mt-4">
        <p>Vous n'avez pas encore de compte ? <a href="#">Contactez l'administrateur</a></p>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
require "view/template_guest.php";
?>
