<?php
require "connection.php";

if (!isset($_GET["id"])) {
    die("Product ID not provided.");
}

$id = $_GET["id"];
$product_rs = Database::search("SELECT * FROM products WHERE id='$id'");
if ($product_rs->num_rows == 0) {
    die("Product not found.");
}
$product = $product_rs->fetch_assoc();

// Fetch categories, brands, warranty options
$categories = Database::search("SELECT * FROM category");
$brands = Database::search("SELECT * FROM brand");
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
    <title>Edit Product | NewTech</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="card shadow-sm p-4">
                    <h3 class="text-center mb-4">Edit Product</h3>

                    <form action="editProductProcess.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="productName"
                                    value="<?php echo $product['name']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="productPrice"
                                    value="<?php echo $product['price']; ?>" required min="1">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="productDescription" rows="3" required><?php echo $product['description']; ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="productQuantity"
                                    value="<?php echo $product['quantity']; ?>" required min="1">
                            </div>

                            <!-- Dynamic Category -->
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="productCategory" required>
                                    <option value="">Select Category</option>
                                    <?php while ($cat = $categories->fetch_assoc()) { ?>
                                        <option value="<?php echo $cat['id']; ?>"
                                            <?php if ($cat['id'] == $product['category_id']) echo "selected"; ?>>
                                            <?php echo $cat['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Dynamic Brand -->
                            <div class="col-md-6">
                                <label class="form-label">Brand</label>
                                <select class="form-select" name="productBrand" required>
                                    <option value="">Select Brand</option>
                                    <?php while ($br = $brands->fetch_assoc()) { ?>
                                        <option value="<?php echo $br['id']; ?>"
                                            <?php if ($br['id'] == $product['brands_id']) echo "selected"; ?>>
                                            <?php echo $br['name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Dynamic Warranty -->
                            <div class="col-md-6">
                                <label class="form-label">Warranty</label>
                                <select class="form-select" name="productWarranty" required>
                                    <option value="">Select Warranty</option>
                                    <?php while ($w = $warranties->fetch_assoc()) { ?>
                                        <option value="<?php echo $w['warranty_time']; ?>"
                                            <?php if ($w['warranty_time'] == $product['warranty_time']) echo "selected"; ?>>
                                            <?php echo $w['warranty_time']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Images -->
                            <div class="col-12">
                                <p class="text-danger small mb-1">Upload new images (leave empty to keep old ones)</p>
                                <div class="mb-2">
                                    <label class="form-label">Product Image 1</label>
                                    <input type="file" class="form-control" name="productImage" accept="image/*">

                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Product Image 2</label>
                                    <input type="file" class="form-control" name="productImage1" accept="image/*">

                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Product Image 3</label>
                                    <input type="file" class="form-control" name="productImage2" accept="image/*">

                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Product Image 4</label>
                                    <input type="file" class="form-control" name="productImage3" accept="image/*">

                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>