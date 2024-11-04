<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "farmer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert product data into database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $units_sold = $_POST['units_sold'];
    $revenue = $_POST['revenue'];
    $growth_percentage = $_POST['growth_percentage'];

    $stmt = $conn->prepare("INSERT INTO bestsellpro (name, units_sold, revenue, growth_percentage) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siid", $name, $units_sold, $revenue, $growth_percentage);

    if ($stmt->execute()) {
        echo "New product added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch products from database
$result = $conn->query("SELECT * FROM bestsellpro");
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best-Selling Products Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #f0f0f3 0%, #f8f8fb 100%);
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }
        h2 {
            text-align: center;
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 40px;
            background: linear-gradient(90deg, #ff8a00, #ff6f61);
            background-clip: text;
            color: transparent;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group button {
            padding: 10px 15px;
            background-color: #ff6f61;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .form-group button:hover {
            background-color: #ff8a00;
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }
        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 25px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .card-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .product-units, .product-revenue, .product-growth {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .product-revenue {
            font-size: 22px;
            font-weight: bold;
        }
        /* Pie Chart styles */
        #bestSellingChart {
            max-width: 400px;
            margin: 20px auto;
        }
    </style>
</head>
<body>

<a href="javascript:history.back()" class="back-button" style="display: inline-block; margin-bottom: 25px; padding: 5px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 3px;">Go Back</a>
    <div class="container">
        <h2>Best-Selling Products Overview</h2>

        <!-- Form to add products -->
        <div class="form-container">
            <form method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="units_sold">Units Sold:</label>
                    <input type="number" name="units_sold" id="units_sold" required>
                </div>
                <div class="form-group">
                    <label for="revenue">Revenue:</label>
                    <input type="number" step="0.01" name="revenue" id="revenue" required>
                </div>
                <div class="form-group">
                    <label for="growth_percentage">Growth Percentage:</label>
                    <input type="number" step="0.01" name="growth_percentage" id="growth_percentage" required>
                </div>
                <div class="form-group">
                    <button type="submit">Add Product</button>
                </div>
            </form>
        </div>

        <!-- Dashboard for displaying products -->
        <div class="dashboard">
            <?php foreach ($products as $product): ?>
                <div class="card">
                    <div class="card-title"><?php echo htmlspecialchars($product['name']); ?></div>
                    <div class="product-units">Units Sold: <span><?php echo htmlspecialchars($product['units_sold']); ?></span></div>
                    <div class="product-revenue">Revenue: $<span><?php echo htmlspecialchars(number_format($product['revenue'], 2)); ?></span></div>
                    <div class="product-growth">Growth: <span><?php echo htmlspecialchars(number_format($product['growth_percentage'], 2)); ?>%</span></div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pie Chart for Best-Selling Product -->
        <canvas id="bestSellingChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Validation function for form inputs
        function validateForm() {
            let name = document.getElementById('name').value;
            let units_sold = document.getElementById('units_sold').value;
            let revenue = document.getElementById('revenue').value;
            let growth_percentage = document.getElementById('growth_percentage').value;

            if (!name || units_sold < 0 || revenue < 0 || growth_percentage < 0) {
                alert("Please enter valid inputs.");
                return false;
            }
            return true;
        }

        // Data for Pie Chart
        const ctx = document.getElementById('bestSellingChart').getContext('2d');
        const products = <?php echo json_encode($products); ?>;

        const labels = products.map(product => product.name);
        const data = products.map(product => product.units_sold);

        const bestSellingChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Units Sold',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' units';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
