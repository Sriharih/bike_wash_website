<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Logout</title>
    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: url('img(6).jpg') no-repeat center center/cover;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logout-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 25px;
            background: rgba(0, 0, 0, 0.8); /* Semi-transparent white */
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            backdrop-filter: blur(10px); /* Glassmorphism effect */
            border: 1px solid rgba(255, 255, 255, 0.4);
            text-align:center;
        }

        h2 {
            /*background:rgb(245, 217, 127);*/
            margin-bottom: 20px;
            color: rgb(245, 217, 127);
        }

        .btn {
            display: inline-block;
            background-color: #1e3a8a; /* Dark blue */
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
            margin: 10px;
        }

        .btn:hover {
            background-color: #0f256e; /* Darker blue */
        }

        .btn.cancel {
            background-color: #ccc;
            color: black;
        }

        .btn.cancel:hover {
            background-color: #999;
        }
    </style>
</head>
<body>

    <div class="logout-container">
        <h2>Are you sure you want to logout?</h2>
        <a href="logout.php"><button class="btn">Yes, Logout</button></a>
        <a href="home.php"><button class="btn cancel">No, Go Back</button></a>
    </div>

</body>
</html>
