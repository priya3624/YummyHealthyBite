<?php
// Start a session
session_start();

// If the admin is already logged in, redirect to the dashboard
if (isset($_SESSION['adminUsername'])) {
    header('Location: dashboard.php'); // Change 'dashboard.php' to your dashboard page
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../includes/config.php';

    // Get form data
    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];

    // Query the database
    $sql = "SELECT * FROM Admins WHERE username='$usernameInput' AND password='$passwordInput'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        $_SESSION['adminUsername'] = $usernameInput;
        echo "<script>alert('Login successful!');</script>";
        header('Refresh: .5; URL = dashboard.php');
        exit;
    } else {
        // Invalid credentials
        echo "<script>alert('Invalid username or password.');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <style>
        body {
            background-image: url('../images/background.jpg');
            background-repeat: no-repeat;
            background-size: cover; /* This will make the image cover the entire page */
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        <form method="post">
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password"  name="password" required="">
                <label>Password</label>
            </div>
            <button type="submit" name="">
              <span class="transition"></span>
              <span class="gradient"></span>
              <span class="label">LOGIN</span>
            </button>
        </form>
    </div>
</body>
</html>
