<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmer Dashboard - Customer Demographics</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .icon {
      width: 50px;
      height: 50px;
      margin-right: 10px;
    }
    .section-title {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }
    .card-title {
      font-size: 20px;
    }
    .icon-text {
      font-size: 16px;
      margin-left: 10px;
    }
    .list-group-item {
      font-size: 16px;
    }
  </style>
</head>
<body>

  <div class="container my-5">
    <h2 class="text-center mb-4">Customer Demographics</h2>
    <div class="row">
      <!-- Geographical Distribution (Chart) -->
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title text-center">Top States Buying Your Products</h5>
            <canvas id="geoChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Customer Categories -->
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title text-center">Who Buys from You?</h5>
            <div class="d-flex align-items-center mb-3">
              <img src="https://img.icons8.com/fluency/48/wholesale.png" alt="Wholesale" class="icon">
              <span class="icon-text">Wholesale Buyers: Shops buy large quantities.</span>
            </div>
            <div class="d-flex align-items-center">
              <img src="https://img.icons8.com/fluency/48/retail.png" alt="Retail" class="icon">
              <span class="icon-text">Retail Buyers: Small buyers buy direct.</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Product Types -->
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title text-center">Most Sold Products</h5>
            <ul class="list-group">
              <li class="list-group-item">Grains (Rice, Wheat)</li>
              <li class="list-group-item">Vegetables (Tomatoes, Carrots)</li>
              <li class="list-group-item">Fruits (Bananas, Mangoes)</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Payment Methods -->
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title text-center">How Customers Pay You</h5>
            <div class="d-flex align-items-center mb-3">
              <img src="https://img.icons8.com/fluency/48/cash.png" alt="Cash" class="icon">
              <span class="icon-text">Cash on Delivery: Many customers pay with cash.</span>
            </div>
            <div class="d-flex align-items-center">
              <img src="https://img.icons8.com/fluency/48/bank.png" alt="Bank Transfer" class="icon">
              <span class="icon-text">Bank Transfer: Some use direct transfers.</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Feedback Section -->
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title text-center">What Buyers Say About You</h5>
            <div class="d-flex align-items-center mb-3">
              <img src="https://img.icons8.com/fluency/48/star.png" alt="Feedback" class="icon">
              <span class="icon-text">"Great quality products!" - Shop owner, Tamil Nadu</span>
            </div>
            <div class="d-flex align-items-center">
              <img src="https://img.icons8.com/fluency/48/star.png" alt="Feedback" class="icon">
              <span class="icon-text">"Fast delivery and excellent service." - Buyer from Karnataka</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('geoChart').getContext('2d');
    const geoChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Tamil Nadu', 'Karnataka', 'Kerala'],
        datasets: [{
          data: [60, 25, 15],
          backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
            position: 'bottom'
          }
        }
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
