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
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logout-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
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
