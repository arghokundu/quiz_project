<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | QuizMaster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/userAuthen/authUser.css') }}">
</head>
<body>
    <div class="auth-page">
        <div class="auth-main-card">
            <!-- ================================= LEFT SIDE CONTENT ================================== -->
            <div class="auth-left-panel">
                <div class="auth-left-content">
                    <!-- BRAND -->
                    <div class="auth-brand">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <span>QuizMaster</span>
                    </div>
                    <!-- HEADING -->
                    <div class="auth-left-heading">
                        <span class="auth-tagline">
                            LEARN. PRACTICE. SUCCEED.
                        </span>
                        <h1>
                            Welcome Back!
                            Continue Your Learning Journey.
                        </h1>
                        <p>
                            Your learning journey continues here.
                            Log in to access your quizzes, monitor your progress,
                            and keep improving your knowledge.
                        </p>
                    </div>
                    <!-- FEATURES -->
                    <div class="auth-features">
                        <div class="auth-feature-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Continue where you left off</span>
                        </div>
                        <div class="auth-feature-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>View your assessment results</span>
                        </div>
                        <div class="auth-feature-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Achieve your learning goals</span>
                        </div>
                    </div>
                    <!-- FOOTER -->
                    <div class="auth-left-footer">
                        <i class="fa-solid fa-shield-halved"></i>
                        Your knowledge. Your progress. Your success.
                    </div>
                </div>
            </div>
            <!-- ================================= RIGHT SIDE LOGIN FORM================================== -->
            <div class="auth-right-panel">
                <div class="auth-form-container">
                    <!-- FORM HEADER -->
                    <div class="text-center auth-header">
                        <div class="auth-icon">
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </div>
                        <h2 class="auth-form-title">
                            Welcome Back
                        </h2>
                        <p class="auth-form-subtitle">
                            Please enter your credentials to continue.
                        </p>
                    </div>
                    <!-- LOGIN FORM -->
                    <form action="#" method="POST">
                        @csrf
                        <!-- EMAIL ADDRESS -->
                        <div class="mb-4">
                            <label class="form-label">
                                Email Address
                            </label>
                            <div class="auth-input-group">
                                <i class="fa-regular fa-envelope"></i>
                                <input type="email" name="user_email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            @error('email')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <!-- PASSWORD -->
                        <div class="mb-3">
                            <label class="form-label">
                                Password
                            </label>
                            <div class="auth-input-group">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="User_password" id="loginPassword" class="form-control"
                                    placeholder="Enter your password" required>
                                <i class="fa-regular fa-eye password-toggle" data-target="loginPassword"></i>
                            </div>
                            @error('password')
                            <small class="text-danger d-block mt-1">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <!-- FORGOT PASSWORD -->
                        <div class="text-end mb-4">
                            <a href="#" class="auth-link">
                                Forgot Password?
                            </a>
                        </div>
                        <!-- LOGIN BUTTON -->
                        <button type="submit" class="btn auth-submit-btn w-100">
                            Login Now
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>
                    </form>
                    <!-- REGISTER LINK -->
                    <div class="auth-bottom-text text-center mt-4">
                        Don't have an account?
                        <a href="{{ url('/user/reg/form') }}">
                            Create Account
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================================= PASSWORD VISIBILITY SCRIPT ================================== -->
    <script>
    document.querySelectorAll('.password-toggle').forEach(function(icon) {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });
    </script>
</body>
</html>