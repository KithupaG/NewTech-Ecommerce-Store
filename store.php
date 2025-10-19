<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/universal.css" />
    <link rel="stylesheet" href="css/store.css" />
    <title>New Tech | Store</title>
</head>
<style>
    /* Select Dropdown Styling */
    .custom-select {
        width: 200px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: white;
        font-size: 16px;
        appearance: none;
        /* Removes default arrow for custom styling */
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
    <div class="store-header" style="margin: 5rem 5rem 5rem 5rem;">
        <div class="input-group mb-3 w-100">
  
            <input type="text" class="form-control w-50" id="basic_search_txt" placeholder="Search in NewTech.....">
            <button type="button" id="searchButton" class="btn btn-success btn-block" onclick="basicSearch(1);">
                <i class="fas fa-search"></i>
            </button>
            <a href="advsearch.php" class="btn btn-outline-dark"
                style="border-radius: 0px 10px 10px 0px;margin-right: 10px;">
                Advanced
            </a>
        </div>
    </div>
    <div class="store-body">
        <section>
            <div class="container py-5">
                <div class="row">
                    <h1 class="text-muted">Search Results:</h1>
                    <div id="basicSearchResult">
                    </div>
                </div>
            </div>
        </section>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.getElementById("user-actions").addEventListener("change", function() {
            const action = this.value;

            if (action === "profile") {
                window.location.href = "userProfile.php";
            }else if (action === "wishlist") {
                window.location.href = "wishlist.php";

            }else if (action === "cart") {
                window.location.href = "cart.php";

            }
            else if (action === "logout") {
                window.location.href = "logout.php";
            }
        });
    </script>
</body>

</html>