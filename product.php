<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $product_id = $_GET["id"];

    $query = Database::search("SELECT * FROM `products` WHERE `id` = '$product_id'");
    $result = $query;

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found";
        exit();
    }
}

if (isset($_GET['status'])) {
    if ($_GET['status'] === 'added') {
        echo "<script>alert('Product added to wishlist!');</script>";
    } elseif ($_GET['status'] === 'exists') {
        echo "<script>alert('Product is already in your wishlist!');</script>";
    }
}

$product_id = $_GET['id'];
$isInWishlist = false;

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM wishlists WHERE user_id = $user_id AND product_id = $product_id";
    $result = Database::search($query);
    $isInWishlist = $result && $result->num_rows > 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/singleproduct.css">
    <link rel="stylesheet" href="css/universal.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title><?php echo $product["name"]; ?> Details</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartButton = document.getElementById('add-to-cart');
            if (addToCartButton) {
                addToCartButton.addEventListener('click', function() {
                    const quantity = document.getElementById('quantity-slider').value;
                    const productId = <?php echo $product_id; ?>;
                    const customerId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; ?>;

                    console.log(`Product ID: ${productId}`);
                    console.log(`Quantity: ${quantity}`);
                    console.log(`Customer ID: ${customerId}`);

                    // Redirect to login if not logged in
                    if (customerId === 0) {
                        window.location.href = "login.php";
                        return; // Prevent further execution
                    }

                    fetch('addToCartProcess.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                quantity: quantity,
                                customer_id: customerId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                alert(data.message);
                                // Optionally redirect to cart page or update the UI
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again later.');
                        });
                });
            } else {
                console.error("add-to-cart element not found!");
            }
        });
    </script>
</head>

