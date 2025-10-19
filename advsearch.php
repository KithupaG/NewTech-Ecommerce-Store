<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/advsearch.css" />
  <link rel="stylesheet" href="css/universal.css" />
  <title>Advanced Search | New Tech</title>
</head>

<body>
  <div class="container p-5"
    style="margin-top: 2em;background-color: #dfdbdb; padding: 20px; border-radius: 20px; height: auto;">
    <a href="store.php">
      <i class="fas fa-angle-left" style="font-size: 20px; color: #333;" title="Back To Store"></i>
    </a>
    <h3 class="display-5 text-center fw-600 mb-5">Advanced Search</h3>

    <form action="advancedsearchResults.php" method="GET" style="height: 75vh;">
      <div class="form">
        <div class="input-group mb-3">
          <input type="text" name="keyword" class="form-control" placeholder="Enter Keyword...">
        </div>

        <div class="option mt-5">
          <select class="form-select" name="category" aria-label="Default select example">
            <option selected value="0">All Categories</option>
            <?php
            require "connection.php";
            $categories = Database::search("SELECT * FROM `category`");

            if ($categories->num_rows > 0) {
              while ($category = $categories->fetch_assoc()) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
              }
            } else {
              echo "<option disabled>No categories found.</option>";
            }
            ?>
          </select>
        </div>

        <div class="option mt-2">
          <select class="form-select" name="brand" aria-label="Default select example">
            <option selected value="0">Brands</option>
            <?php
            $brands = Database::search("SELECT * FROM `brand`");

            if ($brands->num_rows > 0) {
              while ($brand = $brands->fetch_assoc()) {
                echo "<option value='{$brand['id']}'>{$brand['name']}</option>";
              }
            } else {
              echo "<option disabled>No brands found.</option>";
            }
            ?>
          </select>
        </div>

        <div class="checkbox mt-5">
          <h5 class="text-start" style="font-weight: bold;">Condition</h5>
          <?php
          $conditions = Database::search("SELECT * FROM `condition`");

          if ($conditions->num_rows > 0) {
            while ($condition = $conditions->fetch_assoc()) {
              echo "
                  <div class='form-check form-switch'>
                    <input class='form-check-input' type='checkbox' name='condition[]' value='{$condition['id']}' id='condition{$condition['id']}'>
                    <label class='form-check-label' for='condition{$condition['id']}'>{$condition['name']}</label>
                  </div>";
            }
          } else {
            echo "<p>No conditions available.</p>";
          }
          ?>
        </div>

        <hr class="mt-4 mb-4">

        <div class="checkbox mt-2">
          <input type="checkbox" class="form-check-input" name="stock" id="stock">
          <label class="text-start" style="font-weight: bold;">In-Stock</label>
        </div>

        <hr class="mt-4 mb-4">

        <!-- Search Button -->
        <div class="checkbox">
          <button type="submit" class="btn btn-success" style="width: 100%; margin-bottom: 2rem;">
            Search
          </button>
        </div>
      </div>
    </form>
  </div>

  <div class="margin-top mt-5"></div>
</body>
<script src="js/main.js" defer></script>

</html>