<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | QuizMaster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/userAuthen/authUser.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="auth-page">
        <div class="auth-main-card">
            <!-- LEFT SIDE CONTENT -->
            <div class="auth-left-panel">
                <div class="auth-left-content">
                    <div class="auth-brand">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <span>QuizMaster</span>
                    </div>
                    <div class="auth-left-heading">
                        <span class="auth-tagline">LEARN. PRACTICE. SUCCEED.</span>
                        <h1>
                            Start Your Learning Journey Today!
                        </h1>
                        <p>
                            Join our learning community and take your
                            knowledge to the next level. Practice, learn,
                            and test your skills with interactive quizzes
                            and assessments.
                        </p>
                    </div>
                    <div class="auth-features">
                        <div class="auth-feature-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Access multiple quizzes and assessments</span>
                        </div>
                        <div class="auth-feature-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Track your learning progress</span>
                        </div>
                        <div class="auth-feature-item">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Improve your skills every day</span>
                        </div>
                    </div>
                    <div class="auth-left-footer">
                        <i class="fa-solid fa-shield-halved"></i>
                        Learn smarter. Achieve more.
                    </div>
                </div>
            </div>
            <!-- RIGHT SIDE REGISTRATION FORM -->
            <div class="auth-right-panel">
                <div class="auth-form-container">
                    <!-- FORM HEADER -->
                    <div class="text-center auth-header">
                        <div class="auth-icon">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <h2 class="auth-form-title">
                            Create Account
                        </h2>
                        <p class="auth-form-subtitle">
                            Register to get started with your learning journey.
                        </p>
                    </div>
                    <!-- REGISTRATION FORM -->
                    <form action="/store/user/register/data" method="POST">
                        @csrf
                        <!-- FULL NAME -->
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <div class="auth-input-group">
                                <i class="fa-regular fa-user"></i>
                                <input type="text" name="User_Name" class="form-control" placeholder="Enter your full name" required>
                            </div>
                            @error('User_Name')
                            <small class="text-danger d-block mt-1">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>
                            @enderror
                            <!-- Display message -->
                            @if(session('error'))
                            <p class="text-danger fw-semibold mt-2">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                {{ session('error') }}
                            </p>
                            @endif
                        </div>
                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <div class="auth-input-group">
                                <i class="fa-regular fa-envelope"></i>
                                <input type="email" name="User_Email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            @error('User_Email')
                            <small class="text-danger d-block mt-1">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>
                            @enderror
                            <!-- Display message -->
                            @if(session('error'))
                            <p class="text-danger fw-semibold mt-2">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                {{ session('error') }}
                            </p>
                            @endif
                        </div>
                        <!-- PASSWORD -->
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="auth-input-group">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="user_Password" id="registerPassword" class="form-control"
                                    placeholder="Create a password"  required>
                                <i class="fa-regular fa-eye password-toggle" data-target="registerPassword"></i>
                            </div>
                            @error('user_Password')
                            <small class="text-danger d-block mt-1">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                {{ $message }}
                            </small>
                            @enderror
                            <!-- Display message -->
                            @if(session('error'))
                            <p class="text-danger fw-semibold mt-2">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                {{ session('error') }}
                            </p>
                            @endif
                        </div>
                        <!-- CONFIRM PASSWORD -->
                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <div class="auth-input-group">
                                <i class="fa-solid fa-shield-halved"></i>
                                <input type="password" name="user_Password_confirmation" id="confirmPassword"
                                    class="form-control" placeholder="Confirm your password" autocomplete="new-password"
                                    required>
                                <i class="fa-regular fa-eye password-toggle" data-target="confirmPassword"></i>
                            </div>
                        </div>
                        <!-- SUBMIT BUTTON -->
                        <button type="submit" class="btn auth-submit-btn w-100">
                            Create Account
                            <i class="fa-solid fa-arrow-right ms-2"></i>
                        </button>
                    </form>
                    <!-- LOGIN LINK -->
                    <div class="auth-bottom-text text-center mt-4">
                        Already have an account?
                        <a href="{{ url('/user/login/form') }}">
                            Login Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PASSWORD VISIBILITY -->
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