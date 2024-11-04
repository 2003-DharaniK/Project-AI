<?php
// db.php - Database connection file
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'farmer'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create croplocation table if it doesn't exist
$table_query = "CREATE TABLE IF NOT EXISTS croplocation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    district VARCHAR(50),
    crop VARCHAR(50),
    volume INT,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8)
)";

$conn->query($table_query);

// Insert crop production data if not already present
$insert_query = "
INSERT INTO croplocation (district, crop, volume, latitude, longitude) VALUES
('Chennai', 'paddy', 5000, 13.082700, 80.270700),
('Coimbatore', 'paddy', 3000, 11.016800, 76.955800),
('Karur', 'paddy', 7000, 10.960000, 78.135500),
('Madurai', 'millets', 4000, 9.925300, 78.119400),
('Tirunelveli', 'millets', 6000, 8.728700, 77.404200),
('Dindigul', 'cotton', 4500, 10.364800, 77.979400),
('Kanyakumari', 'coconut', 8000, 8.088300, 77.570000),
('Tiruvannamalai', 'sugarcane', 9000, 12.225000, 79.074500),
('Virudhunagar', 'palm', 3000, 9.554500, 77.995800),
('Erode', 'maize', 7000, 11.341000, 77.719900),
('Tiruchirappalli', 'tomato', 6000, 10.790500, 78.704700),
('Namakkal', 'onion', 4500, 11.205000, 78.166000),
('The Nilgiris', 'apple', 2000, 11.409100, 76.690200),
('Kanyakumari', 'banana', 9000, 8.088300, 77.570000),
('Thiruvarur', 'soybeans', 3500, 10.794700, 79.329000)
ON DUPLICATE KEY UPDATE volume = VALUES(volume);";

$conn->query($insert_query);

// Fetch data based on crop selection
$locations = [];
$cropData = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $crop = $_POST['crop'];
    $stmt = $conn->prepare("SELECT * FROM croplocation WHERE crop = ?");
    $stmt->bind_param("s", $crop);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $locations[] = [
            'district' => $row['district'],
            'volume' => $row['volume'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
        ];
        $cropData[$row['district']] = $row['volume']; // Collect crop data for pie chart
    }
    $stmt->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Production Visualization</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        #productionChart {
            width: 150px; /* Adjust the width for a smaller chart */
            height: 150px; /* Adjust the height for a smaller chart */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Crop Production Visualization</h1>
        <form method="POST" action="salescategory.php">
            <div class="form-group">
                <label for="crop">Select Crop:</label>
                <select class="form-control" id="crop" name="crop" required>
                    <option value="">Select a crop</option>
                    <option value="paddy">Paddy</option>
                    <option value="millets">Millets</option>
                    <option value="cotton">Cotton</option>
                    <option value="coconut">Coconut</option>
                    <option value="sugarcane">Sugarcane</option>
                    <option value="palm">Palm</option>
                    <option value="maize">Maize</option>
                    <option value="tomato">Tomato</option>
                    <option value="onion">Onion</option>
                    <option value="apple">Apple</option>
                    <option value="banana">Banana</option>
                    <option value="soybeans">Soybeans</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Show Production Locations</button>
        </form>

        <div id="map"></div>
        
        <?php if (!empty($locations)): ?>
            <h2 class="mt-4">Production Locations</h2>
            <script>
                var locations = <?php echo json_encode($locations); ?>;
                var map = L.map('map').setView([10.7905, 78.7047], 6); // Center on Tamil Nadu

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 18,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                var maxVolume = -1; // To find the maximum volume
                var maxLocation = null; // To store the location with the maximum volume

                locations.forEach(function(location) {
                    var marker = L.marker([location.latitude, location.longitude]).addTo(map)
                        .bindPopup('<strong>' + location.district + '</strong><br>Volume: ' + location.volume);

                    // Check if this location has the highest volume
                    if (location.volume > maxVolume) {
                        maxVolume = location.volume;
                        maxLocation = marker; // Keep reference to this marker
                    }
                });

                // Change color for the marker with the highest production
                if (maxLocation) {
                    maxLocation.setIcon(L.AwesomeMarkers.icon({
                        icon: 'star',
                        markerColor: 'red' // Red color for the highest production
                    }));
                }
            </script>

            <h2 class="mt-4">Production Distribution</h2>
            <div style="max-width: 400px; margin: auto;">
    <canvas id="productionChart" width="400" height="400"></canvas>
          </div>


            <script>
                var cropData = <?php echo json_encode($cropData); ?>;
                var ctx = document.getElementById('productionChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(cropData),
                        datasets: [{
                            label: 'Production Volume',
                            data: Object.values(cropData),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            </script>
        <?php endif; ?>
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
