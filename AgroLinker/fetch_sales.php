<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "farmer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch sales data from the database
$sql = "SELECT product_name, quantity_sold, total_amount, sale_date FROM sales";
$result = $conn->query($sql);

$sales = [];

if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    $sales[] = $row;
  }
}

// Return the data as JSON
echo json_encode($sales);

// Close connection
$conn->close();
?>
