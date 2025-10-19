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
  <link rel="stylesheet" href="../css/universal.css">
  <title>Seller Login | New Tech</title>
</head>

<body class="d-flex justify-content-center align-items-center">
  <?php include "connection.php"; ?>
  <form id="loginForm" class="card m-5 p-5 w-50" onsubmit="return false;">
    <ul class="nav nav-tabs mb-5">
      <li class="nav-item">
        <a class="nav-link active bg-success text-white" aria-current="page" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="index.php">Register</a>
      </li>
    </ul>
    <h1 class="text-center text-muted">Login to your account</h1>
    <div class="text-start p-5">
      <div id="msgdiv" class="d-none">
        <div class="alert alert-danger" role="alert">
          <i class="bi bi-x-octagon-fill fs-5" id="msg"></i>
        </div>
      </div>
      <div class="form-group mb-4">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="e" required />
      </div>
      <div class="form-group mb-4">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="p" required />
      </div>
      <div class="form-group mb-2">
        <label class="form-check-label">
          <input type="checkbox" id="rememberme"> Remember Me
        </label>
      </div>
      <div class="form-group mb-3">
        <a href="#" id="forgotPasswordLink" style="display: block;">Forgot Password?</a>
      </div>
      <button type="button" class="btn btn-success btn-block w-100" onclick="signIn()">Login</button>
    </div>
  </form>

  <div class="modal" tabindex="-1" id="forgotPasswordModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Reset Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-6">
              <label class="form-label">New Password</label>
              <div class="input-group mb-3">
                <input type="password" class="form-control" id="npi" />
              </div>
            </div>
            <div class="col-6">
              <label class="form-label">Re-type Password</label>
              <div class="input-group mb-3">
                <input type="password" class="form-control" id="rnp" />
              </div>
            </div>
            <div class="col-12">
              <label class="form-label">Verification Code</label>
              <input type="text" class="form-control" id="vc" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
  <script>
    document.getElementById('forgotPasswordLink').addEventListener('click', forgotPassword);

    function forgotPassword() {
      var email = document.getElementById("email");

      var r = new XMLHttpRequest();

      r.onreadystatechange = function() {
        if (r.readyState == 4) {
          var t = r.responseText;
          if (t == "Success") {
            alert("Verification code has been sent to your email. Please check your inbox");
            var m = document.getElementById("forgotPasswordModal");
            bm = new bootstrap.Modal(m);
            bm.hide();
            bm.show();
          } else {
            alert(t);
          }
        }
      }

      r.open("GET", "../forgotPasswordProcess.php?e=" + email.value, true);
      r.send();
    }

    function resetpw() {
      var email = document.getElementById("email").value;
      var np = document.getElementById("npi").value;
      var rnp = document.getElementById("rnp").value;
      var vcode = document.getElementById("vc").value;

      if (np != rnp) {
        alert("Please enter the same password for both fields");
        return;
      }

      var f = new FormData();
      f.append("e", email);
      f.append("n", np);
      f.append("r", rnp);
      f.append("v", vcode);

      var r = new XMLHttpRequest();

      r.onreadystatechange = function() {
        if (r.readyState == 4) {
          var t = r.responseText;
          if (t == "success") {
            bm.hide();
            alert("Password reset successful");
          } else {
            alert(t);
          }
        }
      };

      r.open("POST", "../resetPassword.php", true);
      r.send(f);
    }
  </script>
</body>

</html>
