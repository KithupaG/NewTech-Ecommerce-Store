function adminLogin() {
    var username = document.getElementById("username");
    var password = document.getElementById("password");

    var formData = new FormData();
    formData.append("username", username.value);
    formData.append("password", password.value);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText.trim();
            if (response === "success") {
                window.location = "admin-panel.php";
            } else {
                document.getElementById("msg").innerText = response;
                document.getElementById("msgdiv").classList.remove("d-none");
                document.getElementById("msgdiv").classList.add("d-block");
            }
        } else if (xhr.readyState == 4) {
            console.error("Server error: " + xhr.status);
        }
    };
    xhr.open("POST", "adminLoginProcess.php", true);
    xhr.send(formData);
}