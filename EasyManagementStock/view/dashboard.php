<div class="container py-5">
  <h2 class="mb-5 text-center text-uppercase fw-bold" style="color: #B35028;">📊 Tableau de bord global</h2>
  
  <div class="row g-4">

    <div class="col-md-3">
      <div class="card text-white bg-primary shadow">
        <div class="card-body text-center">
          <h6 class="text-uppercase">Articles en stock</h6>
          <p class="display-5 fw-bold"><?= $stats['total_articles'] ?></p>
          <i class="fas fa-boxes fa-lg"></i>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-white bg-danger shadow">
        <div class="card-body text-center">
          <h6 class="text-uppercase">Articles critiques</h6>
          <p class="display-5 fw-bold"><?= $stats['low_stock'] ?></p>
          <i class="fas fa-exclamation-triangle fa-lg"></i>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-dark bg-warning shadow">
        <div class="card-body text-center">
          <h6 class="text-uppercase">Rapports enregistrés</h6>
          <p class="display-5 fw-bold"><?= $stats['total_feedbacks'] ?></p>
          <i class="fas fa-clipboard-check fa-lg"></i>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-white bg-success shadow">
        <div class="card-body text-center">
          <h6 class="text-uppercase">Utilisateurs</h6>
          <p class="display-5 fw-bold"><?= $stats['total_users'] ?></p>
          <i class="fas fa-users fa-lg"></i>
        </div>
      </div>
    </div>

  </div>

  <hr class="my-5">

  <div class="row g-4">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header bg-light fw-bold">📈 Articles par catégorie</div>
        <div class="card-body">
          <canvas id="chartCategories"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header bg-light fw-bold">📆 Rapports par semaine</div>
        <div class="card-body">
          <canvas id="chartFeedback"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx1 = document.getElementById('chartCategories');
  const chart1 = new Chart(ctx1, {
    type: 'doughnut',
    data: {
      labels: <?= json_encode($categoryLabels) ?>,
      datasets: [{
        data: <?= json_encode($categoryData) ?>,
        backgroundColor: ['#B35028', '#e07b39', '#FFD700', '#2e6e5c'],
        borderWidth: 1
      }]
    }
  });

  const ctx2 = document.getElementById('chartFeedback');
  const chart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: <?= json_encode($weekLabels) ?>,
      datasets: [{
        label: 'Nombre de rapports',
        data: <?= json_encode($weekData) ?>,
        backgroundColor: '#B35028'
      }]
    }
  });
</script>
