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
  <link rel="stylesheet" href="css/universal.css">
  <title>Customer Register | New Tech</title>
</head>

<body class="d-flex justify-content-center align-items-center">
  <?php include "connection.php"; ?>
  <form id="registerForm" class="card m-5 p-5 w-50" method="POST" onsubmit="return signUp();">
    <ul class="nav nav-tabs mb-5">
      <li class="nav-item">
        <a class="nav-link text-dark" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active bg-success text-white" aria-current="page" href="register.php">Register</a>
      </li>
    </ul>
    <h1 class="text-center text-muted">Create an account</h1>
    <div class="text-start p-5">
      <div id="msgdiv" class="d-none">
        <div class="alert alert-danger" role="alert" id="alertdiv">
          <i class="bi bi-x-octagon-fill fs-5" id="msg"></i>
        </div>
      </div>


      <div class="form-group mb-4">
        <label class="form-label">First name</label>
        <input type="text" class="form-control" id="f" name="fname" required />
      </div>
      <div class="form-group mb-4">
        <label class="form-label">Last name</label>
        <input type="text" class="form-control" id="l" name="lname" required />
      </div>
      <div class="form-group mb-4">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" id="e" name="email" required />
      </div>
      <div class="form-group mb-4">
        <label class="form-label">Phone</label>
        <input type="number" class="form-control" id="m" name="mobile" required />
      </div>
      <div class="form-group mb-4">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" id="p" name="p" required />
      </div>
      <div class="form-group mb-4">
        <label class="form-label">Repeat Password</label>
        <input type="password" class="form-control" id="cp" required />
      </div>
      <div class="form-group mb-4">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" id="a" name="address" required />
      </div>
      <a href="seller/index.php">Looking to be a Seller? Click Here</a>
      <button type="submit" class="btn btn-success btn-block w-100">Register</button>
    </div>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
</body>

</html>