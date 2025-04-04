<?php
session_start();
$conn = new mysqli("localhost:3307", "root", "", "user_db"); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST["fullName"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

 
    if (empty($fullName) || empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields!');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!');</script>";
    } elseif (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long!');</script>";
    } else {
       
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            echo "<script>alert('Error: Email already registered! Please use another email.');</script>";
        } else {
            
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $fullName, $email, $hashedPassword);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful! Redirecting to login...'); window.location='user_login.php';</script>";
            } else {
                echo "<script>alert('Error: Registration failed. Please try again later.');</script>";
            }

            $stmt->close();
        }

        $checkStmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { 
    display: flex; 
    justify-content: center; 
    align-items: center; 
    height: 100vh; 
    background: url('img(6).jpg') no-repeat center center/cover;
    
}
        .container { display: flex; justify-content: center; align-items: center; width: 100%; }
        .form-box { 
    background: rgba(255, 255, 255, 0.2); /* Semi-transparent white */
    backdrop-filter: blur(10px); /* Blurred background effect */
    padding: 20px; 
    border-radius: 10px; 
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); 
    width: 350px; 
    text-align: center; 
}
  h2 { margin-bottom: 20px; }
        .input-group { margin: 10px 0; }
        input { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
        .btn { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px; font-size: 16px; }
        .btn:hover { background: #0056b3; }
        .toggle-text { margin-top: 15px; }
        .toggle-text a { color: #007bff; text-decoration: none; }
        .toggle-text a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-box">
            <h2>Sign Up</h2>
            <form method="POST">
                <div class="input-group">
                    <input type="text" name="fullName" placeholder="Full Name" required>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn">Sign Up</button>
            </form>
            <p class="toggle-text">
                Already have an account? <a href="user_login.php">Login</a>
            </p>
        </div>
    </div>

</body>
</html>
