<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Registration Form</title>
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
            background: url('img.jpg') no-repeat center center fixed; /* Change the URL to your image path */
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
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 15px;
        }

        label {
            width: 30%; /* Control the width of the label */
            font-weight: lighter;
            color: green;
        }

        input, select, textarea {
            width: 70%; /* Control the width of the input fields */
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .submit-btn {
            margin-top: 5px;
            padding: 10px;
            font-size: 0.9rem;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #218838;
        }

        .resume-details, .manager-details {
            display: none;
            flex-basis: 100%;
            flex-direction: column;
            gap: 15px;
        }

        .checkbox-group {
            display: flex;
            align-items: center; /* Aligns the checkbox and label vertically */
            margin-bottom: 15px;
        }

        .checkbox-group input[type="checkbox"] {
            margin-right: 10px; /* Adds space between the checkbox and the label */
        }

        @media (max-width: 600px) {
            form {
                flex-direction: column;
            }
            .form-group {
                flex-direction: column;
                align-items: flex-start;
            }
            label, input, select, textarea {
                width: 100%;
            }
        }

        /* Breadcrumb container */
        .breadcrumb {
            display: flex;
            align-items: center;
            list-style: none;
            background-color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .breadcrumb li {
            margin-right: 10px;
        }

        .breadcrumb li a {
            text-decoration: none;
            color: #388e3c; /* Green color */
            font-weight: 500;
        }

        .breadcrumb li a:hover {
            text-decoration: underline;
        }

        .breadcrumb li::after {
            content: '>';
            margin-left: 10px;
            color: #888; /* Grey color for the arrow */
        }

        .breadcrumb li:last-child::after {
            content: '';
            margin-left: 0;
        }

        .breadcrumb li:last-child a {
            color: #555; /* Current page color (grey) */
            pointer-events: none; /* Disable the link for the current page */
            font-weight: 600;
        }

    </style>
</head>
<body>

    <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="page.html">Careers</a></li>
        <li><a href="#">Worker Opportunities</a></li>
    </ul>

    <div class="container">
        <h2>Register as a Worker</h2>

        <div class="section-heading">1. Personal Information</div>

        <form id="workerForm" action="form.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fullName">Full Name *</label>
                <input type="text" id="fullName" name="fullName" placeholder="Enter Your Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="phoneNo">Phone Number *</label>
                <input type="tel" id="phoneNo" name="phoneNo" placeholder="Enter 10 digit mobile number" pattern="[0-9]{10}" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth *</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender *</label>
                <select id="gender" name="gender" required>
                    <option>Select Gender</option>
                    <option>Female</option>
                    <option>Male</option>
                </select>
            </div>

            <div class="section-heading">2. Address Information</div>

            <div class="form-group">
                <label for="streetAddress">Street Address *</label>
                <input type="text" id="streetAddress" name="streetAddress" placeholder="Enter Street Address" required>
            </div>
            <div class="form-group">
                <label for="city">City *</label>
                <input type="text" id="city" name="city" placeholder="Enter City" required>
            </div>
            <div class="form-group">
                <label for="state">State/Province *</label>
                <input type="text" id="state" name="state" placeholder="Enter State/Province" required>
            </div>
            <div class="form-group">
                <label for="postalCode">Postal Code *</label>
                <input type="text" id="postalCode" name="postalCode" placeholder="Enter Postal Code" required>
            </div>

            <div class="section-heading">3. Position Details</div>

            <div class="form-group">
                <label for="position">Position Applied For *</label>
                <select id="position" name="position" onchange="checkPosition()" required>
                    <option>Select Position</option>
                    <option>CA (Chartered Accountant)</option>
                    <option>Worker</option>
                    <option>Manager</option>
                </select>
            </div>
            <div class="form-group">
                <label for="educationLevel">Education Level *</label>
                <select id="educationLevel" name="educationLevel" onchange="checkEducation()" required>
                    <option>Select Education Level</option>
                    <option value="not-graduated">Not Graduated</option>
                    <option value="graduated">Graduated</option>
                </select>
            </div>

            <!-- Resume Details, hidden if not graduated -->
            <div id="resume-details" class="resume-details">
                <div class="form-group">
                    <label for="resume">Upload Resume:</label>
                    <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx">
                </div>
                <div class="form-group">
                    <label for="experience">Experience (Years):</label>
                    <input type="number" id="experience" name="experience" placeholder="Enter years of experience">
                </div>
                <div class="form-group">
                    <label for="studyLevel">Level of Study:</label>
                    <input type="text" id="studyLevel" name="studyLevel" placeholder="Enter your highest level of study">
                </div>
                <div class="form-group">
                    <label for="course">Course:</label>
                    <input type="text" id="course" name="course" placeholder="Enter your course of study">
                </div>
            </div>

            <!-- Manager/CA Details, hidden by default -->
            <div id="manager-details" class="manager-details">
                <div class="form-group">
                    <label for="companyName">Previous Company Name:</label>
                    <input type="text" id="companyName" name="companyName" placeholder="Enter Previous Company Name">
                </div>
                <div class="form-group">
                    <label for="salary">Expected Salary:</label>
                    <input type="number" id="salary" name="salary" placeholder="Enter Expected Salary">
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" placeholder="Enter Your Age">
                </div>
            </div>

            <div class="form-group">
                <label for="previousExperience">Previous Experience</label>
                <textarea id="previousExperience" name="previousExperience" placeholder="Detail your relevant work experience"></textarea>
            </div>
            <div class="form-group">
                <label for="skills">Skills *</label>
                <textarea id="skills" name="skills" placeholder="List your skills relevant to the position" required></textarea>
            </div>

            <div class="section-heading">6. Additional Information</div>

            <div class="form-group">
                <label for="motivation">Why Do You Want to Join AgroLinker? *</label>
                <textarea id="motivation" name="motivation" placeholder="Briefly explain your motivation" required></textarea>
            </div>
            <div class="form-group">
                <label for="referenceContact">Reference Contact (optional)</label>
                <input type="text" id="referenceContact" name="referenceContact" placeholder="Enter Reference Contact">
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">I agree to the <a href="terms.html" target="_blank">Terms & Conditions</a></label>
            </div>

            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>

    <script>
        function checkEducation() {
            const educationField = document.getElementById('educationLevel');
            const resumeDetails = document.getElementById('resume-details');

            if (educationField.value === 'graduated') {
                resumeDetails.style.display = 'flex';
            } else {
                resumeDetails.style.display = 'none';
            }
        }

        function checkPosition() {
            const positionField = document.getElementById('position');
            const managerDetails = document.getElementById('manager-details');

            if (positionField.value === 'CA (Chartered Accountant)' || positionField.value === 'Manager') {
                managerDetails.style.display = 'flex';
            } else {
                managerDetails.style.display = 'none';
            }
        }
    </script>

</body>
</html>


<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agrolinker";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data safely using isset()
    $fullName = isset($_POST['fullName']) ? $_POST['fullName'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phoneNo = isset($_POST['phoneNo']) ? $_POST['phoneNo'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $streetAddress = isset($_POST['streetAddress']) ? $_POST['streetAddress'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $state = isset($_POST['state']) ? $_POST['state'] : '';
    $postalCode = isset($_POST['postalCode']) ? $_POST['postalCode'] : '';
    $position = isset($_POST['position']) ? $_POST['position'] : '';
    $educationLevel = isset($_POST['educationLevel']) ? $_POST['educationLevel'] : '';
    $previousExperience = isset($_POST['previousExperience']) ? $_POST['previousExperience'] : '';
    $skills = isset($_POST['skills']) ? $_POST['skills'] : '';
    $motivation = isset($_POST['motivation']) ? $_POST['motivation'] : '';
    $referenceContact = isset($_POST['referenceContact']) ? $_POST['referenceContact'] : '';
    $experience = isset($_POST['experience']) ? $_POST['experience'] : '';
    $studyLevel = isset($_POST['studyLevel']) ? $_POST['studyLevel'] : '';
    $course = isset($_POST['course']) ? $_POST['course'] : '';

    // Handle file upload for resume
   // Handle file upload for resume
$resume = "";
if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
    $resume = 'uploads/' . basename($_FILES['resume']['name']);
    move_uploaded_file($_FILES['resume']['tmp_name'], $resume);
}


    // SQL insert query
    // SQL insert query
$sql = "INSERT INTO workers (full_name, email, phone_no, dob, gender, street_address, city, state, postal_code, position, education_level, previous_experience, skills, motivation, reference_contact, resume, experience, study_level, course) 
VALUES ('$fullName', '$email', '$phoneNo', '$dob', '$gender', '$streetAddress', '$city', '$state', '$postalCode', '$position', '$educationLevel', '$previousExperience', '$skills', '$motivation', '$referenceContact', '$resume', '$experience', '$studyLevel', '$course')";

    if ($conn->query($sql) === TRUE) {
        echo "New worker registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

