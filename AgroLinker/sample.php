<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include TCPDF and PHPMailer
require_once('tcpdf/tcpdf.php'); // Adjust the path as needed
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection (adjust the credentials as per your setup)
$host = 'localhost';
$db = 'farmer'; // Replace with your database name
$user = 'root'; // Replace with your database username
$pass = '';     // Replace with your database password

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$invoiceId = null;
$pdfFilename = null;

// Function to fetch invoices from the database
function fetchInvoices($conn) {
    $sql = "SELECT * FROM invoices"; // Adjust table name as necessary
    return $conn->query($sql);
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

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Generator with Payment Tracking</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .form-row label {
            width: 30%;
            font-weight: bold;
            color: #555;
        }
        .form-row input, .form-row select {
            width: 70%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-row input:focus, .form-row select:focus {
            outline: none;
            border-color: #007bff;
        }
        .form-row input[type="submit"] {
            background-color: #28a745;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: auto;
            margin-right: 10px;
        }
        .form-row input[type="submit"]:hover {
            background-color: #218838;
        }
        .note {
            font-size: 14px;
            color: #666;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Invoice Generator</h2>
        <form method="POST">
            <div class="form-row">
                <label for="farmerName">Farmer Name:</label>
                <input type="text" name="farmerName" required>
            </div>
            <div class="form-row">
                <label for="customerName">Customer Name:</label>
                <input type="text" name="customerName" required>
            </div>
            <div class="form-row">
                <label for="customerEmail">Customer Email:</label>
                <input type="email" name="customerEmail" required>
            </div>
            <div class="form-row">
                <label for="productName">Product Name:</label>
                <input type="text" name="productName" required>
            </div>
            <div class="form-row">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" min="1" required>
            </div>
            <div class="form-row">
                <label for="price">Price Per Unit:</label>
                <input type="number" name="price" min="0.01" step="0.01" required>
            </div>
            <div class="form-row">
                <label for="saleDate">Sale Date:</label>
                <input type="date" name="saleDate" required>
            </div>
            <div class="form-row">
                <label for="tax">Tax (%):</label>
                <input type="number" name="tax" min="0" step="0.01" required>
            </div>
            <div class="form-row">
                <label for="discount">Discount (%):</label>
                <input type="number" name="discount" min="0" step="0.01" required>
            </div>
            <div class="form-row">
                <label for="paymentStatus">Payment Status:</label>
                <select name="paymentStatus" required>
                    <option value="Paid">Paid</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>
            <div class="form-row">
                <input type="submit" name="generate_invoice" value="Generate Invoice">
                <input type="submit" name="send_pdf" value="Send PDF to Admin">
            </div>
        </form>
        <p class="note">Note: After generating the invoice, you can also send it to the admin.</p>

        <h2>Invoices List</h2>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Farmer Name</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price Per Unit</th>
                    <th>Sale Date</th>
                    <th>Total Amount</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch and display invoices
                $invoices = fetchInvoices($conn);
                if ($invoices && $invoices->num_rows > 0) {
                    while ($row = $invoices->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['farmer_name']}</td>
                                <td>{$row['customer_name']}</td>
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
</body>
</html>
