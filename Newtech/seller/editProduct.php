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
        <div class="row card mt-5 p-4">
            <div class="col-12">
                <h1 class="text-center">Edits Product</h1>
            </div>
            <div class="col-12">
                <form id="addProductForm" onsubmit="return false;">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" rows="3"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Product Price</label>
                        <input type="number" class="form-control" id="productPrice" name="productPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Product Quantity</label>
                        <input type="number" class="form-control" id="productQuantity" name="productQuantity" required>
                    </div>
                    <p style="color: red;">Upload 4 images of the product</p>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image 1</label>
                        <input type="file" class="form-control" id="productImage" name="productImage" required>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image 2</label>
                        <input type="file" class="form-control" id="productImage2" name="productImage" required>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image 3</label>
                        <input type="file" class="form-control" id="productImage3" name="productImage" required>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image 4</label>
                        <input type="file" class="form-control" id="productImage4" name="productImage" required>
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Product Category</label>
                        <select class="form-select" id="productCategory" name="productCategory" required>
                            <option value="laptop">Laptop & Desktops</option>
                            <option value="mobile">Gaming Chairs</option>
                            <option value="tablet">PC Components</option>
                            <option value="accessories">Pheripals</option>
                            <option value="accessories">Accessories</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productBrand" class="form-label">Product Brand</label>
                        <select class="form-select" id="productBrand" name="productBrand" required>
                            <option value="laptop">Dell</option>
                            <option value="mobile">MSI</option>
                            <option value="tablet">Acer</option>
                            <option value="accessories">Alienware</option>
                            <option value="accessories">Chinese Abacus</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productCondition" class="form-label">Product Condition</label>
                        <select class="form-select" id="productCondition" name="productCondition" required>
                            <option value="laptop">Used</option>
                            <option value="mobile">New</option>
                            <option value="tablet">Not Specified</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productCondition" class="form-label">Warranty Period</label>
                        <select class="form-select" id="productCondition" name="productCondition" required>
                            <option value="laptop">Used</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>