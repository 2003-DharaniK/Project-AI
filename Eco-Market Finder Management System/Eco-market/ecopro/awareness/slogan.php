<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecoproduct";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to insert a new slogan into the database
function insertSlogan($conn, $sloganText, $imagePath) {
    $sql = "INSERT INTO slogans (SloganText, ImagePath) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $sloganText, $imagePath);
    
    if ($stmt->execute() === TRUE) {
        echo "Slogan inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $stmt->close();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(isset($_POST['slogan1']) && !empty($_POST['slogan1'])) {
        $slogan1 = $_POST['slogan1'];
        $imagePath1 = "animal.jpg"; 
        insertSlogan($conn, $slogan1, $imagePath1);
    }
    if(isset($_POST['slogan2']) && !empty($_POST['slogan2'])) {
        $slogan2 = $_POST['slogan2'];
        $imagePath2 = "food.jpg"; 
        insertSlogan($conn, $slogan2, $imagePath2);
    }
    if(isset($_POST['slogan3']) && !empty($_POST['slogan3'])) {
        $slogan3 = $_POST['slogan3'];
        $imagePath3 = "land.jpg"; 
        insertSlogan($conn, $slogan3, $imagePath3);
    }
    if(isset($_POST['slogan4']) && !empty($_POST['slogan4'])) {
        $slogan4 = $_POST['slogan4'];
        $imagePath4 = "selling.jpg"; 
        insertSlogan($conn, $slogan4, $imagePath4);
    }
}

// Close connection
$conn->close();
?>
