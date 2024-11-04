<?php
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_product'])) {
    $farmer_name = $_POST['farmer_name'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $account_holder_name = $_POST['account_holder_name'];
    $account_number = $_POST['account_number'];
    $ifsc_code = $_POST['ifsc_code'];
    $bank_name = $_POST['bank_name'];
    $branch_name = $_POST['branch_name'];
    $mobile_number = $_POST['mobile_number'];
    $upi_id = $_POST['upi_id'];

    // Handle file upload
    $product_image = $_FILES['product_image'];
    $target_dir = "farmeruploads/";
    $target_file = $target_dir . basename($product_image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($product_image["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    if (move_uploaded_file($product_image["tmp_name"], $target_file)) {
        $sql = "INSERT INTO products (farmer_name, product_name, quantity, price, product_image, account_holder_name, account_number, ifsc_code, bank_name, branch_name, mobile_number, upi_id)
                VALUES ('$farmer_name', '$product_name', '$quantity', '$price', '$target_file', '$account_holder_name', '$account_number', '$ifsc_code', '$bank_name', '$branch_name', '$mobile_number', '$upi_id')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>New record created successfully.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } else {
        echo "<p>Sorry, there was an error uploading your file.</p>";
    }
}

// Handle product deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];

    // Fetch the image path for deletion
    $sql = "SELECT product_image FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    // Check if the product exists before attempting to access the image
    if ($result && $row = $result->fetch_assoc()) {
        $image_path = $row['product_image'];

        // Delete product from database
        $sql = "DELETE FROM products WHERE id = $product_id";
        if ($conn->query($sql) === TRUE) {
            // Delete image file from server
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            echo "<p>Product deleted successfully.</p>";
        } else {
            echo "<p>Error deleting product: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>Product not found. Unable to delete.</p>";
    }
}

// Fetch products
$sql = "SELECT id, farmer_name, product_name, quantity, price, product_image, account_holder_name, account_number, ifsc_code, bank_name, branch_name, mobile_number, upi_id FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #444;
        }
        select, input[type="text"], input[type="number"], input[type="file"] {
            width: calc(100% - 20px); /* Adjust for padding */
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }
        input:focus, select:focus {
            border-color: #007bff;
            outline: none;
            background-color: #fff;
        }
        button {
            width: 100%;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        .product-list {
            display: flex;
            justify-content: center;
            flex-wrap: nowrap;
            overflow-x: auto;
            padding: 20px 0;
            margin: 0 auto;
            max-width: 100%;
            gap: 20px;
        }
        .product {
            flex: 0 0 auto;
            width: 280px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }
        .product:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }
        .product img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .product-details {
            text-align: center;
        }
        .product-details h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #007bff;
        }
        .product-details p {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
<a href="javascript:history.back()" class="back-button" style="display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>


<h1>Product Form</h1>
<form action="" method="POST" enctype="multipart/form-data">
    <label for="farmer_name">Farmer Name:</label>
    <input type="text" name="farmer_name" required>

    <label for="product_name">Product Name:</label>
    <select name="product_name" required>
        <option value="Select an option">Select an option</option>
        <option value="Banana">Banana</option>
        <option value="Coconut">Coconut</option>
        <option value="Paddy">Paddy</option>
        <option value="Cotton">Cotton</option>
        <option value="Palm">Palm</option>
        <option value="Sugarcane">Sugarcane</option>
    </select>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" required>

    <label for="price">Price:</label>
    <input type="text" name="price" required>

    <label for="account_holder_name">Account Holder Name:</label>
    <input type="text" name="account_holder_name" required>

    <label for="account_number">Account Number:</label>
    <input type="text" name="account_number" required>

    <label for="ifsc_code">IFSC Code:</label>
    <input type="text" name="ifsc_code" required>

    <label for="bank_name">Bank Name:</label>
    <input type="text" name="bank_name" required>

    <label for="branch_name">Branch Name:</label>
    <input type="text" name="branch_name" required>

    <label for="mobile_number">Mobile Number:</label>
    <input type="text" name="mobile_number" required>

    <label for="upi_id">UPI ID:</label>
    <input type="text" name="upi_id" required>

    <label for="product_image">Product Image:</label>
    <input type="file" name="product_image" accept="image/*" required>

    <button type="submit" name="submit_product">Submit Product</button>
</form>

<h2>Product List</h2>
<div class="product-list">
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<img src='" . htmlspecialchars($row['product_image']) . "' alt='Product Image'>";
            echo "<div class='product-details'>";
            echo "<h2>" . htmlspecialchars($row['product_name']) . "</h2>";
            echo "<p>Farmer: " . htmlspecialchars($row['farmer_name']) . "</p>";
            echo "<p>Quantity: " . htmlspecialchars($row['quantity']) . " units</p>";
            echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
            echo "<p>Mobile: " . htmlspecialchars($row['mobile_number']) . "</p>";
            echo "<form action='' method='POST' style='margin-top: 10px;'>";
            echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
            echo "<button type='submit' name='delete_product' class='delete-btn'>Delete Product</button>";
            echo "</form>";
            echo "</div></div>";
        }
    } else {
        echo "<p>No products found.</p>";
    }
    ?>
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
