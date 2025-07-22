<?php
session_start();
date_default_timezone_set('Asia/Colombo'); // Set your server's time zone
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

    Database::setUpConnection();
    
    // Verify token
    $result = Database::search("SELECT user_id FROM password_resets 
                               WHERE token = '$token' 
                               AND expires_at > NOW()");
    
    if ($result->num_rows === 0) {
        echo "<script>alert('Invalid or expired token'); window.location.href = 'login.php';</script>";
        exit();
    }
    
    $reset_data = $result->fetch_assoc();
    $user_id = $reset_data['user_id'];
    
    // Update password
    Database::iud("UPDATE customer SET pwd = '$new_password' 
                 WHERE id = '$user_id'");
    
    // Delete used token
    Database::iud("DELETE FROM password_resets WHERE token = '$token'");
    
    echo "<script>alert('Password updated successfully!'); window.location.href = 'login.php';</script>";
    exit();
}