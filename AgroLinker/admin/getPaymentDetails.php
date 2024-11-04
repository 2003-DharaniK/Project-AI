<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmer"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode([
        'status' => 'error',
        'message' => 'Database connection failed: ' . $conn->connect_error
    ]));
}

// Get the farmerId from the URL
$farmerId = isset($_GET['farmerId']) ? intval($_GET['farmerId']) : 0;

if ($farmerId > 0) {
    // Fetch the farmer and product details based on farmerId
    $sql = "SELECT id, farmer_name, product_name, quantity, price, product_image, account_holder_name, account_number, 
            ifsc_code, bank_name, branch_name, mobile_number, upi_id 
            FROM products WHERE id = $farmerId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Return success and farmer details
        echo json_encode([
            'status' => 'success',
            'paymentDetails' => [
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
            ]
        ]);
    } else {
        // If no farmer is found with the given ID
        echo json_encode([
            'status' => 'error',
            'message' => 'No farmer found with the provided ID.'
        ]);
    }
} else {
    // If farmerId is missing or invalid
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid farmer ID.'
    ]);
}

$conn->close();
?>