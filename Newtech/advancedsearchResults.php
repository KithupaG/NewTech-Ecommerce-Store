<?php
require "connection.php";

// Initialize variables
$keyword = $_GET['keyword'] ?? '';
$category = $_GET['category'] ?? '0';
$brand = $_GET['brand'] ?? '0';
$conditions = $_GET['condition'] ?? [];
$stock = isset($_GET['stock']) ? true : false;
$pageno = isset($_GET['pageno']) ? $_GET['pageno'] : 1;
$results_per_page = 6; // Number of results per page

// Calculate the starting limit for pagination
$start_from = ($pageno - 1) * $results_per_page;

// Build query
$query = "SELECT p.id, p.name, p.price, p.quantity, p.image_url 
          FROM products p 
          WHERE 1=1";

// Add filters
if (!empty($keyword)) {
    $query .= " AND p.name LIKE '%$keyword%'";
}

if ($category !== '0') {
    $query .= " AND p.category_id = '$category'";
}

if ($brand !== '0') {
    $query .= " AND p.brands_id = '$brand'";
}

if (!empty($conditions)) {
    $condition_ids = implode(',', $conditions);
    $query .= " AND p.condition_id IN ($condition_ids)";
}

if ($stock) {
    $query .= " AND p.quantity > 0";
}

// Add pagination limit
$query .= " LIMIT $start_from, $results_per_page";

// Execute query for the current page
$results = Database::search($query);

// Get the total number of results for pagination
$total_results_query = "SELECT COUNT(*) as total FROM products p WHERE 1=1";
if (!empty($keyword)) {
    $total_results_query .= " AND p.name LIKE '%$keyword%'";
}
if ($category !== '0') {
    $total_results_query .= " AND p.category_id = '$category'";
}
if ($brand !== '0') {
    $total_results_query .= " AND p.brands_id = '$brand'";
}
if (!empty($conditions)) {
    $total_results_query .= " AND p.condition_id IN ($condition_ids)";
}
if ($stock) {
    $total_results_query .= " AND p.quantity > 0";
}

$total_results = Database::search($total_results_query);
$total_rows = $total_results->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $results_per_page);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Search Results | New Tech</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h3 class="mb-4">Search Results</h3>
        <div class="row">
            <?php
            if ($results->num_rows > 0) {
                while ($selected_data = $results->fetch_assoc()) {
            ?>
                    <div class="col-md-12 col-lg-4 mb-4 mt-3 mb-lg-0 mart">
                        <div class="card">
                        <img src="resources/products/pc.jpg" class="card-img-top" alt="Product Image" />
                            <!-- <img src="resources/products/<?php echo $selected_data['image_url']; ?>" class="card-img-top" alt="Product Image" /> -->
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0"><?php echo $selected_data['name']; ?></h5>
                                    <h5 class="text-dark">Rs. <?php echo $selected_data['price']; ?></h5>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="text-muted mb-0">Available: <?php echo $selected_data['quantity']; ?></p>
                                </div>
                            </div>
                            <div class="buttons">
                                <a href="product.php?id=<?php echo $selected_data['id']; ?>" class="btn btn-success mb-3" style="width: 100%;">
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>No products found.</p>";
                echo "<p><a href='store.php'>Back to Store</a></p>";
            }
            ?>
        </div>

        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm justify-content-center">
                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno <= 1) { echo ("#"); } else { ?> href="?pageno=<?php echo ($pageno - 1); ?>" <?php } ?> aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php
                    for ($x = 1; $x <= $total_pages; $x++) {
                        if ($x == $pageno) {
                    ?>
                            <li class="page-item active">
                                <a class="page-link" href="?pageno=<?php echo $x; ?>"><?php echo $x; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="?pageno=<?php echo $x; ?>"><?php echo $x; ?></a>
                            </li>
                    <?php
                        }
                    }
                    ?>

                    <li class="page-item">
                        <a class="page-link" <?php if ($pageno >= $total_pages) { echo ("#"); } else { ?> href="?pageno=<?php echo ($pageno + 1); ?>" <?php } ?> aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</body>

</html>
