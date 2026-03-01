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

    <title>Login | CRYPTEXA</title>
</head>

<body>
    <!-- Language Selector Button -->
    <button onclick="toggleLanguageSelector()" style="position: fixed; top: 20px; right: 20px; z-index: 1000; width: 44px; height: 44px; padding: 0; background: linear-gradient(135deg, rgba(56,189,248,0.15) 0%, rgba(56,189,248,0.08) 100%); backdrop-filter: blur(10px); border: 1px solid rgba(56,189,248,0.3); border-radius: 12px; color: #38bdf8; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.3);" onmouseover="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.25) 0%, rgba(56,189,248,0.15) 100%)'; this.style.borderColor='rgba(56,189,248,0.5)'; this.style.transform='scale(1.05)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15) 0%, rgba(56,189,248,0.08) 100%)'; this.style.borderColor='rgba(56,189,248,0.3)'; this.style.transform='scale(1)';">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <line x1="2" y1="12" x2="22" y2="12"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
        </svg>
    </button>
    
    <div class="login-container">
        <div class="login-wrapper">
            <!-- Logo Section -->
            <div class="logo-section">
                <!-- <div class="logo-icon">💎</div> -->
                <h1>CRYPTEXA</h1>
                <p>{{ __t('welcome_back') }}</p>
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
                    <!-- Username Field -->
                    <div class="form-group">
                        <label class="form-label">{{ __t('username') }}</label>
                        <input
                            type="text"
                            name="username"
                            value="{{ old('username') }}"
                            class="form-input{{ $errors->has('username') ? ' is-invalid' : '' }}"
                            placeholder="{{ __t('username') }}"
                            required
                            autocomplete="username">
                        @if($errors->has('username'))
                        <span class="input-error">{{ $errors->first('username') }}</span>
                        @endif
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label class="form-label">{{ __t('password') }}</label>
                        <div class="input-group">
                            <input
                                type="password"
                                name="password"
                                class="form-input{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                placeholder="{{ __t('password') }}"
                                required
                                autocomplete="current-password"
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
                        <a href="/forgot-password" class="forgot-link">{{ __t('forgot_password') }}</a>
                        <label style="color: rgba(226, 232, 240, 0.6); font-weight: 500; display: flex; align-items: center; gap: 6px; cursor: pointer;">
                            <input type="checkbox" name="remember" style="cursor: pointer; accent-color: #38bdf8;">
                            {{ __t('remember_me') }}
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn-login" id="loginBtn">
                        {{ __t('sign_in') }}
                    </button>

                    <!-- Sign Up Link -->
                    <div class="signup-link">
                        {{ __t('dont_have_account') }}
                        <a href="{{ route('register') }}">{{ __t('create_one') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Language Selector Script -->
    <script>
        function toggleLanguageSelector() {
            Swal.fire({
                title: '🌍 Select Language',
                html: `
                    <div style="display: grid; gap: 8px; text-align: left; max-height: 400px; overflow-y: auto;">
                        <button onclick="changeLanguage('en')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 10px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; font-size: 14px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.08))'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05))'">
                            <span style="font-size: 24px;">🇬🇧</span>
                            <span style="font-weight: 600;">English</span>
                        </button>
                        <button onclick="changeLanguage('es')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 10px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; font-size: 14px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.08))'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05))'">
                            <span style="font-size: 24px;">🇪🇸</span>
                            <span style="font-weight: 600;">Español</span>
                        </button>
                        <button onclick="changeLanguage('fr')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 10px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; font-size: 14px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.08))'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05))'">
                            <span style="font-size: 24px;">🇫🇷</span>
                            <span style="font-weight: 600;">Français</span>
                        </button>
                        <button onclick="changeLanguage('de')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 10px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; font-size: 14px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.08))'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05))'">
                            <span style="font-size: 24px;">🇩🇪</span>
                            <span style="font-weight: 600;">Deutsch</span>
                        </button>
                        <button onclick="changeLanguage('zh')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 10px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; font-size: 14px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.08))'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05))'">
                            <span style="font-size: 24px;">🇨🇳</span>
                            <span style="font-weight: 600;">中文</span>
                        </button>
                        <button onclick="changeLanguage('ja')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 10px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; font-size: 14px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.08))'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05))'">
                            <span style="font-size: 24px;">🇯🇵</span>
                            <span style="font-weight: 600;">日本語</span>
                        </button>
                        <button onclick="changeLanguage('ko')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 10px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; font-size: 14px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.08))'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05))'">
                            <span style="font-size: 24px;">🇰🇷</span>
                            <span style="font-weight: 600;">한국어</span>
                        </button>
                        <button onclick="changeLanguage('pt')" style="padding: 12px; background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); border-radius: 10px; color: #e5e7eb; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; font-size: 14px;" onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.08))'" onmouseout="this.style.borderColor='rgba(56,189,248,0.2)'; this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05))'">
                            <span style="font-size: 24px;">🇧🇷</span>
                            <span style="font-weight: 600;">Português</span>
                        </button>
                    </div>
                `,
                background: 'linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(30,41,59,0.95) 100%)',
                color: '#e5e7eb',
                showConfirmButton: false,
                showCloseButton: true,
                width: '400px',
                padding: '20px',
                backdrop: 'rgba(0,0,0,0.8)'
            });
        }

        function changeLanguage(lang) {
            fetch('/language/change', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ language: lang })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Language Changed!',
                        text: 'Language preference saved',
                        background: 'linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(30,41,59,0.95) 100%)',
                        color: '#e5e7eb',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to change language',
                    background: 'linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(30,41,59,0.95) 100%)',
                    color: '#e5e7eb'
                });
            });
        }
    </script>

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