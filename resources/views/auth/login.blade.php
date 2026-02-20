<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-icons.css') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo/48.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/logo/48.png') }}" />

    <title>Login | CRYPTEXA</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1a1f3a 50%, #0d1726 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background elements */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background:
                radial-gradient(circle at 20% 50%, rgba(56, 189, 248, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(34, 211, 238, 0.05) 0%, transparent 50%);
            animation: moveGradient 15s ease infinite;
            z-index: 1;
            pointer-events: none;
        }

        @keyframes moveGradient {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(50px, 50px);
            }
        }

        /* Animated floating circles */
        body::after {
            content: '';
            position: fixed;
            bottom: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
            z-index: 1;
            pointer-events: none;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-30px);
            }
        }

        .login-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Logo */
        .logo-section {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeInDown 0.6s ease-out;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            background: linear-gradient(135deg, #38bdf8 0%, #22d3ee 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            box-shadow: 0 10px 30px rgba(56, 189, 248, 0.3);
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-section h1 {
            color: #fff;
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 8px 0;
            background: linear-gradient(135deg, #38bdf8, #22d3ee);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo-section p {
            color: rgba(226, 232, 240, 0.6);
            font-size: 14px;
            margin: 0;
        }

        /* Card */
        .login-card {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.8) 0%, rgba(30, 41, 59, 0.8) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(56, 189, 248, 0.2);
            border-radius: 24px;
            padding: 32px 24px;
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.4),
                inset 0 1px 1px rgba(255, 255, 255, 0.1);
            animation: fadeIn 0.8s ease-out 0.2s both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Alert Messages */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 12px 16px;
            font-size: 14px;
            margin-bottom: 20px;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Form Group */
        .form-group {
            margin-bottom: 20px;
            animation: fadeIn 0.8s ease-out;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.3s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.4s;
        }

        .form-label {
            display: block;
            color: rgb(226, 232, 240);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }

        /* Input Fields */
        .form-input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(15, 23, 42, 0.7);
            border: 1.5px solid rgba(56, 189, 248, 0.2);
            border-radius: 12px;
            color: rgb(226, 232, 240);
            font-size: 15px;
            transition: all 0.3s ease;
            position: relative;
        }

        .form-input::placeholder {
            color: rgba(226, 232, 240, 0.5);
        }

        .form-input:focus {
            outline: none;
            border-color: rgba(56, 189, 248, 0.8);
            background: rgba(15, 23, 42, 0.9);
            box-shadow:
                0 0 0 3px rgba(56, 189, 248, 0.1),
                0 10px 25px rgba(56, 189, 248, 0.2);
        }

        .form-input:focus+.form-label,
        .form-input:not(:placeholder-shown)+.form-label {
            color: #38bdf8;
            transform: translateY(5px);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(56, 189, 248, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
            background: none;
            border: none;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .form-input:focus~.input-icon {
            color: #38bdf8;
        }

        /* Password toggle */
        .show-hide-password {
            display: none;
        }

        .show-hide-password.active {
            display: inline;
        }

        /* Error Messages */
        .input-error {
            display: block;
            color: #fca5a5;
            font-size: 12px;
            margin-top: 6px;
            animation: slideDown 0.3s ease-out;
        }

        .form-input.is-invalid {
            border-color: rgba(239, 68, 68, 0.5);
        }

        /* Remember & Forgot */
        .forgot-remember {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 16px 0 24px 0;
            font-size: 13px;
        }

        .forgot-link {
            color: #38bdf8;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-link:hover {
            color: #22d3ee;
            text-decoration: underline;
        }

        /* Login Button */
        .btn-login {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #38bdf8 0%, #22d3ee 100%);
            color: #020617;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(56, 189, 248, 0.3);
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out 0.5s both;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(56, 189, 248, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Sign up link */
        .signup-link {
            text-align: center;
            margin-top: 24px;
            color: rgba(226, 232, 240, 0.6);
            font-size: 14px;
            animation: fadeIn 0.8s ease-out 0.6s both;
        }

        .signup-link a {
            color: #38bdf8;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .signup-link a:hover {
            color: #22d3ee;
            text-decoration: underline;
        }

        /* Mobile responsiveness */
        @media (max-width: 480px) {
            .login-container {
                padding: 16px;
            }

            .login-card {
                padding: 24px 20px;
            }

            .logo-section {
                margin-bottom: 30px;
            }

            .logo-section h1 {
                font-size: 24px;
            }

            .form-input {
                padding: 12px 14px;
                font-size: 16px;
            }

            .btn-login {
                padding: 12px 20px;
                font-size: 14px;
            }
        }

        /* Validation errors container */
        .validation-errors {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 20px;
            animation: slideDown 0.4s ease-out;
        }

        .validation-errors p {
            margin: 4px 0;
            color: #fca5a5;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-wrapper">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo-icon">💎</div>
                <h1>CRYPTEXA</h1>
                <p>Welcome back to your crypto dashboard</p>
            </div>

            <!-- Login Card -->
            <div class="login-card">
                <!-- Success Alert -->
                @if(session('success'))
                <div class="alert alert-success">
                    ✓ {{ session('success') }}
                </div>
                @endif

                <!-- Error Alert -->
                @if(session('error'))
                <div class="alert alert-danger">
                    ✗ {{ session('error') }}
                </div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                <div class="validation-errors">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" id="loginForm">
                    @csrf

                    <!-- Username/Email Field -->
                    <div class="form-group">
                        <label class="form-label">Username or Email</label>
                        <input
                            type="text"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-input{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            placeholder="Enter your username or email"
                            required
                            autocomplete="on">
                        @if($errors->has('email'))
                        <span class="input-error">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input
                                type="password"
                                name="password"
                                class="form-input{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                placeholder="Enter your password"
                                required
                                autocomplete="off"
                                id="passwordInput">
                            <button type="button" class="input-icon" id="togglePassword" title="Show/Hide password">
                                <span>👁️</span>
                            </button>
                        </div>
                        @if($errors->has('password'))
                        <span class="input-error">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <!-- Forgot Password Link -->
                    <div class="forgot-remember">
                        <a href="/forgot-password" class="forgot-link">Forgot password?</a>
                        <label style="color: rgba(226, 232, 240, 0.6); font-weight: 500; display: flex; align-items: center; gap: 6px; cursor: pointer;">
                            <input type="checkbox" name="remember" style="cursor: pointer; accent-color: #38bdf8;">
                            Remember me
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn-login" id="loginBtn">
                        Sign In
                    </button>

                    <!-- Sign Up Link -->
                    <div class="signup-link">
                        Don't have an account?
                        <a href="{{ route('register') }}">Create one</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Login Page Scripts -->
    <script>
        // Password visibility toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function(e) {
                e.preventDefault();
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('span').textContent = type === 'password' ? '👁️' : '👁️‍🗨️';
            });
        }

        // Form submission feedback
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn');

        if (loginForm) {
            loginForm.addEventListener('submit', function() {
                if (loginBtn) {
                    loginBtn.disabled = true;
                    loginBtn.innerHTML = 'Signing in...';
                }
            });
        }

        // Add focus animations to inputs
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
            });
            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Prevent password autocomplete issues
        window.addEventListener('load', function() {
            if (passwordInput) {
                passwordInput.setAttribute('autocomplete', 'new-password');
            }
        });
    </script>

</body>

</html>