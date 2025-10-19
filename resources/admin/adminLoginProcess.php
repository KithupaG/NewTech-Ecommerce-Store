<?php

include "connection.php";

$username = $_POST["username"];
$password = $_POST["password"];

$rs = Database::search("SELECT * FROM `admin` WHERE `admin_user`='" . $username . "' AND `admin_pwd`='" . $password . "'");
$n = $rs->num_rows;

if ($n == 1) {
    echo ("success");
} else {
    echo ("Invalid username or Password");
}
