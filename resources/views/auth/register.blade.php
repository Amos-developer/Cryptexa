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

    <title>Register | CRYPTEXA</title>

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

        .register-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .register-wrapper {
            width: 100%;
            max-width: 480px;
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
        .register-card {
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
            margin-bottom: 18px;
            animation: fadeIn 0.8s ease-out;
        }

        .form-label {
            display: block;
            color: rgb(226, 232, 240);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }

        .form-label .required {
            color: #fca5a5;
        }

        /* Input Fields */
        .form-input {
            width: 100%;
            padding: 12px 14px;
            background: rgba(15, 23, 42, 0.7);
            border: 1.5px solid rgba(56, 189, 248, 0.2);
            border-radius: 12px;
            color: rgb(226, 232, 240);
            font-size: 14px;
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

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 12px;
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
            width: 36px;
            height: 36px;
            font-size: 16px;
        }

        .form-input:focus~.input-icon {
            color: #38bdf8;
        }

        /* Error Messages */
        .input-error {
            display: block;
            color: #fca5a5;
            font-size: 12px;
            margin-top: 5px;
            animation: slideDown 0.3s ease-out;
        }

        .form-input.is-invalid {
            border-color: rgba(239, 68, 68, 0.5);
        }

        /* Checkbox */
        .form-checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin: 20px 0;
            padding: 14px 12px;
            background: rgba(56, 189, 248, 0.05);
            border: 1px solid rgba(56, 189, 248, 0.15);
            border-radius: 12px;
            animation: fadeIn 0.8s ease-out 0.3s both;
        }

        .form-checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            min-width: 18px;
            cursor: pointer;
            accent-color: #38bdf8;
            margin-top: 2px;
        }

        .form-checkbox-group label {
            color: rgb(226, 232, 240);
            font-size: 13px;
            cursor: pointer;
            flex: 1;
            margin: 0;
        }

        .form-checkbox-group label .terms-link {
            color: #38bdf8;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .form-checkbox-group label .terms-link:hover {
            color: #22d3ee;
            text-decoration: underline;
        }

        /* Register Button */
        .btn-register {
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
            animation: fadeIn 0.8s ease-out 0.4s both;
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(56, 189, 248, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-register:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Login link */
        .login-link {
            text-align: center;
            margin-top: 24px;
            color: rgba(226, 232, 240, 0.6);
            font-size: 14px;
            animation: fadeIn 0.8s ease-out 0.5s both;
        }

        .login-link a {
            color: #38bdf8;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: #22d3ee;
            text-decoration: underline;
        }

        /* Referral code applied */
        .referral-success {
            font-size: 12px;
            color: #86efac;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Mobile responsiveness */
        @media (max-width: 480px) {
            .register-container {
                padding: 16px;
            }

            .register-card {
                padding: 24px 20px;
            }

            .logo-section {
                margin-bottom: 30px;
            }

            .logo-section h1 {
                font-size: 24px;
            }

            .form-input {
                padding: 11px 12px;
                font-size: 16px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .btn-register {
                padding: 12px 20px;
                font-size: 14px;
            }

            .register-wrapper {
                max-width: 100%;
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

        .validation-errors p:first-child {
            margin-top: 0;
        }

        .validation-errors p:last-child {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-wrapper">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo-icon">💎</div>
                <h1>CRYPTEXA</h1>
                <p>Join thousands of crypto traders</p>
            </div>

            <!-- Register Card -->
            <div class="register-card">
                <!-- Success Alert -->
                @if(session('success'))
                <div class="alert alert-success">
                    ✓ {{ session('success') }}
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

                <form method="POST" action="{{ route('register.post') }}" id="registerForm">
                    @csrf

                    <!-- Username Field -->
                    <div class="form-group">
                        <label class="form-label">Username<span class="required">*</span></label>
                        <input
                            type="text"
                            name="username"
                            value="{{ old('username') }}"
                            class="form-input{{ $errors->has('username') ? ' is-invalid' : '' }}"
                            placeholder="Choose a unique username"
                            required>
                        @if($errors->has('username'))
                        <span class="input-error">{{ $errors->first('username') }}</span>
                        @endif
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label class="form-label">Email Address<span class="required">*</span></label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-input{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            placeholder="Enter your email address"
                            required>
                        @if($errors->has('email'))
                        <span class="input-error">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <!-- Referral Code Field -->
                    @php
                    $refCode = request('ref') ?? old('ref');
                    @endphp
                    <div class="form-group">
                        <label class="form-label">Referral Code<span class="required">*</span></label>
                        <input
                            type="text"
                            name="ref"
                            value="{{ $refCode }}"
                            class="form-input{{ $errors->has('ref') ? ' is-invalid' : '' }}"
                            placeholder="Enter 8-digit code"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            maxlength="8"
                            required
                            {{ request('ref') ? 'readonly' : '' }}>
                        @if(request('ref'))
                        <div class="referral-success">✓ Referral code applied</div>
                        @endif
                        @if($errors->has('ref'))
                        <span class="input-error">{{ $errors->first('ref') }}</span>
                        @endif
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label class="form-label">Password<span class="required">*</span></label>
                        <div class="input-group">
                            <input
                                type="password"
                                name="password"
                                class="form-input{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                placeholder="6-20 characters"
                                required
                                id="passwordInput"
                                autocomplete="new-password">
                            <button type="button" class="input-icon" id="togglePassword1" title="Show/Hide password">
                                <span>👁️</span>
                            </button>
                        </div>
                        @if($errors->has('password'))
                        <span class="input-error">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-group">
                        <label class="form-label">Confirm Password<span class="required">*</span></label>
                        <div class="input-group">
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-input{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                placeholder="Confirm your password"
                                required
                                id="confirmPasswordInput"
                                autocomplete="new-password">
                            <button type="button" class="input-icon" id="togglePassword2" title="Show/Hide password">
                                <span>👁️</span>
                            </button>
                        </div>
                        @if($errors->has('password_confirmation'))
                        <span class="input-error">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="form-checkbox-group">
                        <input type="checkbox" id="termsCheckbox" name="terms" required>
                        <label for="termsCheckbox">
                            I agree to the <a href="/terms" class="terms-link" target="_blank">Terms & Conditions</a>
                        </label>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="btn-register" id="registerBtn">
                        Create Account
                    </button>

                    <!-- Login Link -->
                    <div class="login-link">
                        Already have an account?
                        <a href="{{ route('login') }}">Sign in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Register Page Scripts -->
    <script>
        // Password visibility toggles
        const togglePassword1 = document.getElementById('togglePassword1');
        const togglePassword2 = document.getElementById('togglePassword2');
        const passwordInput = document.getElementById('passwordInput');
        const confirmPasswordInput = document.getElementById('confirmPasswordInput');

        function setupPasswordToggle(button, input) {
            if (button && input) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    this.querySelector('span').textContent = type === 'password' ? '👁️' : '👁️‍🗨️';
                });
            }
        }

        setupPasswordToggle(togglePassword1, passwordInput);
        setupPasswordToggle(togglePassword2, confirmPasswordInput);

        // Form submission feedback
        const registerForm = document.getElementById('registerForm');
        const registerBtn = document.getElementById('registerBtn');

        if (registerForm) {
            registerForm.addEventListener('submit', function() {
                if (registerBtn) {
                    registerBtn.disabled = true;
                    registerBtn.innerHTML = 'Creating Account...';
                }
            });
        }

        // Add focus animations to inputs
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.01)';
            });
            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Real-time password confirmation validation
        if (confirmPasswordInput && passwordInput) {
            confirmPasswordInput.addEventListener('input', function() {
                if (this.value && this.value !== passwordInput.value) {
                    this.style.borderColor = 'rgba(239, 68, 68, 0.5)';
                } else {
                    this.style.borderColor = 'rgba(56, 189, 248, 0.2)';
                }
            });
        }

        // Prevent password autocomplete issues
        window.addEventListener('load', function() {
            if (passwordInput) {
                passwordInput.setAttribute('autocomplete', 'new-password');
            }
            if (confirmPasswordInput) {
                confirmPasswordInput.setAttribute('autocomplete', 'new-password');
            }
        });

        // Referral code auto-formatting (uppercase, only numbers)
        const refInput = document.querySelector('input[name="ref"]');
        if (refInput && !refInput.readOnly) {
            refInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').slice(0, 8);
            });
        }
    </script>

</body>

</html>