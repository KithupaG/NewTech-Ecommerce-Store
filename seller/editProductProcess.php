<?php
require "connection.php";

// Check required POST fields
if (!isset($_POST['id'])) {
    die("Product ID not provided.");
}

$id = $_POST['id'];
$name = $_POST['productName'];
$description = $_POST['productDescription'];
$quantity = $_POST['productQuantity'];
$price = $_POST['productPrice'];
$category_id = $_POST['productCategory'];
$brands_id = $_POST['productBrand'];
$warranty_time = $_POST['productWarranty'];

// Fetch existing product to keep old images if new ones are not uploaded
$product_rs = Database::search("SELECT * FROM products WHERE id='$id'");
if ($product_rs->num_rows == 0) {
    die("Product not found.");
}
$product = $product_rs->fetch_assoc();

// Prepare uploads directory
$uploadDir = __DIR__ . "/../uploads/product_pictures/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Function to handle image upload or keep old
function handleImage($fileInput, $oldFile) {
    global $uploadDir;
    if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['name'] != "") {
        $fileName = time() . "_" . $_FILES[$fileInput]['name'];
        move_uploaded_file($_FILES[$fileInput]['tmp_name'], $uploadDir . $fileName);
        return $fileName;
    }
    return $oldFile;
}

// Process images
$image_url = handleImage('productImage', $product['image_url']);
$image_url1 = handleImage('productImage1', $product['image_url1']);
$image_url2 = handleImage('productImage2', $product['image_url2']);
$image_url3 = handleImage('productImage3', $product['image_url3']);

// Update query
$updateQuery = "
    UPDATE products SET
        name='$name',
        description='$description',
        quantity='$quantity',
        price='$price',
        image_url='$image_url',
        image_url1='$image_url1',
        image_url2='$image_url2',
        image_url3='$image_url3',
        category_id='$category_id',
        brands_id='$brands_id',
        warranty_time='$warranty_time'
    WHERE id='$id'
";

// Execute update
if (Database::iud($updateQuery)) {
    echo "<script>alert('Product updated successfully'); window.location='editProduct.php?id=$id';</script>";
} else {
    echo "<script>alert('Failed to update product'); window.history.back();</script>";
}
