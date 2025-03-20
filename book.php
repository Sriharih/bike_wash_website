<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['shop_name'], $_POST['shop_lat'], $_POST['shop_lon'], $_POST['customer_name'], $_POST['customer_phone'])) {
    
   
    $shop_name = htmlspecialchars(trim($_POST['shop_name']));
    $shop_lat = filter_var($_POST['shop_lat'], FILTER_VALIDATE_FLOAT);
    $shop_lon = filter_var($_POST['shop_lon'], FILTER_VALIDATE_FLOAT);
    $customer_name = htmlspecialchars(trim($_POST['customer_name']));
    $customer_phone = htmlspecialchars(trim($_POST['customer_phone']));

   
    if ($shop_lat === false || $shop_lon === false) {
        die("<p style='color: red;'>Invalid shop location.</p>");
    }

    $order_id = rand(10000, 99999);

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("<p style='color: red;'>Database connection failed: " . $conn->connect_error . "</p>");
    }

  
    $user = $customer_name;
    $phone = $customer_phone;

    $stmt = $conn->prepare("INSERT INTO bookings (user, phone, shop_name, shop_lat, shop_lon, status) VALUES (?, ?, ?, ?, ?, 'Not Paid')");
    $stmt->bind_param("sssss", $user, $phone, $shop_name, $shop_lat, $shop_lon);
    
    if ($stmt->execute()) {
        $booking_id = $stmt->insert_id;
    } else {
        die("<p style='color: red;'>Error: " . $stmt->error . "</p>");
    }

    $stmt->close();
    $conn->close();

    
    $upi_id = "haransrihari533@oksbi"; 
    $amount = 100; 
    $upi_link = "upi://pay?pa=" . urlencode($upi_id) . 
                "&pn=" . urlencode("SRIHARIHARAN S") . 
                "&tid=" . urlencode($order_id) . 
                "&tr=" . urlencode($order_id) . 
                "&tn=" . urlencode("Bike Wash Payment") . 
                "&am=" . urlencode($amount) . 
                "&cu=INR";

    $qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode($upi_link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f4f4f4; }
        .container { width: 50%; margin: auto; padding: 20px; background: white; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); border-radius: 10px; }
        h2 { color: #007bff; }
        a { text-decoration: none; }
        .pay-btn { display: inline-block; padding: 10px 15px; color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; font-size: 16px; margin: 10px; }
        .pay-btn.paid { background: #28a745; } 
        .pay-btn.not-paid { background: #dc3545; } 
        .pay-btn:hover { opacity: 0.8; }
        .qr-container { margin-top: 20px; }
        img.qr-code { width: 250px; height: 250px; border: 5px solid #333; border-radius: 10px; }
    </style>
    <script>
        function paymentSuccess() {
            fetch("update_status.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=<?php echo $booking_id; ?>&status=Paid"
            }).then(() => {
                alert("Payment successful! We will contact you soon.");
                window.location.href = "home.html";
            }).catch(error => {
                alert("Error updating payment status: " + error);
            });
        }
    </script>
</head>
<body>

    <div class="container">
        <h2>Booking Confirmed at <br> <?php echo $shop_name; ?></h2>
        <p>Location: <a href="https://www.google.com/maps?q=<?php echo $shop_lat; ?>,<?php echo $shop_lon; ?>" target="_blank">View on Google Maps</a></p>
        
        <h3>Customer Details</h3>
        <p><strong>Name:</strong> <?php echo $customer_name; ?></p>
        <p><strong>Phone:</strong> <?php echo $customer_phone; ?></p>
        
        <h3>Proceed with Payment:</h3>
        <p>Scan the QR code below to pay via Google Pay:</p>
        
        <div class="qr-container">
            <img src="<?php echo $qr_code_url; ?>" alt="Scan to Pay">
        </div>

        <br>
        <a href="#" onclick="paymentSuccess()" class="pay-btn paid">already paid</a>
        <a href="home.html" class="pay-btn not-paid">Cash on Delivery</a>
    </div>

</body>
</html>
<?php
} else {
    echo "<h2>Invalid request</h2>";
}
?>
