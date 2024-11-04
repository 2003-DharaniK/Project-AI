<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include TCPDF and PHPMailer libraries
require_once('tcpdf/tcpdf.php'); // Ensure you have installed TCPDF
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection (adjust with your own database credentials)
$host = 'localhost';
$db = 'farmer'; // Replace with your database name
$user = 'root'; // Replace with your database username
$pass = '';     // Replace with your database password

// Create a new MySQLi connection
$conn = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch invoices from the database
function fetchInvoices($conn) {
    $sql = "SELECT * FROM invoices"; // Adjust table name as necessary
    $result = $conn->query($sql);
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
    return $result;
}

// Sanitize and validate POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['generate_invoice']) || isset($_POST['send_pdf'])) {
        $farmerName = $conn->real_escape_string($_POST['farmerName'] ?? '');
        $customerName = $conn->real_escape_string($_POST['customerName'] ?? '');
        $customerEmail = $conn->real_escape_string($_POST['customerEmail'] ?? '');
        $productName = $conn->real_escape_string($_POST['productName'] ?? '');
        $quantity = (int)($_POST['quantity'] ?? 0);
        $price = (float)($_POST['price'] ?? 0.0);
        $saleDate = $conn->real_escape_string($_POST['saleDate'] ?? '');
        $tax = (float)($_POST['tax'] ?? 0.0);
        $discount = (float)($_POST['discount'] ?? 0.0);
        $paymentStatus = $conn->real_escape_string($_POST['paymentStatus'] ?? '');

        // Validate required fields
        if (empty($farmerName) || empty($customerName) || empty($customerEmail) || empty($productName) || $quantity <= 0 || $price <= 0) {
            echo "All fields are required and must be valid!";
        } else {
            // Calculate the total amount
            $subtotal = $quantity * $price;
            $discountAmount = ($subtotal * $discount) / 100;
            $taxableAmount = $subtotal - $discountAmount;
            $taxAmount = ($taxableAmount * $tax) / 100;
            $totalAmount = $taxableAmount + $taxAmount;

            // Use prepared statements to insert invoice data into the database
            $stmt = $conn->prepare("INSERT INTO invoices (farmer_name, customer_name, customer_email, product_name, quantity, price_per_unit, sale_date, total_amount, tax, discount, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            if ($stmt) {
                // Bind the parameters to the query
                $stmt->bind_param("ssssiddidss", $farmerName, $customerName, $customerEmail, $productName, $quantity, $price, $saleDate, $totalAmount, $tax, $discount, $paymentStatus);

                // Execute the query
                if ($stmt->execute()) {
                    echo "Invoice generated successfully.";
                    $invoiceId = $stmt->insert_id; // Get the last inserted ID

                    // Generate PDF invoice
                    $pdf = new TCPDF();
                    $pdf->AddPage();
                    $pdf->SetFont('helvetica', '', 12);

                    // Add invoice details to PDF
                    $pdfContent = "<h1>Invoice</h1>";
                    $pdfContent .= "<strong>Invoice ID:</strong> {$invoiceId}<br>";
                    $pdfContent .= "<strong>Farmer Name:</strong> {$farmerName}<br>";
                    $pdfContent .= "<strong>Customer Name:</strong> {$customerName}<br>";
                    $pdfContent .= "<strong>Customer Email:</strong> {$customerEmail}<br>";
                    $pdfContent .= "<strong>Product Name:</strong> {$productName}<br>";
                    $pdfContent .= "<strong>Quantity:</strong> {$quantity}<br>";
                    $pdfContent .= "<strong>Price Per Unit:</strong> {$price}<br>";
                    $pdfContent .= "<strong>Sale Date:</strong> {$saleDate}<br>";
                    $pdfContent .= "<strong>Total Amount:</strong> {$totalAmount}<br>";
                    $pdfContent .= "<strong>Tax:</strong> {$tax}<br>";
                    $pdfContent .= "<strong>Discount:</strong> {$discount}<br>";
                    $pdfContent .= "<strong>Payment Status:</strong> {$paymentStatus}<br>";

                    $pdf->writeHTML($pdfContent, true, false, true, false, '');

                    // Save PDF to file
                    $pdfDirectory = __DIR__ . '/invoices/'; // Make sure this directory exists
                    if (!file_exists($pdfDirectory)) {
                        mkdir($pdfDirectory, 0777, true); // Create the directory if it doesn't exist
                    }

                    $pdfFilename = $pdfDirectory . "invoice_{$invoiceId}.pdf"; // Save file to server
                    $pdf->Output($pdfFilename, 'F'); // Save the file

                    // If the "Send PDF to Admin" button was clicked, send the PDF via email
                    if (isset($_POST['send_pdf'])) {
                        $mail = new PHPMailer(true);
                        try {
                            // Server settings
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                            $mail->SMTPAuth = true;
                            $mail->Username = 'trioinnovators@gmail.com'; // Your email
                            $mail->Password = 'hbgv sjbm uuna lbpv'; // Your email password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port = 587;

                            // Recipients
                            $mail->setFrom('your-email@gmail.com', 'Jayasri');
                            $mail->addAddress('trioinnovators@gmail.com', 'Admin'); // Admin email

                            // Attachments
                            $mail->addAttachment($pdfFilename); // Attach PDF

                            // Content
                            $mail->isHTML(true);
                            $mail->Subject = 'New Invoice Generated';
                            $mail->Body    = 'A new invoice has been generated. Please find the attached PDF.';

                            $mail->send();
                            echo 'PDF has been sent to admin email.';
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                    }
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Error preparing the statement: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Generator with Payment Tracking</title>
    <style>
        /* Basic styling for form and table */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #007bff;
        }
        form {
            margin-bottom: 20px;
            border: 1px solid #007bff;
            border-radius: 8px;
            padding: 20px;
            background: #e9ecef;
        }
        label {
            margin-top: 10px;
            display: block;
            font-weight: bold;
        }
        input, select {
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ced4da;
            border-radius: 4px;
            width: calc(100% - 22px);
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px; /* Reduced padding for smaller buttons */
            cursor: pointer;
            transition: background-color 0.3s;
            width: 24%; /* Set button width */
            margin-right: 4%; /* Space between buttons */
            display: inline-block; /* Display buttons inline */
        }
        button:last-child {
            margin-right: 0; /* Remove right margin from the last button */
        }
        button:hover {
            background-color: #0056b3;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #007bff;
            color: white;
        }
        .invoice-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .invoice-table tr:hover {
            background-color: #e0e0e0;
        }
        @media (max-width: 600px) {
            input, select, button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<a href="javascript:history.back()" class="back-button" style="display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>
    <div class="container">
        <h2>Invoice Generator</h2>
        <form method="POST">
            <label for="farmerName">Farmer Name</label>
            <input type="text" id="farmerName" name="farmerName" required>

            <label for="customerName">Customer Name</label>
            <input type="text" id="customerName" name="customerName" required>

            <label for="customerEmail">Customer Email</label>
            <input type="email" id="customerEmail" name="customerEmail" required>

            <label for="productName">Product Name</label>
            <input type="text" id="productName" name="productName" required>

            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" required>

            <label for="price">Price per Unit</label>
            <input type="number" step="0.01" id="price" name="price" required>

            <label for="saleDate">Sale Date</label>
            <input type="date" id="saleDate" name="saleDate" required>

            <label for="tax">Tax (%)</label>
            <input type="number" step="0.01" id="tax" name="tax" required>

            <label for="discount">Discount (%)</label>
            <input type="number" step="0.01" id="discount" name="discount">

            <label for="paymentStatus">Payment Status</label>
            <select id="paymentStatus" name="paymentStatus" required>
                <option value="Paid">Paid</option>
                <option value="Pending">Pending</option>
            </select>

            <button type="submit" name="generate_invoice">Generate Invoice</button>
            <button type="submit" name="send_pdf">Generate and Send PDF</button>
        </form>

        <h2>Invoices</h2>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Farmer Name</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Sale Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $invoices = fetchInvoices($conn);
                if ($invoices->num_rows > 0) {
                    while ($row = $invoices->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['farmer_name']}</td>
                                <td>{$row['customer_name']}</td>
                                <td>{$row['customer_email']}</td>
                                <td>{$row['product_name']}</td>
                                <td>{$row['quantity']}</td>
                                <td>{$row['price_per_unit']}</td>
                                <td>{$row['sale_date']}</td>
                                <td>{$row['total_amount']}</td>
                                <td>{$row['payment_status']}</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No invoices found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Google Translate script -->
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

<?php
// Close the database connection after all operations
$conn->close();
?>
