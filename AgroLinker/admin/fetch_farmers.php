<?php
// fetch_farmers.php

// Set headers to allow cross-origin requests and return a JSON response
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Database connection details
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "farmer";

// Create connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all details exactly matching the column names in your database
$sql = "SELECT id, farmer_name, product_name, quantity, price, product_image, 
        account_holder_name, account_number, ifsc_code, bank_name, branch_name, mobile_number, upi_id 
        FROM products";

// Execute the query
$result = $conn->query($sql);

$products = []; // Initialize an empty array to store the fetched products

if ($result->num_rows > 0) {
    // Fetch each row as an associative array and add it to the products array
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'id' => $row['id'],
            'farmer_name' => $row['farmer_name'],
            'product_name' => $row['product_name'],
            'quantity' => $row['quantity'],
            'price' => $row['price'],
            'product_image' => $row['product_image'],
            'account_holder_name' => $row['account_holder_name'],
            'account_number' => $row['account_number'],
            'ifsc_code' => $row['ifsc_code'],
            'bank_name' => $row['bank_name'],
            'branch_name' => $row['branch_name'],
            'mobile_number' => $row['mobile_number'],
            'upi_id' => $row['upi_id']
        ];
    }

    // Return the products as a JSON-encoded response
    echo json_encode($products);

} else {
    // Return an error message if no products are found
    echo json_encode([
        'status' => 'error',
        'message' => 'No products found.'
    ]);
}

// Close the database connection
$conn->close();
?>