<?php
require_once 'connection.php';

session_start();
header('Content-Type: application/json');

Database::setUpConnection();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'You must be logged in to manage your wishlist.']);
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['action'])) {
        $action = $data['action'];

        // Add to Wishlist
        if ($action === 'add' && isset($data['product_id'])) {
            $product_id = $data['product_id'];

            $query = "SELECT * FROM wishlists WHERE user_id = ? AND product_id = ?";
            $stmt = Database::$connection->prepare($query);
            $stmt->bind_param("ii", $user_id, $product_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                $insert_query = "INSERT INTO wishlists (user_id, product_id, created_at) VALUES (?, ?, NOW())";
                $insert_stmt = Database::$connection->prepare($insert_query);
                $insert_stmt->bind_param("ii", $user_id, $product_id);

                if ($insert_stmt->execute()) {
                    echo json_encode(['status' => 'success', 'message' => 'Product added to wishlist.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to add product to wishlist.']);
                }
            } else {
                echo json_encode(['status' => 'exists', 'message' => 'Product is already in your wishlist.']);
            }

            exit;
        }

        // Remove from Wishlist
        if ($action === 'remove' && isset($data['wishlist_id'])) {
            $wishlist_id = $data['wishlist_id'];

            $delete_query = "DELETE FROM wishlists WHERE id = ? AND user_id = ?";
            $delete_stmt = Database::$connection->prepare($delete_query);
            $delete_stmt->bind_param("ii", $wishlist_id, $user_id);

            if ($delete_stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Product removed from wishlist.']);
            } else {
                // Log the error for debugging
                $error = $delete_stmt->error;
                echo json_encode(['status' => 'error', 'message' => 'Failed to remove product from wishlist. Error: ' . $error]);
            }

            exit;
        }
    }

    echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
    exit;
}

// Fallback for GET Requests (Legacy Support)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'], $_GET['wishlist_id']) && $_GET['action'] === 'remove') {
        $wishlist_id = intval($_GET['wishlist_id']);

        $delete_query = "DELETE FROM wishlists WHERE id = ? AND user_id = ?";
        $delete_stmt = Database::$connection->prepare($delete_query);
        $delete_stmt->bind_param("ii", $wishlist_id, $user_id);

        if ($delete_stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Product removed from wishlist.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to remove product from wishlist.']);
        }

        exit;
    }
}

// Default Response for Invalid Requests
echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
exit;
