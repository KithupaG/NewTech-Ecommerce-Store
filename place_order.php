<?php
session_start();

require_once 'connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in!";
    exit();
}

if (isset($_POST['cart_items']) && isset($_POST['total_amount']) && isset($_POST['final_total']) && isset($_POST['voucher_code']) && isset($_POST['voucher_discount']) && isset($_POST['payment_method']) && isset($_POST['address_line1']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['country']) && isset($_POST['postal_code'])) {
    $cartItems = json_decode($_POST['cart_items'], true);
    $totalAmount = $_POST['total_amount'];
    $finalTotal = $_POST['final_total'];
    $voucherCode = $_POST['voucher_code'];
    $voucherDiscount = $_POST['voucher_discount'];
    $payment_method = $_POST['payment_method'];
    $customer_id = $_SESSION['user_id'];
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'] ?? null;
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];

    // Insert the order into the orders table
    $insert_order_query = "INSERT INTO orders (total_amount, final_total, placed_at, customer_id, payment_method, voucher_code, voucher_discount, address_line1, address_line2, city, state, country, postal_code, status)
                           VALUES (?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";
    $stmt = Database::$connection->prepare($insert_order_query);
    $stmt->bind_param("dssssssssssss", $totalAmount, $finalTotal, $customer_id, $payment_method, $voucherCode, $voucherDiscount, $address_line1, $address_line2, $city, $state, $country, $postal_code);
    $order_result = $stmt->execute();

    if ($order_result) {
        $order_id = $stmt->insert_id;

        // Insert the order items into the order_items table
        foreach ($cartItems as $item) {
            $insert_order_item_query = "INSERT INTO order_items (order_id, product_id, quantity, price)
                                        VALUES (?, ?, ?, ?)";
            $stmt = Database::$connection->prepare($insert_order_item_query);
            $stmt->bind_param("iiii", $order_id, $item['product_id'], $item['quantity'], $item['price']);
            $stmt->execute();
        }

        if ($payment_method == 'bank_transfer') {
            // Redirect to the bank transfer page
            header('Location: banktransfer.php?order_id=' . $order_id);
            exit;
        } elseif ($payment_method == 'pay_now') {
            // Integrate with the PayHere payment gateway
            // Pass the necessary information to the PayHere integration script
            include 'payhere_integration.php';
        } else {
            // Redirect to the order confirmation page
            header('Location: order_confirmation.php?order_id=' . $order_id);
            exit;
        }
    } else {
        echo "Error placing the order. Please try again.";
    }
} else {
    echo "Invalid request. Please try again.";
}
?>
