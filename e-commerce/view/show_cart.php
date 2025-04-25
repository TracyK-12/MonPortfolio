<?php
$title = "🛒 Mon Panier";
ob_start();
?>

<div class="container py-5">
  <h1 class="text-center mb-5 text-white">🧺 Mon Panier</h1>

  <?php if (empty($prods)): ?>
    <p class="text-center text-warning">Votre panier est vide 😔</p>
  <?php else: ?>
    <table class="table table-dark table-hover align-middle">
      <thead>
        <tr>
          <th>Image</th>
          <th>Nom</th>
          <th>Prix</th>
          <th>Quantité</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $total = 0;
        $totalqty = 0;
        ?>

        <?php foreach ($prods as $p): ?>
          <?php
            $qty = $_SESSION['panier'][$p->getId()];
            $sousTotal = $p->getPrix() * $qty;
            $total += $sousTotal;
            $totalqty += $qty;
          ?>
          <tr>
            <td><img src="<?= $p->getImage() ?>" alt="<?= $p->getNom() ?>" width="60" class="rounded shadow-sm"></td>
            <td><?= $p->getNom() ?></td>
            <td><?= number_format($p->getPrix(), 2, ',', ' ') ?> €</td>
            <td>
              <a href="index.php?action=reduce_article&id=<?= $p->getId() ?>" class="btn btn-sm btn-outline-success">➖</a>
              <?= $qty ?>
              <a href="index.php?action=add_to_cart&id=<?= $p->getId() ?>&mode=cart" class="btn btn-sm btn-outline-success">➕</a>
            </td>
            <td><?= number_format($sousTotal, 2, ',', ' ') ?> €</td>
            <td>
              <a href="#" class="btn btn-sm btn-outline-danger"
                 onclick="openConfirmModal(<?= $p->getId() ?>, '<?= addslashes($p->getNom()) ?>')">🗑️</a>
            </td>
          </tr>
        <?php endforeach; ?>

        <!-- Total Panier -->
        <tr class="table-light fw-bold">
          <td colspan="3">Total Panier</td>
          <td><?= $totalqty ?></td>
          <td><?= number_format($total, 2, ',', ' ') ?> €</td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <!-- Boutons d'action -->
    <div class="text-center mt-4">
      <!-- Valider achat (connecté ou non) -->
      <?php if (isset($_SESSION['user'])): ?>
        <a href="index.php?action=validate_cart" class="btn btn-success fw-bold">✅ Valider l’achat</a>
      <?php else: ?>
        <a href="index.php?action=login" class="btn btn-warning fw-bold">🔒 Valider vos achats</a>
      <?php endif; ?>

      <!-- Visibles pour tous -->
      <a href="index.php?action=get_all_prods" class="btn btn-info fw-bold">Continuer vos achats</a>
      <a href="index.php?action=clear_cart" class="btn btn-danger fw-bold">Vider le panier</a>
    </div>
  <?php endif; ?>
</div>

<!-- Modal confirmation suppression -->
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
    document.getElementById('confirmBtn').href = `index.php?action=remove_from_cart&id=${id}`;
    modal.show();
  }
</script>

<?php
$content = ob_get_clean();
require "view/template.php";
?>
