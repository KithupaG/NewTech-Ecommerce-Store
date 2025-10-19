<?php
require_once 'connection.php';

// Retrieve payment details sent by PayHere
$merchant_id = $_POST['merchant_id'] ?? null;
$order_id = $_POST['order_id'] ?? null;
$payhere_amount = $_POST['payhere_amount'] ?? null;
$payhere_currency = $_POST['payhere_currency'] ?? null;
$status_code = $_POST['status_code'] ?? null;

// Validate required fields
if (!$merchant_id || !$order_id || !$payhere_amount || !$payhere_currency || !$status_code) {
    http_response_code(400); // Bad request
    echo "Invalid notification data.";
    exit;
}

// Validate the payment status
if ($status_code == 2) { // Status code 2 indicates success
    // Update the order in your database
    Database::setUpConnection();
    $query = "UPDATE orders SET status = 'Paid', placed_at = NOW() WHERE id = '$order_id'";
    if (Database::iud($query)) {
        http_response_code(200); // Success response
        echo "Payment processed successfully.";
    } else {
        http_response_code(500); // Server error
        echo "Failed to update the order in the database.";
    }
} else {
    http_response_code(400); // Bad request
    echo "Payment failed or incomplete.";
}
?>
