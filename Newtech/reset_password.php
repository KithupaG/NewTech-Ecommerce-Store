<?php
session_start();
date_default_timezone_set('Asia/Colombo'); // Set your server's time zone
include "connection.php";

$token = $_GET['token'] ?? '';

if (!$token) {
    echo "<script>alert('Invalid request'); window.location.href = 'login.php';</script>";
    exit();
}

Database::setUpConnection();

// Check if the token is valid
$query = "SELECT * FROM password_resets 
          WHERE token = '$token' 
          AND expires_at > NOW()";
$result = Database::search($query);

if ($result->num_rows === 0) {
    echo "<script>alert('Invalid or expired token'); window.location.href = 'login.php';</script>";
    exit();
}

// If the token is valid, show the reset password form
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Reset Password</h2>
        <form method="post" action="update_password.php">
            <input type="hidden" name="token" value="<?= $token ?>">
            
            <div class="form-group mb-3">
                <label>New Password:</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            
            <div class="form-group mb-3">
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
</body>
</html>