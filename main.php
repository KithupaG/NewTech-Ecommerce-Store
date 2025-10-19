<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/universal.css" />
  <link rel="stylesheet" href="css/main.css" />
  <title>New Tech | Home</title>
</head>
<style>
  .custom-select {
    width: 200px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: white;
    font-size: 16px;
    appearance: none;
  }

  .dropdown-label {
    font-size: 16px;
    margin-right: 10px;
    color: #333;
  }

  .custom-select {
    background-color: #343a40;
    /* Dark background */
    color: white;
    /* Text color */
    border: 1px solid #6c757d;
    /* Border color */
    border-radius: 5px;
    padding: 8px 12px;
    font-size: 16px;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 120px;
    cursor: pointer;
  }

  .custom-select-wrapper {
    position: relative;
    display: inline-block;
    cursor: pointer;
    margin-top: 10px;
    margin-right: 10px;
  }

  .custom-select-wrapper::after {
    content: '\25BC';
    /* Down arrow */
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    color: white;
    pointer-events: none;
    cursor: pointer;
  }

  .custom-select option {
    background-color: #343a40;
    color: white;
    cursor: pointer;
  }

  .custom-select option:hover {
    background-color: #495057;
    cursor: pointer;
  }
</style>
<?php

include "connection.php";
session_start();

?>
<header class="header bg-dark">
  <a href="#" class="logo fw-bold text-white">NewTech</a>
  <input class="menu-btn" type="checkbox" id="menu-btn" />
  <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
  <ul class="menu">
    <li><a href="main.php">Home</a></li>
    <li><a href="store.php">Store</a></li>
    <li><a href="main.php#contact">Contact</a></li>

    <?php if (isset($_SESSION['user_id'])): ?>
      <div class="custom-select-wrapper">
        <select id="user-actions" class="custom-select">
          <option value="" disabled selected><?php echo $_SESSION['user_name']; ?></option>
          <option value="profile">Profile</option>
          <option value="wishlist">Wishlist</option>
          <option value="cart">My Cart</option>
          <option value="logout">Logout</option>
        </select>
      </div>
    <?php else: ?>
      <li><a href="login.php" class="text-white">Login</a></li>
      <li><a href="register.php" class="text-white">Register</a></li>
    <?php endif; ?>
  </ul>
</header>

<body>
  <div class="contact-section" id="contact">
    <div class="px-4 py-5 px-md-5 text-center text-lg-start">
      <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-6 mb-5">
            <div>
              <div class="py-5">
                <h1 style="text-align: center;">Welcome to Newtech, Where all your Technology needs are <i style="color: goldenrod">satisfied!</i></h1>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row gx-lg-5 align-items-center">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <img
              src="resources/products/pc.jpg"
              class="img-fluid" />
          </div>
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div>
              <div class="py-5 px-md-5">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel accusantium eum sequi dolor neque dolorum ipsam quam ipsum corrupti soluta ex, quis quia dolore laborum assumenda praesentium doloremque earum esse.
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quae assumenda voluptates dolorem facere voluptas, numquam minima consequatur vitae modi officia eius dolorum vel quas esse? Voluptas ad consectetur quam illo.
              </div>
            </div>
          </div>
        </div>
        <hr class="my-4">
        <div class="row gx-lg-5 align-items-center">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <img
              src="https://static.vecteezy.com/system/resources/previews/005/482/221/original/illustration-graphic-cartoon-character-of-contact-us-vector.jpg"
              class="img-fluid" />
          </div>
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div>
              <div class="py-5 px-md-5">
                <form id="contactForm">
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form4Example1">Name</label>
                    <input type="text" id="main_name" class="form-control" />
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form4Example2">Email address</label>
                    <input type="email" id="main_email" class="form-control" />
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form4Example3">Message</label>
                    <textarea class="form-control" id="main_message" rows="4"></textarea>
                  </div>
                  <button type="button" onclick="sendMessage();" class="btn btn-success btn-block mb-4" style="width: 100%;">
                    Send
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="text-center text-lg-start bg-dark text-muted p-3">
    <section>
      <div class="text-center text-md-start mt-5">
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
              <a href="main.php" class="text-reset">Home</a>
            </p>
            <p>
              <a href="main.php#contact" class="text-reset">Contact</a>
            </p>
            <p>
              <a href="store.php" class="text-reset">Store</a>
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
      <a class="text-reset fw-bold" href="main.html">NewTech.com</a>
    </div>
  </footer>
</body>
<script src="js/main.js" defer></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById("user-actions").addEventListener("change", function() {
    const action = this.value;

    if (action === "profile") {
      window.location.href = "userProfile.php";
    } else if (action === "wishlist") {
      window.location.href = "wishlist.php";

    } else if (action === "cart") {
      window.location.href = "cart.php";

    } else if (action === "logout") {
      window.location.href = "logout.php";
    }
  });

  function sendMessage() {
    var main_name = document.getElementById("main_name").value;
    var main_email = document.getElementById("main_email").value;
    var main_message = document.getElementById("main_message").value;

    if (!main_name || !main_email || !main_message) {
      alert("Please fill out all fields.");
      return;
    }

    var f = new FormData();
    f.append("m_n", main_name);
    f.append("m_e", main_email);
    f.append("m_m", main_message);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
      if (r.readyState == 4) {
        if (r.status == 200) {
          if (r.responseText.trim() === 'success') {
            alert("Message sent successfully!");
          } else {
            alert("Message could not be sent. Error: " + r.responseText);
          }
        } else {
          alert("An error occurred while sending the message.");
        }
      }
    };

    r.open("POST", "main_contact.php", true);
    r.send(f);
  }
</script>

</html>