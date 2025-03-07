<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                // Store user ID and username in session
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;  // Store username in session
                header('Location: welcome.php');
                exit();
            } else {
                $message = "Incorrect password.";
            }
        } else {
            $message = "User not found.";
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
    <title>Login</title>
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
            background-color: #5bc0de;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #31b0d5;
        }

        p {
            text-align: center;
            color: #666;
        }

        a {
            color: #5bc0de;
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
    <h2>Login</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <p class="message"><?php echo $message; ?></p>
    <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
</div>

</body>
</html>
