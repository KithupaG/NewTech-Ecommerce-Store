<?php
require "connection.php";

session_start();
if (!isset($_SESSION["seller_id"])) {
    header("Location: login.php");
    exit();
}

$seller_id   = $_SESSION["seller_id"];
$seller_name = $_SESSION["seller_name"];
$seller_email = $_SESSION["seller_email"];

// Total Customers
$totalCustomersQuery = Database::search("
    SELECT COUNT(DISTINCT customer_email) AS total_customers 
    FROM purchases 
    WHERE seller_id = '$seller_id'
");
$totalCustomers = $totalCustomersQuery->fetch_assoc()['total_customers'];

// Total revenue
$revenueQuery = Database::search("
    SELECT SUM(total_value) AS revenue 
    FROM purchases 
    WHERE seller_id = '$seller_id'
");
$totalRevenue = $revenueQuery->fetch_assoc()['revenue'] ?? 0;

// Total purchases
$purchasesQuery = Database::search("
    SELECT COUNT(id) AS total_orders 
    FROM purchases 
    WHERE seller_id = '$seller_id'
");
$totalPurchases = $purchasesQuery->fetch_assoc()['total_orders'];

// Total wishlists
$wishlistQuery = Database::search("
    SELECT COUNT(id) AS total_wishlists 
    FROM wishlists 
    WHERE seller_id = '$seller_id'
");
$totalWishlists = $wishlistQuery->fetch_assoc()['total_wishlists'];

// Pagination setup
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$purchaseHistory = Database::search("
    SELECT ph.id, p.name AS product_name, ph.customer_email, ph.total_value, ph.transaction_date
    FROM purchases ph
    JOIN products p ON ph.product_id = p.id
    WHERE ph.seller_id = '$seller_id'
    ORDER BY ph.transaction_date DESC
    LIMIT $limit OFFSET $offset
");

$totalQuery = Database::search("
    SELECT COUNT(*) AS total 
    FROM purchases 
    WHERE seller_id = '$seller_id'
");
$totalRow = $totalQuery->fetch_assoc();
$totalRecords = $totalRow['total'];
$totalPages = ceil($totalRecords / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="../../js/main.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/main.js" defer></script>
    <link rel="stylesheet" href="../css/universal.css" />
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin Panel | Dashboard | New Tech</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand font-weight-bold" href="#">
                New Tech
            </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse"
                data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i class="fas fa-house-chimney"></i>
                                <span class="ml-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sellerProductPage.php">
                                <i class="fas fa-box"></i>
                                <span class="ml-2">Your Products</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <h1 class="h2">Dashboard</h1>
                <div class="row my-4">
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Customers</h5>
                            <div class="card-body">
                                <p class="card-text">Total Customers:</p>
                                <h5 class="card-title"><?php echo $totalCustomers; ?></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Revenue</h5>
                            <div class="card-body">
                                <p class="card-text">Total Revenue:</p>
                                <h5 class="card-title">Rs. <?php echo number_format($totalRevenue, 2); ?></h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Purchases</h5>
                            <div class="card-body">
                                <p class="card-text">Total Orders:</p>
                                <h5 class="card-title"><?php echo $totalPurchases; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Wishlists</h5>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $totalWishlists; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Purchase History</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $purchaseHistory->fetch_assoc()) { ?>
                                                <tr>
                                                    <th scope="row"><?php echo $row['id']; ?></th>
                                                    <td><?php echo $row['product_name']; ?></td>
                                                    <td><?php echo $row['customer_email']; ?></td>
                                                    <td>Rs. <?php echo $row['total_value']; ?></td>
                                                    <td><?php echo $row['transaction_date']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                            <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                                        </li>

                                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                            <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                                                <a class="page-link" href="?page=<?php echo $i; ?>">
                                                    <?php echo $i; ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                                            <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="margin-top mt-5"></div>
                <footer class="text-center text-lg-start bg-dark text-muted">
                    <section class="d-flex justify-content-center justify-content-lg-between p-4">
                    </section>
                    <section>
                        <div class="container text-center text-md-start mt-5">
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
                                        <a href="store.html" class="text-reset">Store</a>
                                    </p>
                                    <p>
                                        <a href="#contact" class="text-reset">Contact</a>
                                    </p>
                                    <p>
                                        <a href="#about" class="text-reset">About</a>
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
                        <a class="text-reset fw-bold" href="../../main.html">NewTech.com</a>
                    </div>
                </footer>
            </main>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

</html>