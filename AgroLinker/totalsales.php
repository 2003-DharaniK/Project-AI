<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Interaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Total Sales Card -->
    <div class="container mt-5">
        <div class="card text-center" id="totalSalesCard" onclick="showSalesBreakdown()">
            <div class="card-body">
                <h5 class="card-title">Total Sales</h5>
                <h3>$20,000</h3>
                <small class="text-muted">+5% from last week</small>
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
                    <form id="newSaleForm">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" placeholder="Enter product name">
                        </div>
                        <div class="mb-3">
                            <label for="quantitySold" class="form-label">Quantity Sold</label>
                            <input type="number" class="form-control" id="quantitySold" placeholder="Enter quantity">
                        </div>
                        <div class="mb-3">
                            <label for="totalAmount" class="form-label">Total Amount</label>
                            <input type="number" class="form-control" id="totalAmount" placeholder="Enter total amount">
                        </div>
                        <div class="mb-3">
                            <label for="saleDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="saleDate">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Sale</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Show Sales Breakdown Modal
        function showSalesBreakdown() {
            var salesBreakdownModal = new bootstrap.Modal(document.getElementById('salesBreakdownModal'));
            salesBreakdownModal.show();
            drawSalesChart();
        }

        // Show Sales Form Modal
        function showSalesForm() {
            var salesFormModal = new bootstrap.Modal(document.getElementById('salesFormModal'));
            salesFormModal.show();
        }

        // Draw Sales Chart
        function drawSalesChart() {
            var ctx = document.getElementById('salesChart').getContext('2d');
            var salesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Tomatoes', 'Carrots', 'Onions', 'Potatoes'],
                    datasets: [{
                        label: 'Sales in $',
                        data: [5000, 3000, 2000, 1000],
                        backgroundColor: ['#28a745', '#17a2b8', '#ffc107', '#dc3545'],
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
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
