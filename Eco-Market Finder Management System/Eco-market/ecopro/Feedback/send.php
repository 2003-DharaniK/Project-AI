<?php
// Database connection parameters
$servername = "localhost"; // Change this to your database server
$username = "root"; // Change this to your database username
$password =""; // Change this to your database password
$database = "ecoproduct"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $username = sanitize_input($_POST["username"]);
    $email = sanitize_input($_POST["email"]);
    $gender = sanitize_input($_POST["gender"]);
    $service_rating = sanitize_input($_POST["service_rating"]);
    $overall_experience = sanitize_input($_POST["overall_experience"]);
    $how_did_you_find_us = sanitize_input($_POST["how_did_you_find_us"]);
    $additional_suggestions = sanitize_input($_POST["additional_suggestions"]);

    // Prepare SQL statement to insert data into the feedback table
    $sql = "INSERT INTO feedback (username, email, gender, service_rating, overall_experience, how_did_you_find_us, additional_suggestions)
            VALUES ('$username', '$email', '$gender', '$service_rating', '$overall_experience', '$how_did_you_find_us', '$additional_suggestions')";

if ($conn->query($sql) === TRUE) {
    echo "<h1>Feedback submitted successfully!</h1>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

// Close database connection
$conn->close();
?>
