document.getElementById("registerForm").addEventListener("submit", function (e) {
    e.preventDefault();
    const password = document.getElementById("password").value;
    const confirmPassword =
        document.getElementById("confirmPassword").value;
    const message = document.getElementById("message");
    if (password !== confirmPassword) {
        message.innerHTML =
            '<div class="alert alert-danger">Passwords do not match!</div>';
        return;
    }
    message.innerHTML =
        '<div class="alert alert-success">Registration form validated. Connect a backend to create your account.</div>';
});