<?php
// Database connection settings
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "farmer"; // Replace with your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $accountHolderName = $conn->real_escape_string($_POST['accountHolderName']);
    $accountNumber = $conn->real_escape_string($_POST['accountNumber']);
    $ifscCode = $conn->real_escape_string($_POST['ifscCode']);
    $bankName = $conn->real_escape_string($_POST['bankName']);
    $branchName = $conn->real_escape_string($_POST['branchName']);
    $mobileNumber = $conn->real_escape_string($_POST['mobileNumber']);
    $upiId = isset($_POST['upiId']) ? $conn->real_escape_string($_POST['upiId']) : NULL;

    // SQL query to insert the data
    $sql = "INSERT INTO payment_details (account_holder_name, account_number, ifsc_code, bank_name, branch_name, mobile_number, upi_id) 
            VALUES ('$accountHolderName', '$accountNumber', '$ifscCode', '$bankName', '$branchName', '$mobileNumber', '$upiId')";

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "Payment details submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 class="text-center mb-4">Submit Payment Details</h2>
    <form action="payment.php" method="POST">
        <!-- Bank Account Holder's Name -->
        <div class="mb-3">
            <label for="accountHolderName" class="form-label">Account Holder's Name:</label>
            <input type="text" class="form-control" id="accountHolderName" name="accountHolderName" required>
        </div>

        <!-- Bank Account Number -->
        <div class="mb-3">
            <label for="accountNumber" class="form-label">Account Number:</label>
            <input type="text" class="form-control" id="accountNumber" name="accountNumber" required>
        </div>

        <!-- IFSC Code -->
        <div class="mb-3">
            <label for="ifscCode" class="form-label">IFSC Code:</label>
            <input type="text" class="form-control" id="ifscCode" name="ifscCode" required>
        </div>

        <!-- Bank Name -->
        <div class="mb-3">
            <label for="bankName" class="form-label">Bank Name:</label>
            <input type="text" class="form-control" id="bankName" name="bankName" required>
        </div>

        <!-- Branch Name -->
        <div class="mb-3">
            <label for="branchName" class="form-label">Branch Name:</label>
            <input type="text" class="form-control" id="branchName" name="branchName" required>
        </div>

        <!-- Mobile Number (For OTP and Notifications) -->
        <div class="mb-3">
            <label for="mobileNumber" class="form-label">Mobile Number (Linked to Bank Account):</label>
            <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" required>
        </div>

        <!-- UPI ID (Optional) -->
        <div class="mb-3">
            <label for="upiId" class="form-label">UPI ID (Optional):</label>
            <input type="text" class="form-control" id="upiId" name="upiId">
        </div>
        
        <button type="submit" class="btn btn-primary w-100">Submit Payment Details</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>