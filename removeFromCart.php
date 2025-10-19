<?php
require "connection.php"; // Your database connection file
session_start();

// Enhanced Error Reporting (Crucial for debugging)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'An unexpected error occurred.'];

// Log the request details for debugging
error_log("Request Method: " . $_SERVER['REQUEST_METHOD'] . "\n");
error_log("GET parameters: " . print_r($_GET, true) . "\n");

if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];

    // Sanitize the input (ESSENTIAL to prevent SQL injection)
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_NUMBER_INT);

    error_log("Sanitized cart_id: " . $cart_id . "\n");

    if (isset($_SESSION['user_id'])) {
        $customer_id = $_SESSION['user_id'];

        Database::setUpConnection(); // Call to establish connection

        if (Database::$connection) { //Check if connection is established
            try {
                $stmt = Database::$connection->prepare("DELETE FROM cart WHERE id = ? AND customer_id = ?");
                if ($stmt) {
                    $stmt->bind_param("ii", $cart_id, $customer_id);
                    $stmt->execute();
                    $rows_affected = $stmt->affected_rows;
                    if ($rows_affected > 0) {
                        $response = ['status' => 'success', 'message' => 'Item removed from cart successfully.'];
                    } else {
                        $response = ['status' => 'error', 'message' => 'No rows were affected by the delete query. The cart item may not exist. '];
                    }
                    $stmt->close();
                } else {
                    $response = ['status' => 'error', 'message' => 'Statement preparation failed: ' . Database::$connection->error];
                }
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => 'Database exception: ' . $e->getMessage()];
                error_log("Database Exception: " . $e->getMessage() . "\n");
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Database connection failed. ' . Database::$connection->connect_error];
        }

    } else {
        $response = ['status' => 'error', 'message' => 'User not logged in.'];
    }
} else {
    $response = ['status' => 'error', 'message' => 'Cart ID not provided.'];
}

error_log(json_encode($response) . "\n"); // Log final response
echo json_encode($response);

?>

