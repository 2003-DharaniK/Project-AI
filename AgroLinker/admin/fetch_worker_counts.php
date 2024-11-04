<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agrolinker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL queries
$totalManagersQuery = "SELECT COUNT(*) as totalManagers FROM workers WHERE position = 'Manager'";
$totalWorkersQuery = "SELECT COUNT(*) as totalWorkers FROM workers WHERE position = 'Worker'";
$totalCAsQuery = "SELECT COUNT(*) as totalCAs FROM workers WHERE position = 'CA'";

$totalManagersResult = $conn->query($totalManagersQuery);
$totalWorkersResult = $conn->query($totalWorkersQuery);
$totalCAsResult = $conn->query($totalCAsQuery);

$totalManagers = $totalManagersResult->fetch_assoc()['totalManagers'];
$totalWorkers = $totalWorkersResult->fetch_assoc()['totalWorkers'];
$totalCAs = $totalCAsResult->fetch_assoc()['totalCAs'];

// Create an array for the response
$response = [
    'totalManagers' => $totalManagers,
    'totalWorkers' => $totalWorkers,
    'totalCAs' => $totalCAs,
];

// Return the response as JSON
echo json_encode($response);
$conn->close();
?>
