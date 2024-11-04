<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard - Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        .card-header {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .card {
            margin-bottom: 20px;
        }
        .order-timeline li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <h2 class="mb-3 text-center">Order Management</h2>

        <!-- Order Status Section -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>In Progress</h5>
                        <p><span id="in-progress-count">10</span> Orders</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Completed</h5>
                        <p><span id="completed-count">300</span> Orders</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Cancelled</h5>
                        <p><span id="cancelled-count">5</span> Orders</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Details Section -->
        <div class="card">
            <div class="card-header">Order Details</div>
            <div class="card-body">
                <ul>
                    <li><strong>Product:</strong> Rice, <strong>Quantity:</strong> 500kg, <strong>Price:</strong> $500</li>
                    <li><strong>Product:</strong> Coconut, <strong>Quantity:</strong> 200 units, <strong>Price:</strong> $300</li>
                </ul>
                <p><strong>Total Cost:</strong> $800</p>
            </div>
        </div>

        <!-- Order Timeline Section -->
        <div class="card">
            <div class="card-header">Order Timeline</div>
            <div class="card-body">
                <ul class="order-timeline">
                    <li><strong>Placed:</strong> October 20, 2024</li>
                    <li><strong>Confirmed:</strong> October 21, 2024</li>
                    <li><strong>Shipped:</strong> Expected by October 25, 2024</li>
                    <li><strong>Delivered:</strong> Expected by October 27, 2024</li>
                </ul>
            </div>
        </div>

        <!-- Bulk Discounts Section -->
        <div class="card">
            <div class="card-header">Bulk Discounts</div>
            <div class="card-body">
                <p><strong>Discount Applied:</strong> $50 (for orders above $500)</p>
                <p><strong>Final Total:</strong> $750</p>
            </div>
        </div>

        <!-- Repeat Orders Section -->
        <div class="card">
            <div class="card-header">Repeat Orders</div>
            <div class="card-body text-center">
                <button class="btn btn-primary" onclick="repeatOrder()">Repeat Previous Order</button>
            </div>
        </div>

        <!-- Shipping Information Section -->
        <div class="card">
            <div class="card-header">Shipping Information</div>
            <div class="card-body">
                <p><strong>Pick-up Scheduled:</strong> October 25, 2024</p>
                <p><strong>Delivery Expected:</strong> October 27, 2024</p>
            </div>
        </div>

        <!-- Payment Information Section -->
        <div class="card">
            <div class="card-header">Payment Information</div>
            <div class="card-body">
                <p><strong>Payment Method:</strong> Cash on Delivery</p>
                <p><strong>Total Amount:</strong> $750</p>
                <p><strong>Status:</strong> Pending</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Optional JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to handle "Repeat Previous Order" action
        function repeatOrder() {
            alert("Previous order has been repeated!");
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
