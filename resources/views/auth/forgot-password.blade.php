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
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo/logo.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/logo/logo.png') }}" />

    <title>Forgot Password | CRYPTEXA</title>
</head>

<body>
    <div class="login-container">
        <div class="login-wrapper">
            <!-- Logo Section -->
            <div class="logo-section">
                <img src="{{ asset('images/logo/logo.png') }}" alt="CRYPTEXA Logo" class="logo-icon">
                <p>Reset your password</p>
            </div>

            <!-- Forgot Password Card -->
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

                <div style="text-align: center; margin-bottom: 24px;">
                    <div style="width: 60px; height: 60px; margin: 0 auto 16px; background: linear-gradient(135deg, rgba(56,189,248,0.15) 0%, rgba(56,189,248,0.05) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 28px;">
                        🔐
                    </div>
                    <h2 style="color: #e5e7eb; font-size: 22px; font-weight: 700; margin: 0 0 8px 0;">Forgot Password?</h2>
                    <p style="color: rgba(226, 232, 240, 0.6); font-size: 13px; margin: 0;">Enter your email and we'll send you a reset link</p>
                </div>

                <form method="POST" action="{{ route('forgot.password.post') }}" id="forgotForm">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-input{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            placeholder="Enter your email"
                            required
                            autocomplete="email">
                        @if($errors->has('email'))
                        <span class="input-error">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-login" id="resetBtn">
                        Send Reset Link
                    </button>

                    <!-- Back to Login Link -->
                    <div class="signup-link">
                        Remember your password?
                        <a href="{{ route('login') }}">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Forgot Password Scripts -->
    <script>
        const forgotForm = document.getElementById('forgotForm');
        const resetBtn = document.getElementById('resetBtn');

        if (forgotForm) {
            forgotForm.addEventListener('submit', function() {
                if (resetBtn) {
                    resetBtn.disabled = true;
                    resetBtn.innerHTML = 'Sending...';
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
    </script>

</body>

</html>
