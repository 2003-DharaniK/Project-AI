

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Interactive Sales Dashboard</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f7f9;
    }

    .dashboard-header {
      margin-top: 20px;
      text-align: center;
    }

    /* Container Styling */
    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    /* Card Styling */
    .dashboard-card {
      background-color: #fff;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      transition: transform 0.4s ease-in-out;
      text-align: center;
    }

    .dashboard-card:hover {
      transform: scale(1.02);
    }

    .counter {
      font-size: 2.5rem;
      font-weight: bold;
      color: #28a745;
    }

    /* Grid Layout */
    .row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .col-md-6 {
      flex: 0 0 48%;
      max-width: 48%;
    }

    /* Progress Bar */
    .progress {
      height: 20px;
      background-color: #e9ecef;
      border-radius: 20px;
      overflow: hidden;
      margin-bottom: 20px;
    }

    .progress-bar {
      height: 100%;
      border-radius: 20px;
      background-color: #28a745;
    }

    /* Fixed Chart Sizing */
    .chart-container {
      width: 100%;
      height: 250px;
      margin-top: 20px;
    }

    /* Table Styling */
    .table {
      width: 100%;
      margin-bottom: 1rem;
      background-color: #fff;
      text-align: center;
    }

    .transaction-table {
      margin-top: 20px;
    }

    /* Additional Styles */
    .badge {
      padding: 8px 15px;
      border-radius: 10px;
    }

    .badge-success {
      background-color: #28a745;
    }

    .badge-warning {
      background-color: #ff9800;
    }

    .badge-danger {
      background-color: #f44336;
    }

    /* Hover Effects */
    .card-hover:hover {
      background-color: #e8f5e9;
      cursor: pointer;
    }

  </style>
</head>
<body>
<a href="javascript:history.back()" class="back-button" style="display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>

<div class="container">
  <h2 class="dashboard-header">Enhanced Sales Dashboard</h2>

  <!-- Sales Overview Cards -->
  <div class="row">
    <div class="col-md-6">
      <div class="dashboard-card">
        <h4>Total Sales</h4>
        <div class="counter">$12,380</div>
        <p>+5% from last week</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="dashboard-card">
        <h4>Sales Growth</h4>
        <div class="counter">10%</div>
        <p>Weekly Comparison</p>
      </div>
    </div>
  </div>

  <!-- Progress Bar Section -->
  <div class="dashboard-card">
    <h4>Sales Progress Towards Goal</h4>
    <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
    </div>
  </div>

  <!-- Charts Section -->
  <div class="row">
    <div class="col-md-6">
      <div class="dashboard-card">
        <h4>Sales Growth by Category</h4>
        <div class="chart-container">
          <canvas id="barChart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="dashboard-card">
        <h4>Sales Distribution</h4>
        <div class="chart-container">
          <canvas id="pieChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Area Chart Section (Revenue) -->
  <div class="dashboard-card">
    <h4>Revenue Trend</h4>
    <div class="chart-container">
      <canvas id="areaChart"></canvas>
    </div>
  </div>

  <!-- Recent Transactions Table -->
  <div class="transaction-table">
    <h5>Recent Transactions</h5>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Customer Name</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>John Doe</td>
          <td>Vegetables</td>
          <td>10kg</td>
          <td>$30</td>
          <td><span class="badge badge-success">Completed</span></td>
        </tr>
        <tr>
          <td>Mary Smith</td>
          <td>Fruits</td>
          <td>5kg</td>
          <td>$15</td>
          <td><span class="badge badge-warning">Pending</span></td>
        </tr>
        <tr>
          <td>James Brown</td>
          <td>Grains</td>
          <td>20kg</td>
          <td>$50</td>
          <td><span class="badge badge-danger">Cancelled</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Chart Initialization -->
<script>
  // Bar Chart
  const barCtx = document.getElementById('barChart').getContext('2d');
  const barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
      labels: ['Vegetables', 'Fruits', 'Grains'],
      datasets: [{
        label: 'Sales Growth (%)',
        data: [12, 8, 5],
        backgroundColor: ['#4caf50', '#ff9800', '#03a9f4'],
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true
        }
      },
      animation: {
        duration: 1000,
        easing: 'easeOutBounce'
      }
    }
  });

  // Pie Chart
  const pieCtx = document.getElementById('pieChart').getContext('2d');
  const pieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
      labels: ['Vegetables', 'Fruits', 'Grains'],
      datasets: [{
        label: 'Sales Distribution',
        data: [12000, 5000, 3000],
        backgroundColor: ['#4caf50', '#ff9800', '#03a9f4'],
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: {
        animateRotate: true,
        duration: 1000
      }
    }
  });

  // Area Chart (Revenue Trend)
  const areaCtx = document.getElementById('areaChart').getContext('2d');
  const areaChart = new Chart(areaCtx, {
    type: 'line',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June'],
      datasets: [{
        label: 'Revenue ($)',
        data: [3000, 4000, 3200, 4500, 3800, 5000],
        fill: true,
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script type="text/javascript">
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({
          pageLanguage: 'en',
          includedLanguages: 'en,ta',
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
      }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
