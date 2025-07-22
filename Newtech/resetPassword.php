<?php
require "connection.php";

$email = $_POST["e"];
$np = $_POST["n"];
$rnp = $_POST["r"];
$vcode = $_POST["v"];

if (empty($email)) {
  echo ("Missing Email address");
} else if (empty($np)) {
  echo ("Please insert a New Password");
} else if (strlen($np) < 5 || strlen($np) > 20) {
  echo ("Invalid Password");
} else if (empty($rnp)) {
  echo ("Please Re-type your New Password");
} else if ($np != $rnp) {
  echo ("Password is not matched");
} else if (empty($vcode)) {
  echo ("Please enter your Verification Code");
} else {
  $rs = Database::search("SELECT * FROM `customer` WHERE `email`='" . $email . "' AND `verification`='" . $vcode . "'");
  $n = $rs->num_rows;

  if ($n == 1) {
    Database::iud("UPDATE `customer` SET `pwd`='" . $np . "' WHERE `email`='" . $email . "'");
    echo ("success");
  } else {
    echo ("Invalid Email or Verification Code");
  }
}
