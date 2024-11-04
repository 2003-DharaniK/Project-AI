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

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $officerName = $_POST['officerName'];
    $villageName = $_POST['villageName'];
    $availableDate = $_POST['availableDate'];
    $availableTime = $_POST['availableTime'];
    $availabilityDuration = $_POST['availabilityDuration'];
    $powerLoad = $_POST['powerLoad'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO officer (officer_name, village_name, available_date, available_time, availability_duration, power_load) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssid", $officerName, $villageName, $availableDate, $availableTime, $availabilityDuration, $powerLoad);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EB Officer Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Roboto', sans-serif;
        }
        .container {
            margin-top: 50px;
            background: white;
            padding: 30px;  /* Reduced padding for a smaller container */
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            max-width: 500px; /* Set a maximum width for the container */
            margin-left: auto;  /* Centering the container */
            margin-right: auto; /* Centering the container */
        }
        h2 {
            color: #4A90E2;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: 500;
            color: #4A90E2;
        }
        .btn-primary {
            background-color: #4A90E2;
            border-color: #4A90E2;
            font-weight: bold;
            padding: 8px 15px;  /* Reduced padding for a smaller button */
            font-size: 16px;     /* Reduced font size */
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #357ABD;
            border-color: #357ABD;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .input-group-text {
            background-color: #4A90E2;
            color: white;
            font-weight: bold;
        }
        #successMessage {
            font-weight: bold;
            font-size: 18px;
        }
        .form-control {
            font-size: 16px;
            border-radius: 20px;
        }
        .fa-check-circle {
            margin-right: 8px;
            color: #28A745;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group input, .input-group select {
            border-radius: 20px;
        }
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2><i class="fas fa-bolt"></i> EB Officer - Update Electricity Availability</h2>
        <form id="ebForm" class="my-4" action="officer.php" method="POST">
            <!-- Officer Name -->
            <div class="mb-4 input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" id="officerName" class="form-control" placeholder="Officer Name" required>
            </div>

            <!-- Village Name Dropdown -->
            <div class="mb-4 input-group">
                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                <select id="villageName" class="form-control" required>
                    <option value="" disabled selected>Select Village</option>
                    <option value="Krishnarayapuram">Krishnarayapuram</option>
                    <option value="Thogaimalai">Thogaimalai</option>
                    <option value="Gandhigramam">Gandhigramam</option>
                    <option value="Thanthonimalai">Thanthonimalai</option>
                    <option value="Dharapuram">Dharapuram</option>
                </select>
            </div>

            <!-- Date of Electricity Availability -->
            <div class="mb-4 input-group">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                <input type="date" id="availableDate" class="form-control" required placeholder="Select Date">
            </div>

            <!-- Time of Electricity Availability -->
            <div class="mb-4 input-group">
                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                <input type="time" id="availableTime" class="form-control" required>
            </div>

            <!-- Duration of Electricity Availability -->
            <div class="mb-4 input-group">
                <span class="input-group-text"><i class="fas fa-hourglass-half"></i></span>
                <input type="number" id="availabilityDuration" class="form-control" min="1" max="24" placeholder="Duration (hours)" required>
            </div>

            <!-- Power Load (MW) Field -->
            <div class="mb-4 input-group">
                <span class="input-group-text"><i class="fas fa-bolt"></i></span>
                <input type="number" id="powerLoad" class="form-control" min="1" max="500" placeholder="Power Load (MW)" required>
            </div>

            <!-- Update Button -->
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-upload"></i> Update Availability</button>
        </form>

        <div id="successMessage" class="alert alert-success text-center" style="display: none;">
            <i class="fas fa-check-circle"></i> Electricity availability updated successfully!
        </div>
    </div>

    <script>
        document.getElementById('ebForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const officer = document.getElementById('officerName').value;
            const village = document.getElementById('villageName').value;
            const date = document.getElementById('availableDate').value;
            const time = document.getElementById('availableTime').value;
            const duration = document.getElementById('availabilityDuration').value;
            const powerLoad = document.getElementById('powerLoad').value;

            // Code to send data to the backend (e.g., via AJAX or form submission)
            console.log(`Officer: ${officer}, Village: ${village}, Date: ${date}, Time: ${time}, Duration: ${duration} hours, Power Load: ${powerLoad} MW`);

            // Display success message
            document.getElementById('successMessage').style.display = 'block';
        });


        document.getElementById('ebForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const officer = document.getElementById('officerName').value;
    const village = document.getElementById('villageName').value;
    const date = document.getElementById('availableDate').value;
    const time = document.getElementById('availableTime').value;
    const duration = document.getElementById('availabilityDuration').value;
    const powerLoad = document.getElementById('powerLoad').value;

    const data = new FormData();
    data.append('officerName', officer);
    data.append('villageName', village);
    data.append('availableDate', date);
    data.append('availableTime', time);
    data.append('availabilityDuration', duration);
    data.append('powerLoad', powerLoad);

    fetch('officer.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Log the response
        document.getElementById('successMessage').style.display = 'block';
    })
    .catch(error => console.error('Error:', error));
});

    </script>

</body>
</html>
