
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="{{asset('assets/css/login/reg.css')}}" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="card register-card shadow-lg mx-auto">
            <div class="card-body p-4 ">

                <h2 class="text-center fw-bold mb-2">Create Account</h2>
                <p class="text-center text-muted mb-4">
                    Register to get started
                </p>

                <form id="registerForm">

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control"
                               id="name" placeholder="Enter your full name"
                               required minlength="2">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control"
                               id="email" placeholder="Enter your email"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control"
                               id="password" placeholder="Create a password"
                               required minlength="8">
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">
                            Confirm Password
                        </label>
                        <input type="password" class="form-control"
                               id="confirmPassword"
                               placeholder="Confirm your password"
                               required minlength="8">
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input"
                               id="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the Terms and Conditions
                        </label>
                    </div>

                    <button type="submit" class="btn btn-register w-100">
                        Register
                    </button>

                    <div id="message" class="mt-3 text-center"></div>

                </form>

                <p class="text-center mt-4 mb-0">
                    Already have an account?
                    <a href="/login" class="fw-bold text-decoration-none">
                        Login
                    </a>
                </p>

            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/js/login/reg.js')}}">
    </script>

</body>
</html>