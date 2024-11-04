<?php
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "farmer"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => "Connection failed: " . $conn->connect_error]));
}

// Prepare and execute the SQL queries to count distinct farmers and total products
$uniqueFarmersQuery = "SELECT COUNT(DISTINCT farmer_name) as totalFarmers FROM products";
$totalProductsQuery = "SELECT COUNT(*) as totalProducts FROM products";

$uniqueFarmersResult = $conn->query($uniqueFarmersQuery);
$totalProductsResult = $conn->query($totalProductsQuery);

if ($uniqueFarmersResult && $totalProductsResult) {
    $totalFarmers = $uniqueFarmersResult->fetch_assoc()['totalFarmers'];
    $totalProducts = $totalProductsResult->fetch_assoc()['totalProducts'];

    // Create an array for the response
    $response = [
        'totalFarmers' => $totalFarmers,
        'totalProducts' => $totalProducts
    ];

    // Return the response as JSON
    echo json_encode($response);
} else {
    // Return error if any query fails
    echo json_encode(['error' => 'Failed to fetch data from the database']);
}

// Close the database connection
$conn->close();