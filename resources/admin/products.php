<?php
require "connection.php";

// Pagination
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Build WHERE conditions
$conditions = [];

if (!empty($_GET['name'])) {
    $name = $_GET['name'];
    $conditions[] = "name LIKE '%$name%'";
}

if (!empty($_GET['condition'])) {
    $condition = $_GET['condition'];
    $conditions[] = "condition_id = '$condition'";
}

if (!empty($_GET['quantity'])) {
    $quantity = $_GET['quantity'];
    $conditions[] = "quantity >= '$quantity'";
}

$where = "";
if (count($conditions) > 0) {
    $where = "WHERE " . implode(" AND ", $conditions);
}

// Count total products
$totalResult = Database::search("SELECT COUNT(*) AS total FROM products $where");
$totalRow = $totalResult->fetch_assoc();
$totalProducts = $totalRow['total'];
$totalPages = ceil($totalProducts / $limit);

// Fetch products for current page
$result = Database::search("SELECT * FROM products $where ORDER BY id DESC LIMIT $limit OFFSET $offset");
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
    <title>Admin Panel | Product Management | New Tech</title>
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
                            <a class="nav-link" href="admin-panel.php">
                                <i class="fas fa-house-chimney"></i>
                                <span class="ml-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="purchase-history.php">
                                <i class="fas fa-file"></i>
                                <span class="ml-2">Transactions</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="products.php">
                                <i class="fas fa-box"></i>
                                <span class="ml-2">Products</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage-users.php">
                                <i class="fas fa-users-between-lines"></i>
                                <span class="ml-2">Customers</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <h1 class="h2">Manage Products</h1>
                <div class="col-12 col-xl-8 mb-4 mb-lg-0 w-100">
                    <div class="card rounded">
                        <div class="form p-4">
                            <form method="GET" action="">
                                <span class="add-button">
                                    <h5 class="p-2">Search Products ...</h5>
                                </span>
                                <div class="input-group mt-4 mb-4">
                                    <input type="text" name="name" class="form-control pl-3" placeholder="Product Name"
                                        value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>">

                                    <select name="condition" class="form-control">
                                        <option value="">DEFAULT</option>
                                        <option value="1" <?php if (isset($_GET['condition']) && $_GET['condition'] == '1') echo 'selected'; ?>>Used</option>
                                        <option value="2" <?php if (isset($_GET['condition']) && $_GET['condition'] == '2') echo 'selected'; ?>>New</option>
                                        <option value="3" <?php if (isset($_GET['condition']) && $_GET['condition'] == '3') echo 'selected'; ?>>Not-specified</option>
                                    </select>

                                    <input type="number" name="quantity" class="form-control pl-3" placeholder="Quantity"
                                        value="<?php echo isset($_GET['quantity']) ? $_GET['quantity'] : ''; ?>">
                                </div>
                                <button class="btn btn-secondary"><i class="fas fa-magnifying-glass"></i> Filter</button>
                            </form>
                        </div>
                    </div>
                    <div class="mb-5"></div>
                </div>
                <div class="col-12 col-xl-8 mb-4 mb-lg-0 w-100">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Number</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result && $result->num_rows > 0) {
                                            $num = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                // Map condition_id to text
                                                switch ($row['condition_id']) {
                                                    case 1:
                                                        $status = "USED";
                                                        break;
                                                    case 2:
                                                        $status = "NEW";
                                                        break;
                                                    case 3:
                                                        $status = "NOT SPECIFIED";
                                                        break;
                                                    default:
                                                        $status = "UNKNOWN";
                                                }
                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $num++; ?></th>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $status; ?></td>
                                                    <td>Rs. <?php echo number_format($row['price'], 2); ?></td>
                                                    <td><?php echo isset($row['created_at']) ? $row['created_at'] : "N/A"; ?></td>
                                                    <td><?php echo $row['quantity']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No products found</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5"></div>
                </div>
                <div class="user-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>">Previous</a>
                            </li>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                    <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                                <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>">Next</a>
                            </li>

                        </ul>
                    </nav>
                </div>
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
                                    <p><i class="fas fa-home me-3 text-secondary"></i> 1000/A, Galle, Colombo, Sri Lanka
                                    </p>
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