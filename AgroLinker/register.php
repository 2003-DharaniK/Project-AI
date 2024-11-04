<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "farmer";         

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $email = $conn->real_escape_string($_POST['email']);
    $relationship = $conn->real_escape_string($_POST['relationship']);
    $relativeName = $conn->real_escape_string($_POST['relativeName']);
    $mobileNo = $conn->real_escape_string($_POST['mobileNo']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
    $age = (int)$_POST['age'];  
    $casteCategory = $conn->real_escape_string($_POST['casteCategory']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $farmerType = $conn->real_escape_string($_POST['farmerType']);
    $farmerCategory = $conn->real_escape_string($_POST['farmerCategory']);
    $state = $conn->real_escape_string($_POST['state']);
    $district = $conn->real_escape_string($_POST['district']);
    $village = $conn->real_escape_string($_POST['village']);
    $address = $conn->real_escape_string($_POST['address']);
    $pinCode = $conn->real_escape_string($_POST['pinCode']);
    $kisanCreditCard = $conn->real_escape_string($_POST['kisanCreditCard']);

    // Image file handling
    $imageFile = $_FILES['farmerImage'];
    $imageName = $imageFile['name'];
    $imageTmpName = $imageFile['tmp_name'];
    $imageError = $imageFile['error'];
    $imageSize = $imageFile['size'];

    // Check if image upload is successful
    if ($imageError === 0) {
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (in_array($imageExt, $allowed)) {
            if ($imageSize < 5000000) {  // Limit file size to 5MB
                $imageNewName = uniqid('', true) . "." . $imageExt;  // Unique image name
                $imageDestination = 'uploads/' . $imageNewName;

                // Move the uploaded file to the server
                if (move_uploaded_file($imageTmpName, $imageDestination)) {
                    // Store image path in the database
                } else {
                    echo "<script>alert('Failed to upload image.');</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Image size is too large. Max size is 5MB.');</script>";
                exit();
            }
        } else {
            echo "<script>alert('Invalid image type. Allowed types: jpg, jpeg, png.');</script>";
            exit();
        }
    } else {
        echo "<script>alert('Error uploading image.');</script>";
        exit();
    }

    // Insert data into database (including Kisan Credit Card and Image)
    $stmt = $conn->prepare("INSERT INTO registration 
        (fullName, email, relationship, relativeName, mobileNo, age, casteCategory, gender, farmerType, farmerCategory, state, district, village, address, pinCode, kisanCreditCard, farmerImage, password) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error preparing the SQL statement: " . $conn->error);
    }

    $stmt->bind_param("sssssisissssssssss", 
        $fullName, $email, $relationship, $relativeName, $mobileNo, $age, 
        $casteCategory, $gender, $farmerType, $farmerCategory, 
        $state, $district, $village, $address, $pinCode, $kisanCreditCard, $imageNewName, $password
    );

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!');window.location.href = 'connect.html';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
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
            background: url('etho.jpg') no-repeat center center fixed; /* Change the URL to your image path */
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

    </style>
</head>
<body>

    <div class="container">
        <h2>Register for New Farmer User</h2>

        <div class="section-heading">Farmer Details</div>

        <form action="register.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fullName">Full Name *</label>
                <input type="text" id="fullName" name="fullName" placeholder="Enter Farmer Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="relationship">Relationship *</label>
                <select id="relationship" name="relationship" required>
                    <option>Select Relationship</option>
                    <option>Father</option>
                    <option>Husband</option>
                </select>
            </div>
            <div class="form-group">
                <label for="relativeName">Relative Name *</label>
                <input type="text" id="relativeName" name="relativeName" placeholder="Father/Husband Name" required>
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
                <label for="age">Age *</label>
                <input type="number" id="age" name="age" placeholder="Enter Age" required>
            </div>
            <div class="form-group">
                <label for="casteCategory">Caste Category *</label>
                <select id="casteCategory" name="casteCategory" required>
                    <option>Select Category</option>
                    <option>General</option>
                    <option>OBC</option>
                    <option>SC</option>
                    <option>ST</option>
                </select>
            </div>
            <div class="form-group">
                <label for="gender">Gender *</label>
                <select id="gender" name="gender" required>
                    <option>Select Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="farmerType">Farmer Type *</label>
                <select id="farmerType" name="farmerType" required>
                    <option>Select Farmer Type</option>
                    <option>Owner</option>
                    <option>Tenant</option>
                    <option>Share cropper</option>
                </select>
            </div>
            <div class="form-group">
                <label for="farmerCategory">Farmer Category *</label>
                <select id="farmerCategory" name="farmerCategory" required>
                    <option>Select Farmer Category</option>
                    <option>Small</option>
                    <option>Marginal</option>
                    <option>Others</option>
                </select>
            </div>

            <div class="section-heading">Residential Details</div>
            <div class="form-group">
                <label for="state">State *</label>
                <select id="state" name="state" required>
                    <option>Select State</option>
                    <option>Tamil Nadu</option>
                </select>
            </div>
            <div class="form-group">
                <label for="district">District *</label>
                <select id="district" name="district" required>
                <option>Ariyalur</option>
            <option>Chennai</option>
            <option>Coimbatore</option>
            <option>Cuddalore</option>
            <option>Dharmapuri</option>
            <option>Dindigul</option>
            <option>Erode</option>
            <option>Kanchipuram</option>
            <option>Kanyakumari</option>
            <option>Karur</option>
            <option>Krishnagiri</option>
            <option>Madurai</option>
            <option>Nagapattinam</option>
            <option>Namakkal</option>
            <option>Nilgiris</option>
            <option>Perambalur</option>
            <option>Pudukkottai</option>
            <option>Ramanathapuram</option>
            <option>Salem</option>
            <option>Sivagangai</option>
            <option>Thanjavur</option>
            <option>Theni</option>
            <option>Tiruchirappalli</option>
            <option>Tirunelveli</option>
            <option>Tiruppur</option>
            <option>Tiruvallur</option>
            <option>Tiruvannamalai</option>
            <option>Vellore</option>
            <option>Villupuram</option>
            <option>Virudhunagar</option>

                    <!-- More district options -->
                </select>
            </div>
            <div class="form-group">
                <label for="village">Residential Village/Town *</label>
                <select id="village" name="village" required>
                    <option>Select Village/Town</option>
                    <option>Village 1</option>
                    <option>Village 2</option>
                </select>
            </div>

            <div class="form-group">
    <label for="kisanCreditCard">Kisan Credit Card *</label>
    <input type="text" id="kisanCreditCard" name="kisanCreditCard" placeholder="Enter Kisan Credit Card Number" required>
</div>
<div class="form-group">
    <label for="farmerImage">Upload Farmer Image *</label>
    <input type="file" id="farmerImage" name="farmerImage" accept="image/*" required>
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
