<?php
session_start();
require_once "connection.php";
require_once "SMTP.php";
require_once "PHPMailer.php";
require_once "Exception.php";

date_default_timezone_set('Asia/Colombo'); // Set your server's time zone

use PHPMailer\PHPMailer\PHPMailer;

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get user email
Database::setUpConnection();
$result = Database::search("SELECT email, fname, lname FROM customer WHERE id = '$user_id'");
$user = $result->fetch_assoc();
$email = $user['email'];
$name = $user['fname'] . ' ' . $user['lname'];



// Generate token and expiration
$token = bin2hex(random_bytes(16));
$expires_at = date('Y-m-d H:i:s', time() + 3600); // 1 hour expiration

// Store token
Database::iud("INSERT INTO password_resets (user_id, token, expires_at) 
             VALUES ('$user_id', '$token', '$expires_at')");

// Send email (using PHPMailer)
$reset_link = "http://localhost/JIAT/VIVA/Newtech/reset_password.php?token=$token";
$subject = "Password Reset Request";
$message = "Click here to reset your password: <a href='$reset_link'>$reset_link</a>";

try {
    $mail = new PHPMailer(true); // Initialize PHPMailer

    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host = 'smtp.gmail.com';                             // Set the SMTP server
    $mail->SMTPAuth = true;                                     // Enable SMTP authentication
    $mail->Username = 'gkithupa@gmail.com';                     // SMTP username
    $mail->Password = 'uuvq gdyy gtsr exsk';                    // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
    $mail->Port = 465;                                          // TCP port to connect to

    // Recipients
    $mail->setFrom('gkithupa@gmail.com', 'Your App Name');      // Use your SMTP email here
    $mail->addAddress($email, $name);                           // Add the user's email
    $mail->addReplyTo('gkithupa@gmail.com', 'Your App Name');   // Set reply-to address

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();
    $_SESSION['message'] = "Password reset link sent to your email!";
} catch (Exception $e) {
    $_SESSION['message'] = "Failed to send the password reset link. Please try again.";
}

// Redirect back to profile
header("Location: userProfile.php");
exit();