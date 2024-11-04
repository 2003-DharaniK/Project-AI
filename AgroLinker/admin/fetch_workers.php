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

// Fetch worker details
$sql = "SELECT * FROM workers";
$result = $conn->query($sql);

$workers = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $workers[] = $row;
    }
}

echo json_encode($workers);
$conn->close();
?>
