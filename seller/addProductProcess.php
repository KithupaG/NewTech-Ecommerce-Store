<?php
require 'connection.php';

// Ensure DB connection is available
Database::setUpConnection();
$conn = Database::$connection;

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: addProduct.php');
    exit;
}

// Helper: try multiple possible POST keys and return first found
function get_post($keys, $default = '') {
    foreach ((array)$keys as $k) {
        if (isset($_POST[$k]) && $_POST[$k] !== '') return $_POST[$k];
    }
    return $default;
}

// Collect inputs (supports different naming conventions)
$name        = trim(get_post(['productName','name']));
$description = trim(get_post(['productDescription','description']));
$quantity    = get_post(['productQuantity','quantity', 'qty', 'qnty']);
$price       = get_post(['productPrice','price']);
$category_id = get_post(['productCategory','category_id','category']);
$brands_id   = get_post(['productBrand','brands_id','brand_id','brand']);
$warranty    = get_post(['productWarranty','warranty_time','warranty']);
$seller_id   = get_post(['seller_id'], '1'); // default seller_id = 1 if none provided

// Basic validation
$errors = [];
if ($name === '') $errors[] = "Product name is required.";
if ($description === '') $errors[] = "Description is required.";
if (!is_numeric($price) || floatval($price) <= 0) $errors[] = "Price must be a number greater than 0.";
if (!is_numeric($quantity) || intval($quantity) < 0) $errors[] = "Quantity must be a non-negative integer.";

if (!empty($errors)) {
    $msg = implode("\\n", $errors);
    echo "<script>alert('Validation error:\\n{$msg}');window.history.back();</script>";
    exit;
}

$uploadDir = __DIR__ . "/../uploads/product_pictures/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Try multiple possible file input names per slot
$possibleFileKeys = [
    ['productImage1', 'image_url', 'image1', 'file1'],
    ['productImage2', 'image_url1', 'image2', 'file2'],
    ['productImage3', 'image_url2', 'image3', 'file3'],
    ['productImage4', 'image_url3', 'image4', 'file4'],
];

$storedFiles = ['', '', '', ''];
$allowedExts = ['jpg','jpeg','png','gif','webp'];

for ($i = 0; $i < 4; $i++) {
    $found = false;
    foreach ($possibleFileKeys[$i] as $key) {
        if (isset($_FILES[$key]) && isset($_FILES[$key]['error'])) {
            $file = $_FILES[$key];
            if ($file['error'] === UPLOAD_ERR_OK && is_uploaded_file($file['tmp_name'])) {
                $origName = $file['name'];
                $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));

                // Keep allowed extensions check minimal
                if ($ext === '') $ext = 'dat';
                if (!in_array($ext, $allowedExts)) {
                    // still allow but change extension to original ext to avoid breaking files; optionally you can reject here
                    // For hobby app we will still save it
                }

                // Create unique filename
                $unique = uniqid('', true);
                // sanitize original base name (optional)
                $base = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
                $newName = $unique . '_' . $base . '.' . $ext;
                $target = $uploadDir . $newName;

                if (move_uploaded_file($file['tmp_name'], $target)) {
                    $storedFiles[$i] = $newName; // store filename only
                } else {
                    $storedFiles[$i] = '';
                }

                $found = true;
                break; // stop checking other candidate keys for this slot
            }
        }
    }
    if (!$found) {
        // No file uploaded for this slot -> leave empty string
        $storedFiles[$i] = '';
    }
}

// Escape values minimally to avoid breaking SQL (not a full security measure)
$nameEsc = $conn->real_escape_string($name);
$descEsc = $conn->real_escape_string($description);
$qtyEsc  = intval($quantity);
$priceEsc = floatval($price);
$catEsc  = $conn->real_escape_string($category_id);
$brandEsc = $conn->real_escape_string($brands_id);
$warrantyEsc = $conn->real_escape_string($warranty);
$sellerEsc = $conn->real_escape_string($seller_id);

$img1 = $conn->real_escape_string($storedFiles[0]);
$img2 = $conn->real_escape_string($storedFiles[1]);
$img3 = $conn->real_escape_string($storedFiles[2]);
$img4 = $conn->real_escape_string($storedFiles[3]);

// Build INSERT (matches your products table layout)
$sql = "INSERT INTO products 
    (name, description, quantity, price, image_url, image_url1, image_url2, image_url3, category_id, brands_id, warranty_time, created, seller_id)
    VALUES
    ('$nameEsc', '$descEsc', '$qtyEsc', '$priceEsc', '$img1', '$img2', '$img3', '$img4', '$catEsc', '$brandEsc', '$warrantyEsc', NOW(), '$sellerEsc')";

// Execute using your Database helper
if (Database::iud($sql)) {
    echo "<script>alert('Product added successfully!');window.location='addProduct.php';</script>";
    exit;
} else {
    // show DB error (helps debugging)
    $dberr = Database::$connection->error ?? 'unknown error';
    echo "<script>alert('Error adding product: " . addslashes($dberr) . "');window.history.back();</script>";
    exit;
}
