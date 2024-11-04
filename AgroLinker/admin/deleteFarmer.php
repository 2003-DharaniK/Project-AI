<?php
// Database connection parameters
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

// Check if farmerId is set and is valid
if (isset($_GET['farmerId']) && is_numeric($_GET['farmerId'])) {
    $farmerId = $_GET['farmerId'];

    // Log the farmerId for debugging
    error_log("Received farmerId: " . $farmerId); // Log the farmerId for debugging

    // SQL query to delete the farmer's product
    $sql = "DELETE FROM products WHERE id = ?";
    
    // Prepare and bind
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $farmerId);

        // Execute the statement
        if ($stmt->execute()) {
            echo 'success';
        } else {
            error_log('Error executing query: ' . $stmt->error); // Log SQL error
            echo 'Error executing query: ' . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo 'Error preparing statement: ' . $conn->error;
        echo 'Error preparing statement.';
    }
} else {
    echo 'Invalid farmer ID.';
}

// Close the connection
$conn->close();
?>
