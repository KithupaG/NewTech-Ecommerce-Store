<?php
session_start();
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? '';
    $product_id = $_POST["product_id"] ?? null;
    $user_id = $_POST["user_id"] ?? null;

    Database::setUpConnection(); // Ensure the database connection is initialized

    if ($action === "submit" && $product_id && $user_id) {
        $rating = $_POST["rating"];
        $query = "INSERT INTO ratings (customer_id, productssss_id, rating) VALUES ('$user_id', '$product_id', '$rating')
                  ON DUPLICATE KEY UPDATE rating = '$rating'";
        if (Database::iud($query)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Error submitting rating."]);
        }
    } elseif ($action === "remove" && $product_id && $user_id) {
        $query = "DELETE FROM ratings WHERE customer_id = '$user_id' AND productssss_id = '$product_id'";
        if (Database::iud($query)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Error removing rating."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid action or missing parameters."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
