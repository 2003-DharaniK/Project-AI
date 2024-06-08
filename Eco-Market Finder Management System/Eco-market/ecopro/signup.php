<?php

$name = $_POST['name'];
$email  = $_POST['email'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];

if (!empty($name) || !empty($email) || !empty($password) || !empty($confirmpassword)) {

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "ecoproduct";

    // Create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT email From signup Where email = ? Limit 1";
        $INSERT = "INSERT Into signup (name , email ,password, confirmpassword )values(?,?,?,?)";

        //Prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        //checking username
        if ($rnum == 0) {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssss", $name, $email, $password, $confirmpassword);
            $stmt->execute();

            // Close database connection
            $conn->close();

            // Return success response
            echo json_encode(array("success" => true));
            exit();
        } else {
            echo json_encode(array("success" => false, "message" => "Someone already registered using this email"));
            exit();
        }
    }
} else {
    echo json_encode(array("success" => false, "message" => "All fields are required"));
    exit();
}
?>
