<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    <link rel="shortcut icon" href="{{ asset('images/logo/logo.png') }}" />
    <title>Reset Password | CRYPTEXA</title>
</head>
<body>
    <div class="login-container">
        <div class="login-wrapper">
            <div class="logo-section">
                <img src="{{ asset('images/logo/logo.png') }}" alt="CRYPTEXA Logo" class="logo-icon">
                <p>Create a new password</p>
            </div>
            <div class="login-card">
                @if(session('success'))
                <div class="alert alert-success">✓ {{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">✗ {{ session('error') }}</div>
                @endif
                @if($errors->any())
                <div class="validation-errors">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <div style="text-align: center; margin-bottom: 24px;">
                    <div style="width: 60px; height: 60px; margin: 0 auto 16px; background: linear-gradient(135deg, rgba(34,197,94,0.15) 0%, rgba(34,197,94,0.05) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 28px;">🔑</div>
                    <h2 style="color: #e5e7eb; font-size: 22px; font-weight: 700; margin: 0 0 8px 0;">Reset Password</h2>
                    <p style="color: rgba(226, 232, 240, 0.6); font-size: 13px; margin: 0;">Enter your new password below</p>
                </div>
                <form method="POST" action="{{ route('reset.password.post') }}" id="resetForm">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-input" placeholder="Enter new password" required id="passwordInput">
                            <button type="button" class="input-icon" id="togglePassword"><span>👁️</span></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm new password" required id="confirmPasswordInput">
                            <button type="button" class="input-icon" id="toggleConfirmPassword"><span>👁️</span></button>
                        </div>
                    </div>
                    <button type="submit" class="btn-login" id="resetBtn">Reset Password</button>
                    <div class="signup-link"><a href="{{ route('login') }}">Back to Login</a></div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $('#togglePassword').click(function(e) {
            e.preventDefault();
            const input = $('#passwordInput');
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            $(this).find('span').text(type === 'password' ? '👁️' : '👁️🗨️');
        });
        $('#toggleConfirmPassword').click(function(e) {
            e.preventDefault();
            const input = $('#confirmPasswordInput');
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            $(this).find('span').text(type === 'password' ? '👁️' : '👁️🗨️');
        });
        $('#resetForm').submit(function() {
            $('#resetBtn').prop('disabled', true).text('Resetting...');
        });
    </script>
</body>
</html>
