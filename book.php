<?php
session_start();
require 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php'; 
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['shop_name'], $_POST['shop_lat'], $_POST['shop_lon'], $_POST['customer_name'], $_POST['customer_phone'], $_POST['customer_email'])) {

    $shop_name = htmlspecialchars(trim($_POST['shop_name']));
    $shop_lat = filter_var($_POST['shop_lat'], FILTER_VALIDATE_FLOAT);
    $shop_lon = filter_var($_POST['shop_lon'], FILTER_VALIDATE_FLOAT);
    $customer_name = htmlspecialchars(trim($_POST['customer_name']));
    $customer_phone = htmlspecialchars(trim($_POST['customer_phone']));
    $customer_email = htmlspecialchars(trim($_POST['customer_email']));
    if ($shop_lat === false || $shop_lon === false) {
        die("<p style='color: red;'>Invalid shop location.</p>");
    }

    $order_id = rand(10000, 99999);

    // Database connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("<p style='color: red;'>Database connection failed: " . $conn->connect_error . "</p>");
    }

    // Insert booking details into database
    $stmt = $conn->prepare("INSERT INTO bookings (user, phone, shop_name, shop_lat, shop_lon, status) VALUES (?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("sssss", $customer_name, $customer_phone, $shop_name, $shop_lat, $shop_lon);

    if ($stmt->execute()) {
        $booking_id = $stmt->insert_id;
    } else {
        die("<p style='color: red;'>Error: " . $stmt->error . "</p>");
    }

    $stmt->close();
    $conn->close();

    // Send Confirmation Email
    //$customer_email = "customer@example.com"; // Replace this with real email input from form

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 't2970642@gmail.com'; // Change this
        $mail->Password = 'adxb sbln odjg abpu'; // Change this (use App Password if 2FA is enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('t2970642@gmail.com', 'Bike Wash Service');
        $mail->addAddress($customer_email);

        $mail->isHTML(true);
        $mail->Subject = 'Bike Wash Booking Confirmation';
        $mail->Body = "
            <h2>Booking Confirmation</h2>
            <p>Dear $customer_name,</p>
            <p>Your booking at <strong>$shop_name</strong> has been confirmed.</p>
            <p>Booking ID: <strong>$order_id</strong></p>
            <p>Thank you for choosing our service!</p>
        ";

        $mail->send();
    } catch (Exception $e) {
        error_log("Mail error: " . $mail->ErrorInfo);
    }

    // UPI Payment Setup
    $upi_id = "haransrihari533@oksbi";
    $amount = 100;
    $upi_link = "upi://pay?pa=" . urlencode($upi_id) . "&pn=" . urlencode("SRIHARIHARAN S") . "&tid=" . urlencode($order_id) . "&tr=" . urlencode($order_id) . "&tn=" . urlencode("Bike Wash Payment") . "&am=" . urlencode($amount) . "&cu=INR";
    $qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode($upi_link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            width: 90%;
            max-width: 500px;
            margin: 40px auto;
            padding: 25px;
            background: white;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            text-align: left;
        }
        h2 {
            color: #1e3a8a;
            text-align: center;
            margin-bottom: 20px;
        }
        h3 {
            color: #d4af37;
            margin-top: 20px;
            border-bottom: 2px solid #d4af37;
            padding-bottom: 5px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 8px 0;
        }
        .details {
            padding: 10px 15px;
            background: #f9f9f9;
            border-radius: 8px;
            margin-top: 10px;
        }
        .qr-container {
            text-align: center;
            margin: 20px 0;
        }
        img.qr-code {
            width: 200px;
            height: 200px;
            border: 5px solid #1e3a8a;
            border-radius: 10px;
        }
        .pay-btn {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            transition: transform 0.2s;
        }
        .pay-btn.paid {
            background: #1e3a8a;
        }
        .pay-btn.not-paid {
            background: #d4af37;
        }
        .pay-btn:hover {
            transform: scale(1.05);
        }
    </style>
    <script>
        function updatePaymentStatus(status) {
            fetch("update_status.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "id=<?php echo $booking_id; ?>&status=" + status
            }).then(() => {
                alert("Booking confirmed! Redirecting...");
                window.location.href = "home.php";
            }).catch(error => {
                alert("Error updating payment status: " + error);
            });
        }
    </script>
</head>
<body>

    <div class="container">
        <h2>Booking Confirmed</h2>
        <p style="text-align: center;">Your booking at <strong><?php echo $shop_name; ?></strong> has been successfully confirmed.</p>

        <h3>Shop Details</h3>
        <div class="details">
            <p><strong>Shop Name:</strong> <?php echo $shop_name; ?></p>
            <p>Location: <a href="https://www.google.com/maps?q=<?php echo $shop_lat; ?>,<?php echo $shop_lon; ?>" target="_blank">View on Google Maps</a></p>
        </div>

        <h3>Customer Details</h3>
        <div class="details">
            <p><strong>Name:</strong> <?php echo $customer_name; ?></p>
            <p><strong>Phone:</strong> <?php echo $customer_phone; ?></p>
        </div>

        <h3>Payment</h3>
        <p>Scan the QR code below to pay via UPI (Google Pay, PhonePe, Paytm).</p>

        <div class="qr-container">
            <img class="qr-code" src="<?php echo $qr_code_url; ?>" alt="Scan to Pay">
        </div>

        <button onclick="updatePaymentStatus('Paid')" class="pay-btn paid">Pay Online</button>
        <button onclick="updatePaymentStatus('Cash on Delivery')" class="pay-btn not-paid">Cash on Delivery</button>
    </div>

</body>
</html>

<?php
} else {
    echo "<h2>Invalid request</h2>";
}
?>
