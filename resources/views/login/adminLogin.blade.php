<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{asset('assets/css/login/log.css')}}" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="card login-card shadow-lg mx-auto">
            <div class="card-body p-4 ">

                <h2 class="text-center fw-bold mb-2">Welcome Back!</h2>
                <p class="text-center text-muted mb-4">
                    Please login to your account
                </p>

                <form id="loginForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password"
                            required minlength="6">
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        <a href="#" class="text-decoration-none">
                            Forgot password?
                        </a>
                    </div>

                    <button type="submit" class="btn btn-login w-100">
                        Login
                    </button>

                    <div id="message" class="mt-3 text-center"></div>

                </form>

                <p class="text-center mt-4 mb-0">
                    Don't have an account?
                    <a href="/register" class="fw-bold text-decoration-none">
                        Register
                    </a>
                </p>

            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/js/login/log.js')}}">
    </script>

</body>

</html>