<?php
require_once 'connection.php';
session_start();

if (!isset($_GET['order_id'])) {
    die("Invalid request. Order ID not found!");
}

$order_id = $_GET['order_id'];

echo "<h1>Payment Successful!</h1>";
echo "<p>Your Order ID: " . htmlspecialchars($order_id) . "</p>";
echo "<p>Thank you for your payment. Your order is being processed.</p>";
