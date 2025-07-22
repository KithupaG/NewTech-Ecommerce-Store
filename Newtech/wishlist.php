<?php
require_once 'connection.php';

session_start();
Database::setUpConnection();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT products.id AS product_id, products.name, products.image_url, products.price, 
          products.quantity, wishlists.id AS wishlist_id 
          FROM wishlists
          JOIN products ON wishlists.product_id = products.id
          WHERE wishlists.user_id = $user_id";

$result = Database::search($query);
$wishlist_items = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/universal.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="js/main.js" defer></script>
    <title>Wishlist | New Tech</title>
</head>

<body>
    <section class="h-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div>
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0 text-black"><i class="fas fa-star" style="color: goldenrod;"></i> Wish List</h1>
                                            <h6 id="wishlist-count" class="mb-0 text-muted">
                                                <?php echo count($wishlist_items); ?> item(s)
                                            </h6>
                                        </div>
                                        <hr class="my-4">

                                        <?php if (!empty($wishlist_items)): ?>
                                            <?php foreach ($wishlist_items as $item): ?>
                                                <div class="row mb-4 d-flex justify-content-between align-items-center wishlist-item">
                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                        <img src="resources/products/<?php echo $item['image_url']; ?>" class="img-fluid rounded-3" alt="Product">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                        <h6 class="text-black mb-0">
                                                            <a href="product.php?id=<?php echo $item['product_id']; ?>" style="text-decoration: none; color: black;">
                                                                <?php echo $item['name']; ?>
                                                            </a>
                                                        </h6>
                                                    </div>
                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                        <h6 class="mb-0">Rs. <?php echo $item['price']; ?></h6>
                                                    </div>
                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                        <?php if ($item['quantity'] > 0): ?>
                                                            <h6 class="mb-0" style="background-color: rgba(9, 241, 67, 0.445); text-align: center; border: 1px solid rgb(10, 209, 60); padding: 10px; border-radius: 5px; color: rgb(10, 209, 60);">In-Stock</h6>
                                                        <?php else: ?>
                                                            <h6 class="mb-0" style="background-color: rgba(255, 0, 0, 0.2); text-align: center; border: 1px solid red; padding: 10px; border-radius: 5px; color: red;">Out of Stock</h6>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                        <a href="wishlistProcess.php?action=remove&wishlist_id=<?php echo $item['wishlist_id']; ?>" class="text-muted remove-wishlist" data-id="<?php echo $item['wishlist_id']; ?>">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <hr class="my-4">
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p id="empty-message" class="text-center">Your wishlist is empty.</p>
                                        <?php endif; ?>

                                        <div class="pt-5">
                                            <h6 class="mb-0">
                                                <a href="store.php" class="text-body">
                                                    <i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const removeButtons = document.querySelectorAll(".remove-wishlist");
            const wishlistCount = document.getElementById("wishlist-count");

            removeButtons.forEach((button) => {
                button.addEventListener("click", function(e) {
                    e.preventDefault();
                    const wishlistId = this.getAttribute("data-id");

                    if (!wishlistId) {
                        console.error("Wishlist ID is missing");
                        return;
                    }

                    fetch("wishlistProcess.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({
                                action: "remove",
                                wishlist_id: wishlistId,
                            }),
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.status === "success") {
                                alert(data.message); // Success alert

                                // Log the item row being removed
                                const itemRow = this.closest(".row");
                                console.log("Item row to be removed:", itemRow); // Log the item row element

                                if (itemRow) {
                                    itemRow.remove(); // Remove the row if it exists
                                } else {
                                    console.error("Item row not found.");
                                }

                                // Update the wishlist count
                                let currentCount = parseInt(wishlistCount.textContent) || 0;
                                currentCount = currentCount > 0 ? currentCount - 1 : 0;
                                wishlistCount.textContent = currentCount + " item(s)";

                                // Show "Your wishlist is empty" message if no items are left
                                const remainingItems = document.querySelectorAll(".wishlist-item"); // Check rows left
                                if (remainingItems.length === 0) {
                                    const emptyMessage = document.getElementById("empty-message");
                                    if (emptyMessage) {
                                        emptyMessage.style.display = "block"; // Unhide empty message
                                    }
                                }
                            } else {
                                console.error("Error:", data.message); // Log the error if not successful
                                alert("Failed to remove item. Please try again.");
                            }
                        })
                        .catch((error) => {
                            console.error("Error:", error);
                            alert("An unexpected error occurred. Please try again later.");
                        });
                });
            });
        });
    </script>
</body>

</html>