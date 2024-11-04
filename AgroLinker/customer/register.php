<?php
// Database connection
$host = 'localhost';
$dbname = 'farmer';
$username = 'root';  // change to your database username
$password = '';      // change to your database password

$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $mobileNo = mysqli_real_escape_string($conn, $_POST['mobileNo']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $customerType = mysqli_real_escape_string($conn, $_POST['Customertype']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pinCode = mysqli_real_escape_string($conn, $_POST['pinCode']);

    // Validate that the passwords match
    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit();
    }

    // Check if email already exists
    $checkEmailQuery = "SELECT * FROM custoreg WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);
    
    if ($result->num_rows > 0) {
        // Email already exists, show an error message
        echo "Email already exists! Please use a different email.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new customer record
        $sql = "INSERT INTO custoreg (fullName, email, gender, mobileNo, password, state, customerType, address, pinCode)
                VALUES ('$fullName', '$email', '$gender', '$mobileNo', '$hashedPassword', '$state', '$customerType', '$address', '$pinCode')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to the same page with a success message in the URL
            header("Location: login.php?success=true");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>



<!-- HTML Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            background: url('img.jpg') no-repeat center center fixed; /* Change the URL to your image path */
            background-size: cover;
        }

        .section-heading {
            color: #388e3c;
            font-size: 20px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .container {
            width: 70%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Two columns for side-by-side layout */
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: lighter;
            color: green;
        }

        input, select {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }

        input:focus, select:focus {
            border-color: #007bff;
            outline: none;
        }

        .verify-btn {
            margin-top: 5px;
            padding: 10px;
            font-size: 0.9rem;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .verify-btn:hover {
            background-color: #218838;
        }

        .small-btn {
            padding: 5px 10px;
            font-size: 12px;
            width: 80px;
            height: 30px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        .small-btn:hover {
            background-color: #45a049;
        }

        /* Popup box styles */


    </style>
</head>
<body>

    <div class="container">
        <h2>Register for New Customer</h2>

        <div class="section-heading">Customer Details</div>

        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="fullName">Full Name *</label>
                <input type="text" id="fullName" name="fullName" placeholder="Enter Farmer Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="gender">gender *</label>
                <select id="gender" name="gender" required>
                    <option>Select Gender</option>
                    <option>Female</option>
                    <option>male</option>
                </select>
            </div>
            <div class="form-group">
                <label for="mobileNo">Mobile No. *</label>
                <input type="tel" id="mobileNo" name="mobileNo" placeholder="Enter 10 digit mobile number" pattern="[0-9]{10}" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>

            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password *</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
            </div>
            
            <div class="form-group">
                <label for="state">State *</label>
                <select id="state" name="state" required>
                    <option>Select State</option>
                    <option>Tamil Nadu</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Customertype">Customertype</label>
                <select id="Customertype" name="Customertype" required>
                    <option>select Customertype</option>
                    <option>Individual</option>
                    <option>Bussiness</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Address *</label>
                <input type="text" id="address" name="address" placeholder="Enter Address" required>
            </div>
            <div class="form-group">
                <label for="pinCode">Pin Code *</label>
                <input type="text" id="pinCode" name="pinCode" placeholder="Enter Pin Code" required>
            </div>

            <button type="submit" class="small-btn">Submit</button>
        </form>
    </div>


    
</body>
</html>
