<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmer";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Include Twilio and helper functions
require_once 'vendor/autoload.php'; // Assuming you're using Twilio via Composer
use Twilio\Rest\Client;

// Function to send SMS in Tamil
function sendSMS($farmerPhoneNumber, $message) {
    $sid = 'ACed22031de317dc3925bce21fa8f2ebe4'; // Twilio Account SID
    $token = '1948b510ad6fac6866f450f09d4e5a98'; // Twilio Auth Token
    $twilioNumber = '+18588425618'; // Twilio Phone Number

    $client = new Client($sid, $token);

    try {
        $client->messages->create(
            $farmerPhoneNumber,
            array(
                'from' => $twilioNumber,
                'body' => $message
            )
        );
        return "SMS sent successfully!";
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

// Fetch current date and time
$currentDate = date('Y-m-d');
$currentTime = date('H:i');

// Fetch reminders that match the current date and time
$sql = "SELECT * FROM remainders WHERE reminder_date = ? AND reminder_time = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $currentDate, $currentTime);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Generate SMS content in Tamil
        $message = "மின்சாரம் " . $row['village_name'] . " பகுதியில் " . $row['reminder_time'] . " மணிக்கு கிடைக்கப்பெறும்.";
        $farmerPhoneNumber = $row['farmer_phone']; // Get the phone number from the database

        // Send SMS
        $smsResult = sendSMS($farmerPhoneNumber, $message);
        echo $smsResult . "\n"; // Log the result of sending the SMS
    }
} else {
    echo "No reminders for the current time.\n";
}

// Close statement and connection
$stmt->close();
$conn->close();

?>