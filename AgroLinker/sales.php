<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sales Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f7f7f7;
    }
    .sales-card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 20px;
      cursor: pointer;
    }
    .sales-title {
      font-size: 1.5em;
      font-weight: bold;
    }
    .sales-value {
      font-size: 2.5em;
      color: #28a745;
    }
    .chart-placeholder {
      height: 200px;
      background-color: #e9ecef;
      border-radius: 5px;
    }
  </style>
</head>
<body>
<a href="javascript:history.back()" class="back-button" style="display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>
  <div class="container mt-5">
    <h2 class="mb-4">Sales Overview</h2>

    <!-- Total Sales -->
    <div class="row">
      <div class="col-md-4">
        <div class="sales-card text-center" id="totalSalesCard" onclick="showSalesBreakdown()">
          <div class="sales-title">Total Sales</div>
          <div class="sales-value">$20,000</div>
          <small class="text-muted">+5% from last week</small>
        </div>
      </div>

      <!-- Sales Growth -->
      <div class="col-md-4">
        <div class="sales-card text-center" onclick="window.location.href='salegrowth.php';">
          <div class="sales-title">Sales Growth</div>
          <div class="sales-value">+10%</div>
          <small class="text-muted">Weekly Comparison</small>
        </div>
      </div>

      <!-- Best-Selling Products -->
      <div class="col-md-4">
        <div class="sales-card text-center" onclick="window.location.href='bestsellpro.php';">
          <div class="sales-title">Best-Selling Products</div>
          <ul class="list-unstyled">
            <li>Tomatoes - 500 units</li>
            <li>Carrots - 300 units</li>
            <li>Potatoes - 200 units</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Sales by Category and Sales Trend -->
    <div class="row mt-4">
      <div class="col-md-6">
        <div class="sales-card" onclick="window.location.href='salescategory.php';">
          <div class="sales-title">Sales by Category</div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Vegetables: $12,000</li>
            <li class="list-group-item">Fruits: $5,000</li>
            <li class="list-group-item">Grains: $3,000</li>
          </ul>
        </div>
      </div>

      <div class="col-md-6">
        <div class="sales-card">
          <div class="sales-title">Sales Trend</div>
          <div class="chart-placeholder text-center">[Chart Placeholder]</div>
        </div>
      </div>
    </div>

    <!-- Customer Demographics and Returns -->
    <div class="row mt-4">
      <div class="col-md-6">
        <div class="sales-card" onclick="window.location.href='custodemo.php';">
          <div class="sales-title" >Customer Demographics</div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Tamil Nadu: 60%</li>
            <li class="list-group-item">Karnataka: 25%</li>
            <li class="list-group-item">Kerala: 15%</li>
          </ul>
        </div>
      </div>

      <div class="col-md-6">
        <div class="sales-card">
          <div class="sales-title">Returns and Refunds</div>
          <div class="sales-value">$500</div>
          <small class="text-muted">5 refunds processed this week</small>
        </div>
      </div>
    </div>

    <!-- Average Order Value -->
    <div class="row mt-4">
      <div class="col-md-4">
        <div class="sales-card text-center">
          <div class="sales-title">Average Order Value</div>
          <div class="sales-value">$62.50</div>
        </div>
      </div>
    </div>

    <!-- Sales Breakdown Modal -->
    <div class="modal fade" id="salesBreakdownModal" tabindex="-1" aria-labelledby="salesBreakdownModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="salesBreakdownModalLabel">Sales Breakdown</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Sales Chart (Placeholder) -->
            <div class="mb-4 text-center">
              <canvas id="salesChart" width="400" height="200"></canvas>
            </div>
            <!-- Table of Recent Sales -->
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Quantity Sold</th>
                  <th>Total Amount</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tomatoes</td>
                  <td>100 kg</td>
                  <td>$500</td>
                  <td>2024-10-15</td>
                </tr>
                <tr>
                  <td>Carrots</td>
                  <td>50 kg</td>
                  <td>$300</td>
                  <td>2024-10-13</td>
                </tr>
                <!-- More sales rows can go here -->
              </tbody>
            </table>
            <!-- Add New Sale Button -->
            <button type="button" class="btn btn-success" onclick="showSalesForm()">Add New Sale</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Sales Form Modal -->
    <div class="modal fade" id="salesFormModal" tabindex="-1" aria-labelledby="salesFormModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="salesFormModalLabel">Add New Sale</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Form for adding a new sale -->
            <form id="newSaleForm" method="POST">
  <div class="mb-3">
    <label for="productName" class="form-label">Product Name</label>
    <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
  </div>
  <div class="mb-3">
    <label for="quantitySold" class="form-label">Quantity Sold</label>
    <input type="number" class="form-control" id="quantitySold" name="quantitySold" placeholder="Enter quantity" required>
  </div>
  <div class="mb-3">
    <label for="totalAmount" class="form-label">Total Amount</label>
    <input type="number" class="form-control" id="totalAmount" name="totalAmount" placeholder="Enter total amount" required>
  </div>
  <div class="mb-3">
    <label for="saleDate" class="form-label">Date</label>
    <input type="date" class="form-control" id="saleDate" name="saleDate" required>
  </div>
  <button type="submit" class="btn btn-primary">Save Sale</button>
