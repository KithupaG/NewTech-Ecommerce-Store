function signUp() {
  var f = document.getElementById("f");
  var l = document.getElementById("l");
  var e = document.getElementById("e");
  var m = document.getElementById("m");
  var a = document.getElementById("a");
  var p = document.getElementById("p");
  var cp = document.getElementById("cp");

  if (p.value !== cp.value) {
    alert("Passwords do not match");
    return false;
  }

  var formData = new FormData();
  formData.append("f", f.value);
  formData.append("l", l.value);
  formData.append("e", e.value);
  formData.append("m", m.value);
  formData.append("p", p.value);
  formData.append("a", a.value);

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      var response = xhr.responseText;

      if (response === "success") {
        alert("Registration successful! Redirecting to login...");
        window.location.href = "sellerlogin.php";
      } else {
        document.getElementById("msg").innerHTML = response;
        document.getElementById("msgdiv").classList.remove("d-none");
        document.getElementById("msgdiv").classList.add("d-block");
      }
    }
  };

  xhr.open("POST", "sellerRegisterProcess.php", true);
  xhr.send(formData);

  return false;
}

function signIn(event) {
  if (event) event.preventDefault();

  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var rememberme = document.getElementById("rememberme") ? document.getElementById("rememberme").checked : false;

  var formData = new FormData();
  formData.append("e", email);
  formData.append("p", password);
  formData.append("r", rememberme ? "true" : "false");

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var response = xhr.responseText.trim();
      if (response === "success") {
        window.location = "sellerDashboard.php";
      } else {
        document.getElementById("msg").innerText = response;
        document.getElementById("msgdiv").classList.remove("d-none");
        document.getElementById("msgdiv").classList.add("d-block");
      }
    } else if (xhr.readyState == 4) {
      console.error("Server error: " + xhr.status);
    }
  };
  xhr.open("POST", "sellerLoginProcess.php", true);
  xhr.send(formData);
}