<body>
    <div class="super_container">
        <div class="single_product">
            <div class="container-fluid" style="background-color: #fff; padding: 11px;">
                <div class="row">
                    <div class="col-lg-4 order-lg-2 order-1">
                        <div class="back">
                            <a href="store.php">
                                <i class="fas fa-angle-left" title="Back to Store" style="font-size: 24px; color: #333;"></i>
                            </a>
                        </div>
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100"
                                        src="uploads/product_pictures/<?php echo $product['image_url']; ?>"
                                        alt="Product Image 1">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100"
                                        src="uploads/product_pictures/<?php echo $product['image_url1']; ?>"
                                        alt="Product Image 2">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100"
                                        src="uploads/product_pictures/<?php echo $product['image_url2']; ?>"
                                        alt="Product Image 3">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100"
                                        src="uploads/product_pictures/<?php echo $product['image_url3']; ?>"
                                        alt="Product Image 4">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #333"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #333"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                    <div class="col-lg-6 order-3">
                        <div class="product_description">
                            <div class="product_name"><?php echo $product['name']; ?></div>
                            <div> <span class="product_price"><?php echo $product['price']; ?></span></div>
                            <hr class="singleline">
                            <div>
                                <ul>
                                    <li>
                                        <span class="product_info">Warranty: <?php echo $product['warranty_time']; ?></span>
                                    </li>
                                    <li>
                                        <span class="product_info"><?php echo $product['quantity'] > 0 ? "In Stock" : "Out of Stock"; ?></span>
                                    </li>
                                    <li>
                                        <span class="product_info">Items Left: <?php echo $product['quantity']; ?></span>
                                    </li>
                                </ul>
                            </div>
                            <hr class="singleline">
                            <div class="order_info d-flex flex-row">
                                <form action="#">
                            </div>
                            <div class="row">
                                <div class="col-xs-6 mb-3" style="margin-left: 13px;">
                                    <label for="quantity-slider" class="form-label">Quantity:</label>
                                    <input type="range"
                                        id="quantity-slider"
                                        class="form-range"
                                        min="1"
                                        max="<?php echo $product['quantity']; ?>"
                                        value="1"
                                        oninput="updateQuantityLabel(this.value)">

                                    <span id="quantity-label">1</span> of <?php echo $product['quantity']; ?> available
                                </div>
                                <div class="col-xs-6">
                                    <button type="button" class="btn btn-primary shop-button" id="add-to-cart">
                                        <i class="fas fa-cart-arrow-down"></i> Add to Cart
                                    </button>

                                    <button type="button" class="buynow btn btn-success shop-button">
                                        <i class="fas fa-shopping-cart"></i> Buy Now
                                    </button>

                                    <div id="wishlist-btn"
                                        data-product-id="<?php echo $product_id; ?>"
                                        class="btn btn-outline-warning">
                                        Add to Wishlist
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 10px;">
                    <div class="col-md-6"> <span class=" deal-text">Description</span> </div>
                    <hr class="my-4">
                    <div class="col-md-6"> <a href="#" data-abc="true"> <span class="ml-auto view-all"></span> </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $product['description']; ?>
                    </div>
                    <div class="col-md-12">
                        Colour:
                        <?php
                        $colorQuery = "SELECT color FROM color WHERE id = " . $product['color_id'];
                        $colorResult = Database::search($colorQuery);

                        if ($colorResult && $colorResult->num_rows > 0) {
                            $color = $colorResult->fetch_assoc();
                            echo $color['color'];
                        } else {
                            echo "Unknown";
                        }
                        ?>
                    </div>
                    <div class="col-md-12">
                        Brand:
                        <?php
                        $brandQuery = "SELECT name FROM brand WHERE id = " . $product['brands_id'];
                        $brandResult = Database::search($brandQuery);

                        if ($brandResult && $brandResult->num_rows > 0) {
                            $brand = $brandResult->fetch_assoc();
                            echo $brand['name'];
                        } else {
                            echo "Unknown";
                        }
                        ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="container mt-5">
                        <div class="card shadow-sm p-4">
                            <h4 class="card-title text-center mb-4">Product Rating</h4>
                            <p class="text-center">In general, how would you rate the quality of the product?</p>

                            <!-- Rating Slider -->
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <h6 class="form-label">Value: <span id="sliderValue" class="ms-2">1</span></h6>
                                <br>
                                <input type="range" class="form-range mx-3" id="ratingSlider" min="1" max="5" step="1" value="1">
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>💀</span>
                                <span>😍</span>
                            </div>

                            <div id="ratingMessage" class="text-center mt-4">
                                <button id="submitRating" class="btn btn-primary" type="button">Submit Rating</button>
                                <p id="thankYouMessage" class="d-none">Thank you for your rating!</p>
                            </div>

                            <div id="existingRatingSection" class="text-center mt-4 d-none">
                                <p>Your rating: <span id="existingRating"></span></p>
                                <button id="removeRating" class="btn btn-danger">Remove Rating</button>
                            </div>

                            <?php
                            if (isset($_SESSION['user_id'])) {
                                $userId = $_SESSION['user_id'];
                                $productId = $_GET['id'];

                                // Check if the user has already rated this product
                                $query = "SELECT * FROM ratings WHERE customer_id = '$userId' AND productssss_id = '$productId'";

                                $result = Database::search($query);

                                if ($result && $row = $result->fetch_assoc()) {
                                    echo '<script>document.getElementById("removeRating").classList.remove("d-none");</script>';
                                }
                            }
                            ?>
                        </div>
                    </div>


                    <div class="container mt-5">
                        <?php
                        $product_id = $_GET['id'];

                        // Query to get comments for this product
                        $query = "SELECT c.comment, c.created_at, u.fname, u.lname 
                                        FROM comments c
                                        JOIN customer u ON c.customer_id = u.id
                                        WHERE c.product_id = $product_id
                                        ORDER BY c.created_at DESC";
                        $result = Database::search($query);
                        ?>

                        <div class="row">
                            <div class="container mt-5">
                                <?php
                                require_once 'connection.php';
                                $product_id = $_GET['id'];

                                // Query to get comments for this product
                                $query = "SELECT c.id, c.comment, c.created_at, u.fname, u.lname 
              FROM comments c
              JOIN customer u ON c.customer_id = u.id
              WHERE c.product_id = $product_id
              ORDER BY c.created_at DESC";
                                $result = Database::search($query);
                                ?>

                                <div class="row">
                                    <?php
                                    require_once 'connection.php';
                                    $logged_in_user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

                                    $product_id = $_GET['id'];

                                    // Query to get comments for this product
                                    $query = "SELECT c.id, c.comment, c.created_at, c.customer_id, u.fname, u.lname 
          FROM comments c
          JOIN customer u ON c.customer_id = u.id
          WHERE c.product_id = $product_id
          ORDER BY c.created_at DESC";
                                    $result = Database::search($query);
                                    ?>

                                    <div class="container mt-5">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5>Comments</h5>
                                                <hr>
                                                <div id="comment-section">
                                                    <?php
                                                    $logged_in_user_id = $_SESSION['user_id'] ?? null;

                                                    $query = "SELECT c.id, c.comment, c.created_at, c.customer_id, u.fname, u.lname, u.profile_picture 
                          FROM comments c
                          JOIN customer u ON c.customer_id = u.id
                          WHERE c.product_id = $product_id
                          ORDER BY c.created_at DESC";
                                                    $result = Database::search($query);
                                                    ?>

                                                    <?php if ($result && $result->num_rows > 0): ?>
                                                        <?php while ($row = $result->fetch_assoc()): ?>
                                                            <div class="d-flex mb-4 comment-box" data-id="<?php echo $row['id']; ?>">
                                                                <!-- Profile Image -->
                                                                <div class="me-3">
                                                                    <?php
                                                                    $profile_img = !empty($row['profile_picture']) ? $row['profile_picture'] : 'default_user.jpg';
                                                                    ?>
                                                                    <img src="<?php echo $profile_img; ?>" alt="User Avatar" class="rounded-circle" width="50" height="50">
                                                                </div>

                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-1">
                                                                        <strong><?php echo $row['fname'] . ' ' . $row['lname']; ?></strong>
                                                                        <small class="text-muted"><?php echo date('F j, Y, g:i a', strtotime($row['created_at'])); ?></small>
                                                                    </h6>
                                                                    <p class="mb-1"><?php echo $row['comment']; ?></p>

                                                                    <?php if ($row['customer_id'] == $logged_in_user_id): ?>
                                                                        <button type="button" class="btn btn-sm btn-danger remove-comment" onclick="removeComment(<?php echo $row['id']; ?>)">Remove Comment</button>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endwhile; ?>
                                                    <?php else: ?>
                                                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                                                    <?php endif; ?>
                                                </div>
                                                <hr>
                                                <div class="mb-3">
                                                    <textarea class="form-control" id="comment-text" rows="3" placeholder="Write your comment here..."></textarea>
                                                </div>
                                                <button type="button" class="btn btn-primary" onclick="submitComment()">Submit Comment</button>

                                                <!-- Success or Error Message -->
                                                <div id="feedback" class="d-none mt-3"></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center text-lg-start bg-dark text-muted p-3">
        <section>
            <div class="text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fab fa-accusoft me-3 text-secondary"></i>New Tech
                        </h6>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere, voluptatum.
                        </p>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a href="main.php" class="text-reset">Home</a>
                        </p>
                        <p>
                            <a href="main.php#contact" class="text-reset">Contact</a>
                        </p>
                        <p>
                            <a href="store.php" class="text-reset">Store</a>
                        </p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3 text-secondary"></i> 1000/A, Galle, Colombo, Sri Lanka</p>
                        <p>
                            <i class="fa-solid fa-envelope me3 text-secondary"></i>
                            newtech@newtech.com
                        </p>
                        <p><i class="fa-solid fa-phone me-3 text-secondary"></i> +94 234 567 88</p>
                        <p><i class="fa-solid fa-print me-3 text-secondary"></i> + 94 234 567 89</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
            © 2022 Copyright:
            <a class="text-reset fw-bold" href="main.html">NewTech.com</a>
        </div>
    </footer>
