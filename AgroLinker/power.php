<?php
// Database credentials
$servername = "localhost"; // Change if necessary
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "farmer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data
$sql = "SELECT * FROM officer";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EB Officer Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Roboto', sans-serif;
        }
        .container {
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        h2 {
            color: #4A90E2;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            margin-top: 20px;
        }
        th {
            background-color: #4A90E2;
            color: white;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2><i class="fas fa-bolt"></i> EB Officer Details</h2>

        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered table-striped'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Officer Name</th>
                            <th>Village Name</th>
                            <th>Available Date</th>
                            <th>Available Time</th>
                            <th>Duration (hours)</th>
                            <th>Power Load (MW)</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['officer_name']) . "</td>
                        <td>" . htmlspecialchars($row['village_name']) . "</td>
                        <td>" . htmlspecialchars($row['available_date']) . "</td>
                        <td>" . htmlspecialchars($row['available_time']) . "</td>
                        <td>" . htmlspecialchars($row['availability_duration']) . "</td>
                        <td>" . htmlspecialchars($row['power_load']) . "</td>
                        <td>" . htmlspecialchars($row['created_at']) . "</td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning'>0 results found</div>";
        }

        $conn->close();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>






    <?php
// Database credentials
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "farmer"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $farmerName = $conn->real_escape_string($_POST['farmerName']);
    $villageName = $conn->real_escape_string($_POST['villageName']);
    $reminderDate = $conn->real_escape_string($_POST['reminderDate']);
    $reminderTime = $conn->real_escape_string($_POST['reminderTime']);
    $duration = intval($_POST['duration']);
    
    // Ensure the 'farmerPhone' key is being correctly retrieved
    if (isset($_POST['farmerPhone'])) {
        $farmerPhone = $conn->real_escape_string($_POST['farmerPhone']);
    } else {
        $farmerPhone = null; // Assign a default value or handle the error appropriately
    }

    // Check if phone is not empty
    if ($farmerPhone !== null && $farmerPhone !== '') {
        // Prepare SQL query to insert reminder data
        $sql = "INSERT INTO remainders (farmer_name, village_name, reminder_date, reminder_time, duration, farmer_phone) 
                VALUES ('$farmerName', '$villageName', '$reminderDate', '$reminderTime', $duration, '$farmerPhone')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "Reminder set successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Phone number is required!";
    }
    
    // Close the connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Electricity Reminder</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            max-width: 1200px;
            background: white;
            padding: 40px;
            margin-top: 50px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #4A90E2;
        }

        .form-group label {
            font-weight: 600;
            color: #333;
        }

        .form-control {
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            border: 1px solid #ddd;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #4A90E2;
            box-shadow: none;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #4A90E2;
            border-color: #4A90E2;
        }

        .btn-primary:hover {
            background-color: #357ABD;
            border-color: #357ABD;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Set Electricity Reminder</h2>
        <form action="power.php" method="POST">
            <div class="form-group">
                <label for="farmerName">Farmer Name</label>
                <input type="text" class="form-control" id="farmerName" name="farmerName" placeholder="Enter your name" required>
            </div>

            <div class="form-group mt-3">
                <label for="villageName">Village Name</label>
                <select id="villageName" class="form-control" name="villageName" required>
                    <option value="" disabled selected>Select Village</option>
                    <option value="Krishnarayapuram">Krishnarayapuram</option>
                    <option value="Thogaimalai">Thogaimalai</option>
                    <option value="Gandhigramam">Gandhigramam</option>
                    <option value="Thanthonimalai">Thanthonimalai</option>
                    <option value="Dharapuram">Dharapuram</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="reminderDate">Select Date</label>
                <input type="date" class="form-control" id="reminderDate" name="reminderDate" required>
            </div>

            <div class="form-group mt-3">
                <label for="reminderTime">Select Time</label>
                <input type="time" class="form-control" id="reminderTime" name="reminderTime" required>
            </div>

            <div class="form-group mt-3">
                <label for="duration">Duration (hours)</label>
                <input type="number" class="form-control" id="duration" name="duration" placeholder="Enter the duration in hours" required>
            </div>

            <div class="form-group mt-3">
                <label for="farmerPhone">Farmer Phone Number</label>
                <input type="text" class="form-control" id="farmerPhone" name="farmerPhone" placeholder="Enter your phone number" required>
            </div>

            <div class="button-group mt-4">
                <button type="submit" class="btn btn-primary">Set Reminder</button>
            </div>
        </form>

        <p class="footer-text">We'll notify you when the electricity is available as per your reminder.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>