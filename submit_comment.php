<?php
require_once 'connection.php';

// Process the comment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['comment'])) {
    $product_id = $_POST['product_id'];
    $comment = $_POST['comment'];
    $customer_id = 1;

    if (empty($comment)) {
        echo "error";
        exit();
    }

    $query = "INSERT INTO comments (product_id, customer_id, comment) VALUES ($product_id, $customer_id, '$comment')";
    if (Database::iud($query)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
