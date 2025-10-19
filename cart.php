<?php
require "connection.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/cart.css" />
  <link rel="stylesheet" href="css/universal.css" />
  <title>Cart | New Tech</title>
</head>
<body>
  <section class="h-100 h-custom mb-5">
    <div class="container py-5 mb-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
          <div class="card card-registration card-registration-2" style="border-radius: 15px;">
            <div class="card-body p-0">
              <div class="row g-0">
                <div class="col-lg-8">
                  <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0 text-black"><i class="fas fa-cart-shopping"></i> Cart</h1>
                    </div>
                    <hr class="my-4">

                    <?php
                    if (isset($_SESSION['user_id'])) {
                      $customer_id = $_SESSION['user_id'];
                      $cartQuery = "SELECT c.id AS cart_id, c.quantity, p.id AS product_id, p.name, p.price, p.image_url FROM cart c JOIN products p ON c.product_id = p.id WHERE c.customer_id = $customer_id";
                      $cartResult = Database::search($cartQuery);
                      $totalCost = 0;

                      $cartItems = [];
                      if ($cartResult && $cartResult->num_rows > 0) {
                        while ($row = $cartResult->fetch_assoc()) {
                          $cartItems[] = $row;
                          $name = $row['name'];
                          $price = (float)$row['price'];
                          $image_url = $row['image_url'];
                          $quantity = (int)$row['quantity'];
                          $totalPrice = $price * $quantity;
                          $totalCost += $totalPrice;
                          $cart_id = $row['cart_id'];
                          $product_id = $row['product_id'];
                        }
                      } else {
                        echo "<p class='text-muted'>Your cart is empty.</p>";
                      }
                    } else {
                      echo "<p class='text-muted'>Please log in to view your cart.</p>";
                    }

                    // Handle the voucher code
                    $voucherDiscount = 0;
                    if (isset($_POST['voucher_code'])) {
                        $voucherCode = $_POST['voucher_code'];
                        $voucherQuery = "SELECT * FROM vouchers WHERE voucher_code = '$voucherCode'";
                        $voucherResult = Database::search($voucherQuery);
                        if ($voucherResult && $voucherResult->num_rows > 0) {
                            $voucher = $voucherResult->fetch_assoc();
                            $voucherDiscount = $totalCost * ($voucher['discount_percentage'] / 100);
                            $totalCost -= $voucherDiscount;
                        } else {
                            $voucherDiscount = 0;
                            $message = "Invalid voucher code.";
                        }
                    }
                    ?>

                    <?php if (!empty($cartItems)): ?>
                      <!-- Display cart items here -->
                      <?php foreach ($cartItems as $item): ?>
                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                          <div class="col-md-2 col-lg-2 col-xl-2">
                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" class="img-fluid rounded-3" alt="<?php echo htmlspecialchars($item['name']); ?>">
                          </div>
                          <div class="col-md-3 col-lg-3 col-xl-3">
                            <h6 class="text-muted"><?php echo htmlspecialchars($item['name']); ?></h6>
                            <h6 class="text-black mb-0">Quantity: <?php echo $item['quantity']; ?></h6>
                          </div>
                          <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                            <h6 class="mb-0">Rs. <?php echo number_format($item['price'] * $item['quantity'], 2); ?></h6>
                          </div>
                          <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                            <button class="btn btn-link px-2 remove-cart-item" data-id="<?php echo $item['cart_id']; ?>">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                        </div>
                        <hr class="my-4">
                      <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="pt-5">
                      <h6 class="mb-0"><a href="store.php" class="text-body">
                          <i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a>
                      </h6>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 bg-grey">
                  <div class="p-5">
                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                    <hr class="my-4">
                    <div class="d-flex justify-content-between mb-4">
                      <h5 class="text-uppercase">Items: <?php echo count($cartItems); ?></h5>
                      <h5>Rs. <?php echo number_format($totalCost, 2); ?></h5>
                    </div>
                    <input type="hidden" id="cart-items" name="cart_items" value="<?php echo htmlspecialchars(json_encode($cartItems)); ?>">
                    <input type="hidden" id="total-amount" name="total_amount" value="<?php echo $totalCost; ?>">
                    <button type="button" class="btn btn-success btn-block btn-lg">Buy Now</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="empty-div" style="margin-top: 10rem;"></div>

  <script>
    const removeButtons = document.querySelectorAll('.remove-cart-item');
    removeButtons.forEach(button => {
      button.addEventListener('click', function(event) {
        event.preventDefault();
        const cartId = this.getAttribute('data-id');
        console.log("Removing item with cartId:", cartId);
        fetch('removeFromCart.php?cart_id=' + cartId, {
            method: 'GET',
            headers: {
              'Content-Type': 'application/json'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              alert(data.message);
              this.closest('.row').remove();
            } else {
              alert('Error: ' + data.message);
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again later.');
          });
      });
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
