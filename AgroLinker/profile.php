<?php
session_start();
include 'db.php'; // Include database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM registration WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Fetch user data
} else {
    echo "No user found!";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Wrapper for profile container */
.wrapper {
    display: flex;
    justify-content: center;
    width: 100%;
    padding: 0 20px;
}

/* Profile container styles */
.profile-container {
    background-color: #ffffff;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    width: 1000px;
}

h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
    border-bottom: 2px solid #00aaff;
    display: inline-block;
    padding-bottom: 10px;
}

/* Profile grid styles */
.profile-grid {
    display: flex;
    justify-content: space-between;
}

/* Each profile column style */
.profile-column {
    width: 48%;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f0f0f0;
    font-weight: bold;
    color: #333;
}

td {
    color: #555;
}

a {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #00aaff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: #008fcc;
}

/* Responsive design */
@media (max-width: 768px) {
    .profile-grid {
        flex-direction: column;
    }

    .profile-column {
        width: 100%;
    }
}
    </style>





</head>
<body>
<a href="javascript:history.back()" class="back-button" style="display: inline-block; margin-bottom: 20px; padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 4px;">Go Back</a>
    <div class="wrapper">
        <div class="profile-container">
            <h1>User Profile</h1>
            <div class="profile-grid">
                <!-- First column -->
                <div class="profile-column">
                    <table>
                        <tr>
                            <th>Full Name</th>
                            <td><?php echo htmlspecialchars($user['fullName']); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                        </tr>
                        <tr>
                            <th>Relationship</th>
                            <td><?php echo htmlspecialchars($user['relationship']); ?></td>
                        </tr>
                        <tr>
                            <th>Relative Name</th>
                            <td><?php echo htmlspecialchars($user['relativeName']); ?></td>
                        </tr>
                        <tr>
                            <th>Mobile No</th>
                            <td><?php echo htmlspecialchars($user['mobileNo']); ?></td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td><?php echo htmlspecialchars($user['age']); ?></td>
                        </tr>
                        <tr>
                            <th>Caste Category</th>
                            <td><?php echo htmlspecialchars($user['casteCategory']); ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo htmlspecialchars($user['gender']); ?></td>
                        </tr>
                    </table>
                </div>
                <!-- Second column -->
                <div class="profile-column">
                    <table>
                        <tr>
                            <th>Farmer Type</th>
                            <td><?php echo htmlspecialchars($user['farmerType']); ?></td>
                        </tr>
                        <tr>
                            <th>Farmer Category</th>
                            <td><?php echo htmlspecialchars($user['farmerCategory']); ?></td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td><?php echo htmlspecialchars($user['state']); ?></td>
                        </tr>
                        <tr>
                            <th>District</th>
                            <td><?php echo htmlspecialchars($user['district']); ?></td>
                        </tr>
                        <tr>
                            <th>Village</th>
                            <td><?php echo htmlspecialchars($user['village']); ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo htmlspecialchars($user['address']); ?></td>
                        </tr>
                        <tr>
                            <th>PIN Code</th>
                            <td><?php echo htmlspecialchars($user['pinCode']); ?></td>
                        </tr>
                        <tr>
                            <th>Bank Name</th>
                            <td><?php echo htmlspecialchars($user['bankName']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <a href="logout.php">Logout</a> <!-- Link to logout -->
        </div>
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
