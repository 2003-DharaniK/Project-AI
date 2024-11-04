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
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if email exists in the database
    $sql = "SELECT id, password FROM custoreg WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);  // "s" is the type for string
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User exists, now verify the password
        $stmt->bind_result($userId, $hashedPassword);
        $stmt->fetch();

        // Verify the password using password_verify
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set session and redirect
            session_start();
            $_SESSION['user_id'] = $userId;
            $_SESSION['email'] = $email;
            header("Location:http://localhost/AgroLinker/miniproject/index.html"); // Redirect to the dashboard or another page
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* Basic styling */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body, html {
            height: 100%;
            font-family: Arial, sans-serif;
        }

        /* Background Image */
        .bg {
            background-image: url('imgs.png'); /* Replace with your image path */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Overlay to darken the background */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay */
        }

        /* Login Form Container */
        .login-container {
            position: relative;
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #388e3c;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            color: #388e3c;
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            background-color: #388e3c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        .link {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #388e3c;
        }

        .link a {
            color: #388e3c;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="bg">
        <div class="overlay"></div>
        <div class="login-container">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <!-- Email input field -->
                <div class="input-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                
                <!-- Password input field -->
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <!-- Login Button -->
                <button type="submit">Login</button>
            </form>
            <!-- Additional links -->
            <div class="link">
                <a href="forgot-password.php">Forgot Password?</a>
                <br>
                <br>
                <p>If you haven't registered yet</p>
                <br>
                <a href="register.php"> Register Here</a>
            </div>
        </div>
    </div>

</body>
</html>
