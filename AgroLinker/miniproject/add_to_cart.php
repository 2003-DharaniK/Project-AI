<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agrolinker";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product = $_POST['product'];
$price = $_POST['price'];
$image = $_POST['image'];

$sql = "INSERT INTO cart (product_name, product_price, product_image) VALUES ('$product', '$price', '$image')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]); 
}

$conn->close();
?>
