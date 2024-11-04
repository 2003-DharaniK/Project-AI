<?php
// Database connection details
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "farmer";        // Your database name

// Create the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Include Twilio and helper functions
require_once 'vendor/autoload.php'; // Include Composer's autoload file for Twilio SDK
use Twilio\Rest\Client;

// Function to send SMS
function sendSMS($farmerPhoneNumber, $message) {
    $sid = ''; // Twilio Account SID
    $token = ''; // Twilio Auth Token
    $twilioNumber = '';
    $client = new Client($sid, $token);

    try {
        $client->messages->create(
            $farmerPhoneNumber, // Farmer's phone number
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

// Function to generate SMS message content in Tamil
function generateMessage($officerDetails) {
    $message = "விளக்கம்: EB அதிகாரி " . $officerDetails['officer_name'] . " உங்கள் கிராமத்தில், " . 
               $officerDetails['village_name'] . " தேதி: " . $officerDetails['available_date'] .
               " நேரம்: " . $officerDetails['available_time'] . " மின்சாரம் கிடைக்கும். MW: " . 
               $officerDetails['power_load'] . ". அதிகம் பயன்படுத்த வேண்டாம்.";
    return $message;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $officerId = $_POST['id'];

    // Fetch officer details from the database
    $sql = "SELECT * FROM officer WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $officerId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $officerDetails = $result->fetch_assoc();

        // Generate message content in Tamil
        $message = generateMessage($officerDetails);

        // Send SMS to the farmer
        $farmerPhoneNumber = ''; // Replace with farmer's number or fetch dynamically
        $response = sendSMS($farmerPhoneNumber, $message);

        // Return the response
        echo $response;
    } else {
        echo "No officer found with ID: " . htmlspecialchars($officerId);
    }
    
    // Close the statement
    $stmt->close();
}

$conn->close(); // Close the connection
?>
