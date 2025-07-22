<?php
require_once 'connection.php';
session_start(); // Start session to get logged-in user
$logged_in_user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];

    // Check if the logged-in user owns this comment
    $check_query = "SELECT customer_id FROM comments WHERE id = $comment_id";
    $check_result = Database::search($check_query);
    $comment = $check_result->fetch_assoc();

    if ($comment && $comment['customer_id'] == $logged_in_user_id) {
        // Delete the comment
        $delete_query = "DELETE FROM comments WHERE id = $comment_id";
        if (Database::iud($delete_query)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error"; // User does not own the comment
    }
} else {
    echo "error";
}
?>
