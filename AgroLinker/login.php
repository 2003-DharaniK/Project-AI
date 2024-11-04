<?php
// Start the session
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";  // Change if necessary
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$dbname = "farmer";         // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data and sanitize it
    $mobileNo = $conn->real_escape_string($_POST['mobileNo']);
    $password = $_POST['password'];

    // Check if the mobile number exists in the database
    $stmt = $conn->prepare("SELECT * FROM registration WHERE mobileNo = ?");
    $stmt->bind_param("s", $mobileNo);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify the entered password with the stored hashed password
        if (password_verify($password, $user['password'])) {
            // Set session variables for the logged-in user
            $_SESSION['user_id'] = $user['id'];  // Assuming 'id' is the user's unique ID
            $_SESSION['mobileNo'] = $user['mobileNo'];
            $_SESSION['fullName'] = $user['fullName'];

            // Redirect to the dashboard or home page
            header("Location: index.php");
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        // Mobile number not found
        echo "<script>alert('Mobile number not registered!');</script>";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('vivasayi.jpg') no-repeat center center fixed; /* Replace 'background.jpg' with the actual image file path */
            background-size: cover;
        }

        .login-container {
            width: 350px;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .login-btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }

        .login-btn:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .forgot-password {
            text-align: center;
            display: block;
            margin-top: 10px;
            color: #007bff;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .register-container {
            text-align: center;
            margin-top: 20px;
        }

        .register-link {
            color: #007bff;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form onsubmit="return validateForm()" method="POST" action="login.php">

            <div class="form-group">
                <label for="mobileNo">Mobile Number:</label>
                <input type="text" id="mobileNo" name="mobileNo" placeholder="Enter your mobile number" required>
                <div id="mobileNoError" class="error"></div>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <div id="passwordError" class="error"></div>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <a href="#" class="forgot-password">Forgot Password?</a>

        <div class="register-container">
            <p>If you haven't registered yet, <a href="register.php" class="register-link">Register Here</a></p>
        </div>
    </div>

    <script>
        function validateForm() {
            var mobileNo = document.getElementById("mobileNo").value;
            var password = document.getElementById("password").value;
            var mobileNoError = document.getElementById("mobileNoError");
            var passwordError = document.getElementById("passwordError");

            mobileNoError.textContent = "";
            passwordError.textContent = "";

            // Mobile number validation
            if (!mobileNo) {
                mobileNoError.textContent = "Mobile number is required";
                return false;
            }

            if (!/^\d{10}$/.test(mobileNo)) {  // Ensure mobile number is 10 digits long
                mobileNoError.textContent = "Please enter a valid 10-digit mobile number";
                return false;
            }

            // Password validation
            if (!password) {
                passwordError.textContent = "Password is required";
                return false;
            }

            if (password.length < 6) {
                passwordError.textContent = "Password must be at least 6 characters";
                return false;
            }

            // Add form submission logic here (e.g., redirect or form handling)
            return true;
        }
    </script>

<script type="text/javascript">
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({
          pageLanguage: 'en',
          includedLanguages: 'en,ta',
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
      }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>
