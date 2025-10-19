<?php
require "connection.php";
session_start();

if (!isset($_SESSION["seller_id"])) {
    echo "Unauthorized!";
    exit();
}

$seller_id = $_SESSION["seller_id"];
$product_id = $_POST['id'] ?? 0;

// Ensure seller can only delete their own product
$check = Database::search("SELECT * FROM products WHERE id = '$product_id' AND seller_id = '$seller_id'");
if ($check->num_rows > 0) {
    Database::iud("DELETE FROM products WHERE id = '$product_id' AND seller_id = '$seller_id'");
    echo "Product deleted successfully.";
} else {
    echo "Invalid request.";
}

?>