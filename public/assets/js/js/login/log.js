document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    document.getElementById("message").innerHTML =
        '<div class="alert alert-info">Login form submitted successfully.</div>';
});