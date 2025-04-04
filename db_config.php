<?php
$host = "localhost:3307";
$user = "root";
$pass = "";
$dbname = "user_db"; // Change to your actual database name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
