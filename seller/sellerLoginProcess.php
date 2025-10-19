<?php
session_start();
require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

if (empty($email)) {
    echo ("Please enter your Email");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email");
} else if (empty($password)) {
    echo ("Please enter your Password");
} else {
    // Check if seller exists with email + password
    $rs = Database::search("SELECT * FROM `seller` WHERE `email`='" . $email . "' AND `pwd`='" . $password . "'");
    $n = $rs->num_rows;

    if ($n == 1) {
        $d = $rs->fetch_assoc();

        // ✅ Store seller info in session
        $_SESSION["seller_id"]   = $d['id'];     // primary key
        $_SESSION["seller_name"] = $d['fname'];  // first name
        $_SESSION["seller_email"] = $d['email']; // email

        echo ("success");

        // Handle "remember me"
        if ($rememberme == "true") {
            setcookie("email", $email, time() + (60 * 60 * 24 * 365), "/");
            setcookie("password", $password, time() + (60 * 60 * 24 * 365), "/");
        } else {
            setcookie("email", "", time() - 3600, "/");
            setcookie("password", "", time() - 3600, "/");
        }
    } else {
        echo ("Invalid username or Password");
    }
}
