<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

    if (!empty($username) && !empty($email) && !empty($_POST['password'])) {
        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $email);

        if ($stmt->execute()) {
            $message = "Signup successful! You can now <a href='login.php'>login</a>.";
        } else {
            $message = "User already exists or invalid data.";
        }
        $stmt->close();
    } else {
        $message = "Please enter valid information.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #5cb85c;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        p {
            text-align: center;
            color: #666;
        }

        a {
            color: #5cb85c;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .message {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Signup</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Signup">
    </form>
    <p class="message"><?php echo $message; ?></p>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

</body>
</html>
