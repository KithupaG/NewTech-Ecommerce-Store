<?php
require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_GET["e"])) {
  $email = $_GET["e"];
  $rs = Database::search("SELECT * FROM `customer` WHERE `email`='" . $email . "'");
  $n = $rs->num_rows;

  if ($n == 1) {
    $code = substr(uniqid(), 0, 6); // Limit uniqid to 6 characters
    Database::iud("UPDATE `customer` SET `verification`='" . $code . "' WHERE `email`='" . $email . "'");

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'gkithupa@gmail.com';
    $mail->Password = 'gylkerjusdpigqre';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $msg = "Your verification code is: " . $code;

    $mail->setFrom('gkithupa@gmail.com', 'Verification Code');
    $mail->addAddress($email);
    $mail->addReplyTo('gkithupa@gmail.com', 'Information');

    $mail->isHTML(true);
    $mail->Subject = 'Email By Kithupa!';
    $mail->Body = $msg;

    if (!$mail->send()) {
      echo 'Verification code sending failed';
    } else {
      echo 'Success';
    }
  } else {
    echo ("Invalid Email address");
  }
}