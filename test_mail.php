<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Create an instance of PHPMailer
$mail = new PHPMailer(true);

try {
    // Enable debugging (Set to 0 when working)
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 't2970642@gmail.com';  // Your Gmail address
    $mail->Password   = 'adxb sbln odjg abpu';  // Your generated App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    
    // Email sender and recipient
    $mail->setFrom('haransrihari533@gmail.com', 'Sri Hariharan'); // Your Email
    $mail->addAddress('srihariharans582@gmail.com', 'Recipient'); // Recipient Email

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from PHPMailer';
    $mail->Body    = '<h1>Hello, this is a test email from PHPMailer!</h1>';
    $mail->AltBody = 'Hello, this is a test email from PHPMailer!';

    // Send email
    $mail->send();
    echo 'Email has been sent successfully!';
} catch (Exception $e) {
    echo 'Error sending email: ' . $mail->ErrorInfo;
}
?>
