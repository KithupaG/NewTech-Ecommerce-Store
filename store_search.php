<?php
require "connection.php";

$txt = $_POST["t"];

// Default query to fetch all products
$query = "SELECT * FROM `products`";

// Construct the query based on the input text
if (!empty($txt)) {
    $query .= " WHERE `name` LIKE '%" . $txt . "%'";
}

// Execute the search query to get the total number of results
$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

// Pagination: define the number of products per page
$results_per_page = 9; // Change this value to adjust the number of results per page

// Get the current page number
$pageno = isset($_POST["page"]) ? $_POST["page"] : 1;

// Calculate the offset and limit for the query
$page_results = ($pageno - 1) * $results_per_page;
$query .= " LIMIT $results_per_page OFFSET $page_results";

// Execute the query for the current page
$product_rs_current = Database::search($query);
$product_num_current = $product_rs_current->num_rows; // This is the number of products on the current page

// Calculate the total number of pages based on the total number of products
$total_pages = ceil($product_num / $results_per_page);

// Display the products for the current page
?>

<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <script src="js/main.js" defer></script>
    <link rel="stylesheet" href="css/universal.css" />
    <link rel="stylesheet" href="css/store.css" />
</head>

<body>
    <div class="row">
        <div class="col-12 text-center">
            <div class="row">
                <?php
                if ($product_num_current > 0) {
                    // Loop through and display the products
                    for ($x = 0; $x < $product_num_current; $x++) {
                        $selected_data = $product_rs_current->fetch_assoc();
                ?>

                        <div class="col-md-12 col-lg-4 mb-4 mt-3 mb-lg-0 mart">
                            <div class="card">
                                <img src="uploads/product_pictures/<?php echo $selected_data['image_url']; ?>"
                                    class="card-img-top"
                                    alt="Product Image" />
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h5 class="mb-0"><?php echo $selected_data['name']; ?></h5>
                                        <br>
                                        <h5 class="text-dark">Rs. <?php echo $selected_data['price']; ?></h5>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="text-muted mb-0">Available: <?php echo $selected_data['quantity']; ?></p>
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="product.php?id=<?php echo $selected_data['id']; ?>"
                                        class="btn btn-success mb-3" style="width: 95%;">
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>


                <?php
                    }
                } else {
                    // Display a message if no products are found
                    echo "<p class='text-center text-muted'>No products found matching your search criteria.</p>";
                }
                ?>
            </div>

            <!-- Pagination -->
            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-sm justify-content-center">
                        <li class="page-item">
                            <a class="page-link" <?php if ($pageno <= 1) {
                                                        echo ("#");
                                                    } else {
                                                    ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                        } ?> aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <?php
                        for ($x = 1; $x <= $total_pages; $x++) {
                            if ($x == $pageno) {
                        ?>
                                <li class="page-item active">
                                    <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);"><?php echo $x; ?></a>
                                </li>
                        <?php
                            }
                        }
                        ?>

                        <li class="page-item">
                            <a class="page-link" <?php if ($pageno >= $total_pages) {
                                                        echo ("#");
                                                    } else {
                                                    ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                        } ?> aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src="js/main.js" defer></script>
</body>

</html>