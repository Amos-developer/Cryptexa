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

    <title>Email Verification | CRYPTEXA</title>

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
            right: -100px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(34, 211, 238, 0.08) 0%, transparent 70%);
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

        .verify-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .verify-wrapper {
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
        .verify-card {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.8) 0%, rgba(30, 41, 59, 0.8) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(56, 189, 248, 0.2);
            border-radius: 24px;
            padding: 40px 28px;
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.4),
                inset 0 1px 1px rgba(255, 255, 255, 0.1);
            animation: fadeIn 0.8s ease-out 0.2s both;
            text-align: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .verify-card h2 {
            color: #fff;
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 12px 0;
            background: linear-gradient(135deg, #38bdf8, #22d3ee);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: fadeIn 0.8s ease-out 0.3s both;
        }

        .verify-card .subtitle {
            color: rgba(226, 232, 240, 0.6);
            font-size: 14px;
            margin: 0 0 24px 0;
            animation: fadeIn 0.8s ease-out 0.4s both;
        }

        /* Alert Messages */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 14px 16px;
            font-size: 14px;
            margin-bottom: 24px;
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

        /* OTP Input */
        .otp-section {
            margin: 28px 0;
            animation: fadeIn 0.8s ease-out 0.5s both;
        }

        .otp-label {
            display: block;
            color: rgb(226, 232, 240);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 14px;
        }

        .otp-input {
            width: 100%;
            padding: 13px 16px;
            background: rgba(15, 23, 42, 0.7);
            border: 2px solid rgba(56, 189, 248, 0.3);
            border-radius: 14px;
            color: rgb(226, 232, 240);
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 8px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .otp-input::placeholder {
            color: rgba(226, 232, 240, 0.4);
            letter-spacing: 2px;
        }

        .otp-input:focus {
            outline: none;
            border-color: rgba(56, 189, 248, 0.8);
            background: rgba(15, 23, 42, 0.9);
            box-shadow:
                0 0 0 3px rgba(56, 189, 248, 0.1),
                0 10px 30px rgba(56, 189, 248, 0.2);
        }

        .otp-input.is-invalid {
            border-color: rgba(239, 68, 68, 0.6);
        }

        /* Error Messages */
        .input-error {
            display: block;
            color: #fca5a5;
            font-size: 12px;
            margin-top: 8px;
            animation: slideDown 0.3s ease-out;
        }

        /* Verify Button */
        .btn-verify {
            width: 100%;
            padding: 14px 24px;
            background: linear-gradient(135deg, #38bdf8 0%, #22d3ee 100%);
            color: #020617;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(56, 189, 248, 0.3);
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.8s ease-out 0.6s both;
        }

        .btn-verify::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-verify:hover::before {
            left: 100%;
        }

        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(56, 189, 248, 0.4);
        }

        .btn-verify:active {
            transform: translateY(0);
        }

        .btn-verify:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Resend Section */
        .resend-section {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(56, 189, 248, 0.1);
            animation: fadeIn 0.8s ease-out 0.7s both;
        }

        .resend-text {
            color: rgba(226, 232, 240, 0.6);
            font-size: 13px;
            margin-bottom: 12px;
        }

        .btn-resend {
            background: none;
            border: none;
            color: #38bdf8;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-resend:hover {
            color: #22d3ee;
            text-decoration: underline;
        }

        .btn-resend:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Countdown Timer */
        .countdown-text {
            color: rgba(226, 232, 240, 0.5);
            font-size: 12px;
            margin-top: 8px;
        }

        /* Timer display */
        .timer-badge {
            display: inline-block;
            background: rgba(56, 189, 248, 0.1);
            border: 1px solid rgba(56, 189, 248, 0.3);
            padding: 6px 12px;
            border-radius: 8px;
            color: #38bdf8;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }

        /* Back link */
        .back-link {
            text-align: center;
            margin-top: 20px;
            animation: fadeIn 0.8s ease-out 0.8s both;
        }

        .back-link a {
            color: rgba(226, 232, 240, 0.6);
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: #38bdf8;
        }

        /* Validation errors container */
        .validation-errors {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            padding: 12px 14px;
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

        /* Captcha */
        .captcha-wrapper {
            display: flex;
            gap: 10px;
            align-items: stretch;
            margin-bottom: 10px;
        }

        .captcha-display {
            flex: 1;
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.12), rgba(34, 211, 238, 0.12));
            border: 1.5px solid rgba(56, 189, 248, 0.25);
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 8px;
            color: #38bdf8;
            user-select: none;
            font-family: 'Courier New', monospace;
            text-align: center;
            text-shadow: 0 2px 10px rgba(56, 189, 248, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .captcha-refresh {
            width: 48px;
            min-width: 48px;
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.15), rgba(34, 211, 238, 0.1));
            border: 1.5px solid rgba(56, 189, 248, 0.3);
            border-radius: 12px;
            color: #38bdf8;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .captcha-refresh:hover {
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.25), rgba(34, 211, 238, 0.2));
            border-color: rgba(56, 189, 248, 0.5);
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.2);
        }

        .captcha-refresh:active {
            transform: scale(0.95);
        }

        .captcha-refresh img {
            width: 20px;
            height: 20px;
            transition: transform 0.5s ease;
        }

        .captcha-refresh:hover img {
            transform: rotate(180deg);
        }

        .captcha-input {
            width: 100%;
            padding: 13px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1.5px solid rgba(56, 189, 248, 0.25);
            border-radius: 12px;
            color: rgb(226, 232, 240);
            font-size: 15px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 4px;
            font-weight: 600;
            text-align: center;
        }

        .captcha-input::placeholder {
            color: rgba(226, 232, 240, 0.4);
            letter-spacing: 2px;
            font-weight: 500;
        }

        .captcha-input:focus {
            outline: none;
            border-color: rgba(56, 189, 248, 0.6);
            background: rgba(15, 23, 42, 0.8);
            box-shadow:
                0 0 0 3px rgba(56, 189, 248, 0.1),
                0 8px 20px rgba(56, 189, 248, 0.15);
        }

        /* Mobile responsiveness */
        @media (max-width: 480px) {
            .verify-container {
                padding: 16px;
            }

            .verify-card {
                padding: 32px 20px;
            }

            .logo-section {
                margin-bottom: 30px;
            }

            .logo-section h1 {
                font-size: 24px;
            }

            .verify-card h2 {
                font-size: 20px;
            }

            .verify-card .subtitle {
                font-size: 13px;
            }

            .otp-input {
                padding: 12px 14px;
                font-size: 16px;
                letter-spacing: 6px;
            }

            .btn-verify {
                padding: 12px 20px;
                font-size: 14px;
            }

            .verify-wrapper {
                max-width: 100%;
            }

            .captcha-display {
                font-size: 22px;
                letter-spacing: 5px;
                padding: 12px 14px;
            }

            .captcha-refresh {
                width: 44px;
                min-width: 44px;
            }

            .captcha-refresh img {
                width: 18px;
                height: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="verify-container">
        <div class="verify-wrapper">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo-icon">✉️</div>
                <h1>CRYPTEXA</h1>
                <p>Secure your account now</p>
            </div>

            <!-- Verify Card -->
            <div class="verify-card">
                <h2>Verify Your Email</h2>
                <p class="subtitle">
                    Enter the 6-digit code we sent to your email address
                </p>

                <!-- Success Alert -->
                @if(session('success'))
                <div class="alert alert-success">
                    ✓ {{ session('success') }}
                </div>
                @endif

                <!-- Info Alert -->
                @if(session('info'))
                <div class="alert alert-success">
                    ℹ️ {{ session('info') }}
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

                <!-- Verification Form -->
                <form method="POST" action="{{ route('verify.post') }}" id="verifyForm">
                    @csrf
                    <!-- OTP Input -->
                    <div class="otp-section">
                        <label class="otp-label">Verification Code</label>
                        <input
                            type="text"
                            name="otp"
                            id="otpInput"
                            class="otp-input{{ $errors->has('otp') ? ' is-invalid' : '' }}"
                            placeholder="0 0 0 0 0 0"
                            maxlength="6"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            required
                            autocomplete="off">
                        @if($errors->has('otp'))
                        <span class="input-error">{{ $errors->first('otp') }}</span>
                        @endif
                    </div>

                    <!-- Verify Button -->
                    <button type="submit" class="btn-verify" id="verifyBtn">
                        Verify Email
                    </button>
                </form>

                <!-- Resend Section -->
                <div class="resend-section">
                    <p class="resend-text">Didn't receive the code?</p>
                    <form method="POST" action="{{ route('verify.resend') }}" id="resendForm" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-resend" id="resendBtn">
                            Resend Code
                        </button>
                        <span class="timer-badge" id="timerDisplay" style="display: none;">
                            <span id="timerValue">60</span>s
                        </span>
                    </form>
                    <p class="countdown-text" id="countdownText" style="display: none;">
                        You can resend in <span id="countdownValue">60</span> seconds
                    </p>
                </div>

                <!-- Back Link -->
                <div class="back-link">
                    <a href="{{ route('login') }}">← Back to Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Verify Page Scripts -->
    <script>
        const otpInput = document.getElementById('otpInput');
        const verifyForm = document.getElementById('verifyForm');
        const verifyBtn = document.getElementById('verifyBtn');
        const resendBtn = document.getElementById('resendBtn');
        const resendForm = document.getElementById('resendForm');
        const timerDisplay = document.getElementById('timerDisplay');
        const countdownText = document.getElementById('countdownText');
        const timerValue = document.getElementById('timerValue');
        const countdownValue = document.getElementById('countdownValue');

        // Only allow numbers in OTP input
        if (otpInput) {
            otpInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);

                // Add visual feedback
                if (this.value.length === 6) {
                    this.style.borderColor = 'rgba(56, 189, 248, 0.8)';
                } else {
                    this.style.borderColor = '';
                }
            });

            // Focus animation
            otpInput.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
            });

            otpInput.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        }

        // Form submission feedback
        if (verifyForm) {
            verifyForm.addEventListener('submit', function() {
                if (verifyBtn) {
                    verifyBtn.disabled = true;
                    verifyBtn.innerHTML = 'Verifying...';
                }
            });
        }

        // Resend cooldown timer
        function startResendCooldown(duration = 60) {
            let remaining = duration;

            resendBtn.disabled = true;
            timerDisplay.style.display = 'inline-block';
            countdownText.style.display = 'block';

            const interval = setInterval(function() {
                remaining--;
                timerValue.textContent = remaining;
                countdownValue.textContent = remaining;

                if (remaining <= 0) {
                    clearInterval(interval);
                    resendBtn.disabled = false;
                    timerDisplay.style.display = 'none';
                    countdownText.style.display = 'none';
                }
            }, 1000);

            // Store in localStorage to persist across page refreshes
            sessionStorage.setItem('resendCooldownEnd', Date.now() + (remaining * 1000));
        }

        // Check if cooldown is active on page load
        window.addEventListener('load', function() {
            const cooldownEnd = sessionStorage.getItem('resendCooldownEnd');
            if (cooldownEnd) {
                const remaining = Math.ceil((cooldownEnd - Date.now()) / 1000);
                if (remaining > 0) {
                    startResendCooldown(remaining);
                } else {
                    sessionStorage.removeItem('resendCooldownEnd');
                }
            }
        });

        // Resend form submission
        if (resendForm) {
            resendForm.addEventListener('submit', function(e) {
                startResendCooldown(60);
            });
        }

        // Auto-focus OTP input
        if (otpInput) {
            otpInput.focus();
        }

        // Captcha generation
        function generateCaptcha() {}

        // Generate captcha on page load
        window.addEventListener('load', generateCaptcha);
    </script>

</body>

</html>