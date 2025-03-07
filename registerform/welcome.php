<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the username from session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .welcome-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
        }

        a {
            color: #5bc0de;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="welcome-container">
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <p>We're so glad to have you here.</p>
    <p>You are successfully logged in.</p>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>