</body>
<script>
    document.getElementById('wishlist-btn').addEventListener('click', function() {
        const button = this;
        const productId = button.getAttribute('data-product-id');
        fetch('wishlistProcess.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'add',
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    button.classList.add('btn-warning');
                    button.textContent = 'Added to Wishlist';
                    alert(data.message);
                } else if (data.status === 'exists') {
                    alert(data.message);
                } else {
                    alert('An error occurred while adding to the wishlist.');
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert('Failed to add the product to the wishlist.');
            });
    });

    function updateQuantityLabel(value) {
        const label = document.getElementById('quantity-label');
        label.textContent = value;
    }

    const slider = document.getElementById('quantity-slider');
    const checkoutLink = document.getElementById('checkout-link');

    function submitComment() {
        var comment = document.getElementById('comment-text').value.trim();
        var product_id = <?php echo $product_id; ?>;

        if (comment === "") {
            alert("Please enter a comment.");
            return;
        }

        var formData = new FormData();
        formData.append("comment", comment);
        formData.append("product_id", product_id);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText.trim();
                var feedback = document.getElementById('feedback');

                if (response === "success") {
                    feedback.classList.remove('d-none');
                    feedback.classList.add('alert', 'alert-success');
                    feedback.innerText = "Your comment has been posted successfully!";

                    loadComments();
                } else {
                    feedback.classList.remove('d-none');
                    feedback.classList.add('alert', 'alert-danger');
                    feedback.innerText = response;
                }
            } else if (xhr.readyState == 4) {
                console.error("Server error: " + xhr.status);
            }
        };

        xhr.open("POST", "submit_comment.php", true);
        xhr.send(formData);
    }

    document.addEventListener("DOMContentLoaded", function() {
        const productId = <?php echo $_GET['id']; ?>;
        const userId = <?php echo $_SESSION['user_id']; ?>;
        const ratingSlider = document.getElementById("ratingSlider");
        const sliderValue = document.getElementById("sliderValue");
        const submitRatingBtn = document.getElementById("submitRating");
        const thankYouMessage = document.getElementById("thankYouMessage");
        const existingRatingSection = document.getElementById("existingRatingSection");
        const existingRating = document.getElementById("existingRating");
        const removeRatingBtn = document.getElementById("removeRating");

        sliderValue.innerText = ratingSlider.value;

        ratingSlider.addEventListener("input", () => {
            sliderValue.innerText = ratingSlider.value;
        });

        submitRatingBtn.addEventListener("click", () => {
            const rating = ratingSlider.value;
            const formData = new FormData();
            formData.append("action", "submit");
            formData.append("product_id", productId);
            formData.append("user_id", userId);
            formData.append("rating", rating);

            fetch("handle_rating.php", {
                    method: "POST",
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        thankYouMessage.classList.remove("d-none");
                        existingRatingSection.classList.remove("d-none");
                        existingRating.innerText = rating;
                        submitRatingBtn.classList.add("d-none");
                    }
                });
        });

        removeRatingBtn.addEventListener("click", (event) => {
            event.preventDefault();
            const formData = new FormData();
            formData.append("action", "remove");
            formData.append("product_id", productId);
            formData.append("user_id", userId);

            fetch("handle_rating.php", {
                    method: "POST",
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        existingRatingSection.classList.add("d-none");
                        submitRatingBtn.classList.remove("d-none");
                        loadAverageRating();
                    }
                });
        });

        if (<?php echo isset($existingRating) ? 'true' : 'false'; ?>) {
            removeRatingBtn.classList.remove("d-none");
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("comment-section").addEventListener("click", function(e) {
            if (e.target.classList.contains("remove-comment")) {
                var commentBox = e.target.closest(".comment-box");
                var commentId = commentBox.getAttribute("data-id");

                var formData = new FormData();
                formData.append("comment_id", commentId);

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "remove_comment.php", true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        if (xhr.responseText.trim() === "success") {
                            commentBox.remove();
                        } else {
                            alert("Failed to remove comment.");
                        }
                    }
                };
                xhr.send(formData);
            }
        });
    });
</script>
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js" defer></script>
<script src="js/main.js"></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
<script type='text/javascript'
    src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>

</html>