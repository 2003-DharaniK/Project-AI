<?php
// Database credentials
$servername = "localhost"; // Change if necessary
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "farmer"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data
$sql = "SELECT * FROM officer";
$result = $conn->query($sql);

// Check for errors in the query
if (!$result) {
    die("Query failed: " . $conn->error);
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include Composer's autoload file for Twilio SDK
require_once 'vendor/autoload.php'; 
use Twilio\Rest\Client;

// Function to send SMS
function sendSMS($farmerPhoneNumber, $message) {
    $sid = ''; // Twilio Account SID
    $token = ''; // Twilio Auth Token
    $twilioNumber = ''; // Twilio Phone Number

    $client = new Client($sid, $token);

    try {
        $client->messages->create(
            $farmerPhoneNumber, // Farmer's phone number
            array(
                'from' => $twilioNumber,
                'body' => $message
            )
        );
        return "SMS sent successfully!";
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

// Function to generate SMS message content in Tamil
function generateMessage($officerDetails) {
    $message = "விளக்கம்: EB அதிகாரி " . $officerDetails['officer_name'] . " உங்கள் கிராமத்தில், " . 
               $officerDetails['village_name'] . " தேதி: " . $officerDetails['available_date'] .
               " நேரம்: " . $officerDetails['available_time'] . " மின்சாரம் கிடைக்கும். MW: " . 
               $officerDetails['power_load'] . ". அதிகம் பயன்படுத்த வேண்டாம்.";
    return $message;
}
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
                            <th>Send SMS</th>
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
                        <td><button type='button' class='btn btn-primary' onclick='sendSMS(" . $row['id'] . ")'>Send SMS</button></td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning'>0 results found</div>";
        }

        $conn->close();
        ?>
    </div>

<script>
function sendSMS(officerId) {
    // Make an AJAX request to your PHP script to send the SMS
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "send_sms.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText); // Alert with the success/failure message
        }
    };
    xhr.send("id=" + officerId); // Send officer ID to the PHP script
}
</script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
