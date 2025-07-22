<?php
session_start();
require 'connection.php';

header('Content-Type: application/json');
$response = ['status' => 'error', 'message' => 'An unexpected error occurred.'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $product_id = isset($data['product_id']) ? filter_var($data['product_id'], FILTER_SANITIZE_NUMBER_INT) : null;
    $quantity = isset($data['quantity']) ? filter_var($data['quantity'], FILTER_SANITIZE_NUMBER_INT) : null;
    $customer_id = isset($data['customer_id']) ? filter_var($data['customer_id'], FILTER_SANITIZE_NUMBER_INT) : null;
    
    if (is_null($product_id) || is_null($quantity) || is_null($customer_id)) {
        $response['message'] = 'Product ID, Quantity, or Customer ID not provided.';
    } elseif ($quantity <= 0) {
        $response['message'] = 'Quantity must be greater than 0.';
    } else {
        Database::setUpConnection();

        $checkIfExists = Database::$connection->prepare("SELECT * FROM cart WHERE product_id = ? AND customer_id = ?");
        if ($checkIfExists) {
            $checkIfExists->bind_param("ii", $product_id, $customer_id);
            $checkIfExists->execute();
            $result = $checkIfExists->get_result();
            if ($result->num_rows > 0) {
                $response = ['status' => 'error', 'message' => 'Item is already in the cart.'];
            } else {
                $stmt = Database::$connection->prepare("INSERT INTO cart (product_id, quantity, customer_id, added_at) VALUES (?, ?, ?, CURRENT_TIMESTAMP);");

                if ($stmt) {
                         $stmt->bind_param("iii", $product_id, $quantity, $customer_id);
                    if ($stmt->execute()) {
                        $response = ['status' => 'success', 'message' => 'Item added to cart successfully.'];
                    } else {
                        $response['message'] = "Error inserting item into cart: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $response['message'] = "Error preparing statement: " . Database::$connection->error;
                }
            }
            $checkIfExists->close();
        } else {
            $response['message'] = "Error preparing statement: " . Database::$connection->error;
        }
    }
} else {
    $response['message'] = 'Invalid request method. Only POST requests are allowed.';
}

echo json_encode($response);
