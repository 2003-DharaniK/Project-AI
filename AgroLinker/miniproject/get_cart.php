<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agrolinker";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cart";
$result = $conn->query($sql);

$cartItems = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }
}

echo json_encode($cartItems);
$conn->close();
?>
