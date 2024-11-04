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

// Get form data
$product_name = $_POST['productName'];
$quantity_sold = $_POST['quantitySold'];
$total_amount = $_POST['totalAmount'];
$sale_date = $_POST['saleDate'];

// Insert the data into the database
$sql = "INSERT INTO sales (product_name, quantity_sold, total_amount, sale_date)
        VALUES ('$product_name', $quantity_sold, $total_amount, '$sale_date')";

if ($conn->query($sql) === TRUE) {
  echo json_encode(["message" => "Sale added successfully"]);
} else {
  echo json_encode(["message" => "Error: " . $sql . "<br>" . $conn->error]);
}

// Close connection
$conn->close();
?>
