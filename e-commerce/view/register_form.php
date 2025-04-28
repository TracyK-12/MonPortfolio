<?php
$title = "OPTIMAL - Register";
ob_start();
?>
<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-warning text-center">
        <?= $_SESSION['flash']; ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
<div class="login-container d-flex justify-content-center align-items-center vh-100">
    <form action="index.php?action=register" method="POST" class="glass-card p-4 rounded shadow">
        <h2 class="text-center text-white mb-4">Enregistrement</h2>
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Nom" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="surname" placeholder="Prénom" required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="mb-4">
            <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-warning fw-bold text-uppercase">S'inscrire</button>
        </div>
    </form>
</div>
<?php
$content = ob_get_clean();
require "view/template.php";
?>
