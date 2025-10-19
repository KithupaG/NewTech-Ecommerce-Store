<?php
require "connection.php";

// Fetch options from DB
$categories = Database::search("SELECT * FROM category");
$brands     = Database::search("SELECT * FROM brand");
$warranties = Database::search("SELECT * FROM warranty");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/universal.css">
    <title>Add Product | NewTech</title>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="card shadow-sm p-4">
                    <h3 class="text-center mb-4">Add Product</h3>

                    <form action="addProductProcess.php" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="productName" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="productPrice" required min="1">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="productDescription" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="productQuantity" required min="1">
                            </div>

                            <!-- Dynamic Category -->
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="productCategory" required>
                                    <option value="">Select Category</option>
                                    <?php while ($cat = $categories->fetch_assoc()) { ?>
                                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Dynamic Brand -->
                            <div class="col-md-6">
                                <label class="form-label">Brand</label>
                                <select class="form-select" name="productBrand" required>
                                    <option value="">Select Brand</option>
                                    <?php while ($brand = $brands->fetch_assoc()) { ?>
                                        <option value="<?= $brand['id'] ?>"><?= htmlspecialchars($brand['name']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- Dynamic Warranty -->
                            <div class="col-md-6">
                                <label class="form-label">Warranty</label>
                                <select class="form-select" name="productWarranty" required>
                                    <option value="">Select Warranty</option>
                                    <?php while ($war = $warranties->fetch_assoc()) { ?>
                                        <option value="<?= $war['warranty_time'] ?>"><?= $war['warranty_time'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Images -->
                            <div class="col-12">
                                <p class="text-danger small mb-1">Upload 4 images of the product</p>
                                <?php for ($i = 1; $i <= 4; $i++) { ?>
                                    <div class="mb-2">
                                        <label class="form-label">Product Image <?= $i ?></label>
                                        <input type="file" class="form-control" name="productImage<?= $i ?>" accept="image/*" required>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>