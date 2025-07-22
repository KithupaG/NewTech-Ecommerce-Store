document.addEventListener("DOMContentLoaded", function () {
  if (window.innerWidth < 992) {
    document.querySelectorAll('.navbar .dropdown').forEach(function (everydropdown) {
      everydropdown.addEventListener('hidden.bs.dropdown', function () {
        this.querySelectorAll('.submenu').forEach(function (everysubmenu) {
          everysubmenu.style.display = 'none';
        });
      })
    });

    document.querySelectorAll('.dropdown-menu a').forEach(function (element) {
      element.addEventListener('click', function (e) {
        let nextEl = this.nextElementSibling;
        if (nextEl && nextEl.classList.contains('submenu')) {
          e.preventDefault();
          if (nextEl.style.display == 'block') {
            nextEl.style.display = 'none';
          } else {
            nextEl.style.display = 'block';
          }

        }
      });
    })
  }
});
// End Dropdown Menu
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
        window.location.href = "login.php";
      } else {
        document.getElementById("msg").innerHTML = response;
        document.getElementById("msgdiv").classList.remove("d-none");
        document.getElementById("msgdiv").classList.add("d-block");
      }
    }
  };

  xhr.open("POST", "signupProcess.php", true);
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
        window.location = "store.php";
      } else {
        document.getElementById("msg").innerText = response;
        document.getElementById("msgdiv").classList.remove("d-none");
        document.getElementById("msgdiv").classList.add("d-block");
      }
    } else if (xhr.readyState == 4) {
      console.error("Server error: " + xhr.status);
    }
  };
  xhr.open("POST", "signinProcess.php", true);
  xhr.send(formData);
}

function basicSearch(page) {
  var txt = document.getElementById("basic_search_txt");

  var f = new FormData();
  f.append("t", txt.value);
  f.append("page", page);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      document.getElementById("basicSearchResult").innerHTML = r.responseText;
    }
  };

  r.open("POST", "store_search.php", true);
  r.send(f);
}

