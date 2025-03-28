<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Wash Finder</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 800px;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #004085;
            font-size: 24px;
            margin-bottom: 15px;
            text-transform: uppercase;
            border-bottom: 3px solid #ffc107;
            display: inline-block;
            padding-bottom: 5px;
        }

        p {
            color: #333;
            font-size: 16px;
            line-height: 1.6;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            text-align: left;
        }

        .info-table th, .info-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .info-table th {
            background-color: #004085;
            color: white;
            font-weight: bold;
        }

        .shop {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #004085;
            text-align: left;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
        }

        .shop a {
            color: #004085;
            text-decoration: none;
            font-weight: bold;
        }

        .shop a:hover {
            text-decoration: underline;
        }

        .error {
            color: #d9534f;
            font-weight: bold;
            font-size: 16px;
        }

        .success {
            color: #28a745;
            font-weight: bold;
            font-size: 16px;
        }

        /* Professional Button */
        .book-btn {
            background-color: #ffc107;
            color: #004085;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .book-btn:hover {
            background-color: #e0a800;
            color: white;
        }

        /* Responsive Design */
        @media screen and (max-width: 600px) {
            .container {
                padding: 20px;
            }
            
            h2 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }

            .info-table th, .info-table td {
                padding: 8px;
                font-size: 14px;
            }

            .book-btn {
                font-size: 13px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $address = trim($_POST['address'] ?? '');

        if (empty($username) || empty($phone) || empty($email) || empty($address)) {
            echo "<p class='error'>All fields are required.</p>";
            exit;
        }

        function fetch_data($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if (curl_errno($ch) || $http_code != 200) {
                curl_close($ch);
                return false;
            }
            curl_close($ch);
            return $response;
        }

        // Fetch user location coordinates
        $geoUrl = "https://nominatim.openstreetmap.org/search?q=" . urlencode($address) . "&format=json&limit=1";
        $geoResponse = fetch_data($geoUrl);
        $geoData = json_decode($geoResponse, true);

        if (!empty($geoData) && isset($geoData[0]['lat']) && isset($geoData[0]['lon'])) {
            $latitude = $geoData[0]['lat'];
            $longitude = $geoData[0]['lon'];
            $full_address = $geoData[0]['display_name'];

            echo "<h2 class='success'>Booking Confirmation</h2>";

            echo "<table class='info-table'>";
            echo "<tr><th>Customer Name</th><td>$username</td></tr>";
            echo "<tr><th>Phone Number</th><td>$phone</td></tr>";
            echo "<tr><th>Email Address</th><td>$email</td></tr>"; // Added email
            echo "<tr><th>Address</th><td>$full_address</td></tr>";
            echo "<tr><th>Latitude</th><td>$latitude</td></tr>";
            echo "<tr><th>Longitude</th><td>$longitude</td></tr>";
            echo "</table>";

            // Fetch nearby bike wash shops
            $overpassQuery = urlencode("[out:json];node[\"amenity\"=\"car_wash\"](around:5000, $latitude, $longitude);out;");
            $overpassUrl = "https://overpass-api.de/api/interpreter?data={$overpassQuery}";
            $placesResponse = fetch_data($overpassUrl);
            $placesData = json_decode($placesResponse, true);

            echo "<h2>Nearby Bike Wash Shops</h2>";
            if (!empty($placesData['elements'])) {
                foreach ($placesData['elements'] as $place) {
                    $shop_name = isset($place['tags']['name']) ? htmlspecialchars($place['tags']['name']) : "Unnamed Bike Wash";
                    $shop_lat = $place['lat'];
                    $shop_lon = $place['lon'];

                    echo "<div class='shop'>";
                    echo "<p><strong>$shop_name</strong></p>";
                    echo "<p>📍 Location: <a href='https://www.google.com/maps?q=$shop_lat,$shop_lon' target='_blank'>View on Google Maps</a></p>";

                    echo "<form action='book.php' method='POST'>
                        <input type='hidden' name='shop_name' value='$shop_name'>
                        <input type='hidden' name='shop_lat' value='$shop_lat'>
                        <input type='hidden' name='shop_lon' value='$shop_lon'>
                        <input type='hidden' name='customer_name' value='$username'>
                        <input type='hidden' name='customer_phone' value='$phone'>
                        <input type='hidden' name='customer_email' value='$email'> <!-- Added email -->
                        <button type='submit' class='book-btn'>Book Now</button>
                    </form>";

                    echo "</div>";
                }
            } else {
                echo "<p class='error'>No bike wash shops found within 5 km.</p>";
            }
        } else {
            echo "<p class='error'>Invalid address. Please enter a valid location.</p>";
        }
    } else {
        echo "<p class='error'>Invalid request.</p>";
    }
    ?>
</div>

</body>
</html>
