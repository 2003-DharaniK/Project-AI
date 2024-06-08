<?php
$username = $_POST['email'];
$password = $_POST['password'];

// Database connection
$con = new mysqli("localhost", "root", "", "ecoproduct");
if ($con->connect_error) {
    die("Failed to connect: " . $con->connect_error);
} else {
    $stmt = $con->prepare("SELECT * FROM signup WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        if ($data['password'] === $password) {
            header('location:home.html');

        } else {
            echo "<h2>Invalid password</h2>";
        }
    } else {
        echo "<h2>Email not found</h2>";
    }
}
?>
