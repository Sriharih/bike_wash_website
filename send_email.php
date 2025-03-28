<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customer_name'], $_POST['customer_email'], $_POST['payment_status'])) {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $payment_status = $_POST['payment_status'];

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
        $mail->Subject = 'Booking Confirmation';
        $mail->Body = "<h2>Booking Confirmation</h2>
                       <p>Dear $customer_name,</p>
                       <p>Your booking has been confirmed.</p>
                       <p>Payment Status: <strong>$payment_status</strong></p>
                       <p>Thank you for choosing our service!</p>";

        if ($mail->send()) {
            echo "Email sent successfully";
        } else {
            echo "Error sending email: " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request";
}
?>