</form>

          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
    // Declare a variable to hold the chart instance
    let salesChartInstance;

    // Show Sales Breakdown Modal
    function showSalesBreakdown() {
      var salesBreakdownModal = new bootstrap.Modal(document.getElementById('salesBreakdownModal'));
      salesBreakdownModal.show();
      fetchSalesData(); // Fetch sales data when the modal is shown
    }

    // Show Sales Form Modal
    function showSalesForm() {
      var salesFormModal = new bootstrap.Modal(document.getElementById('salesFormModal'));
      salesFormModal.show();
    }

    // Fetch sales data and update the table and chart
    function fetchSalesData() {
      fetch('fetch_sales.php')
        .then(response => response.json())
        .then(data => {
          updateSalesTable(data);
          updateSalesChart(data); // Update the chart with fetched data
        })
        .catch(error => console.error('Error fetching sales data:', error));
    }

    // Update the sales table with fetched data
    function updateSalesTable(sales) {
      const tableBody = document.querySelector('#salesBreakdownModal tbody');
      tableBody.innerHTML = ''; // Clear the existing table data

      sales.forEach(sale => {
        const row = `
          <tr>
            <td>${sale.product_name}</td>
            <td>${sale.quantity_sold} kg</td>
            <td>$${sale.total_amount}</td>
            <td>${new Date(sale.sale_date).toLocaleDateString()}</td>
          </tr>
        `;
        tableBody.insertAdjacentHTML('beforeend', row);
      });
    }

    // Update the sales chart dynamically
    function updateSalesChart(sales) {
      const productNames = sales.map(sale => sale.product_name);
      const salesAmounts = sales.map(sale => sale.total_amount);

      // Check if the chart instance exists and destroy it
      if (salesChartInstance) {
        salesChartInstance.destroy();
      }

      var ctx = document.getElementById('salesChart').getContext('2d');
      salesChartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: productNames,
          datasets: [{
            label: 'Sales in USD',
            data: salesAmounts,
            backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#ff9f40', '#4bc0c0', '#9966ff'], // Add more colors as needed
          }]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true // Start y-axis at zero
            }
          }
        }
      });
    }

    // Add event listener to the form submission
    document.getElementById('newSaleForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const productName = document.getElementById('productName').value;
      const quantitySold = document.getElementById('quantitySold').value;
      const totalAmount = document.getElementById('totalAmount').value;
      const saleDate = document.getElementById('saleDate').value;

      const formData = new FormData();
      formData.append('productName', productName);
      formData.append('quantitySold', quantitySold);
      formData.append('totalAmount', totalAmount);
      formData.append('saleDate', saleDate);

      // Send the form data to the PHP backend
      fetch('add_sale.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        alert(data.message);
        document.getElementById('newSaleForm').reset();
        fetchSalesData(); // Fetch updated sales data
      })
      .catch(error => console.error('Error:', error));
    });
</script>


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
