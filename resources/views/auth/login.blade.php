<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/logo/logo.png') }}" />
    <title>Login | CRYPTEXA</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;background:linear-gradient(135deg,#0f172a 0%,#1a1f3a 50%,#0d1726 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;position:relative;overflow-x:hidden;margin:0}
        body::before{content:'';position:fixed;top:-50%;left:-50%;width:200%;height:200%;background:radial-gradient(circle at 20% 50%,rgba(56,189,248,0.08) 0%,transparent 50%),radial-gradient(circle at 80% 80%,rgba(34,211,238,0.05) 0%,transparent 50%);animation:moveGradient 15s ease infinite;z-index:1;pointer-events:none}
        @keyframes moveGradient{0%,100%{transform:translate(0,0)}50%{transform:translate(50px,50px)}}
        body::after{content:'';position:fixed;bottom:-100px;left:-100px;width:300px;height:300px;background:radial-gradient(circle,rgba(56,189,248,0.1) 0%,transparent 70%);border-radius:50%;animation:float 6s ease-in-out infinite;z-index:1;pointer-events:none}
        @keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-30px)}}
        .lang-btn{position:fixed;top:20px;right:20px;z-index:1000;width:48px;height:48px;background:rgba(255,255,255,0.1);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.2);border-radius:12px;color:#fff;cursor:pointer;transition:.3s;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 32px rgba(0,0,0,0.3)}
        .lang-btn:hover{background:rgba(255,255,255,0.15);transform:translateY(-2px);box-shadow:0 12px 40px rgba(0,0,0,0.4)}
        .login-container{width:100%;max-width:440px;position:relative;z-index:1}
        .login-card{background:linear-gradient(135deg,rgba(15,23,42,0.8),rgba(30,41,59,0.8));backdrop-filter:blur(20px);border:1px solid rgba(56,189,248,0.2);border-radius:24px;padding:32px 24px;box-shadow:0 20px 60px rgba(0,0,0,0.4),inset 0 1px 1px rgba(255,255,255,0.1);animation:fadeIn 0.8s ease-out 0.2s both}
        @keyframes fadeIn{from{opacity:0}to{opacity:1}}
        .logo-section{text-align:center;margin-bottom:40px}
        .logo-icon{width:60px;height:60px;margin:0 auto 15px;background:linear-gradient(135deg,#38bdf8,#22d3ee);border-radius:15px;display:flex;align-items:center;justify-content:center;font-size:32px;box-shadow:0 10px 30px rgba(56,189,248,0.3);animation:bounce 2s ease-in-out infinite}
        @keyframes bounce{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
        .logo-section h1{font-size:28px;font-weight:700;background:linear-gradient(135deg,#38bdf8,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:8px;letter-spacing:-0.5px}
        .logo-section p{color:rgba(255,255,255,0.6);font-size:15px;font-weight:500}
        .alert{padding:16px 20px;border-radius:12px;margin-bottom:24px;font-size:14px;font-weight:500;display:flex;align-items:center;gap:10px}
        .alert-success{background:rgba(34,197,94,0.15);border:1px solid rgba(34,197,94,0.3);color:#4ade80}
        .alert-danger{background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.3);color:#f87171}
        .form-group{margin-bottom:24px}
        .form-label{display:block;color:rgba(255,255,255,0.9);font-size:14px;font-weight:600;margin-bottom:10px;letter-spacing:0.3px}
        .form-input{width:100%;padding:12px 14px;background:rgba(15,23,42,0.7);border:1.5px solid rgba(56,189,248,0.2);border-radius:12px;color:rgb(226,232,240);font-size:14px;transition:all .3s;font-weight:500}
        .form-input:focus{outline:0;border-color:rgba(56,189,248,0.8);background:rgba(15,23,42,0.9);box-shadow:0 0 0 3px rgba(56,189,248,0.1),0 10px 25px rgba(56,189,248,0.2)}
        .form-input::placeholder{color:rgba(255,255,255,0.4)}
        .input-group{position:relative}
        .input-icon{position:absolute;right:16px;top:50%;transform:translateY(-50%);background:none;border:none;color:rgba(255,255,255,0.5);cursor:pointer;font-size:20px;transition:.3s;padding:8px}
        .input-icon:hover{color:#38bdf8}
        .captcha-wrapper{display:flex;gap:12px;align-items:center;margin-bottom:12px}
        .captcha-display{flex:1;background:linear-gradient(135deg,rgba(56,189,248,0.15),rgba(34,211,238,0.15));border:2px solid rgba(56,189,248,0.3);border-radius:12px;padding:20px;font-size:32px;font-weight:800;letter-spacing:10px;color:#38bdf8;user-select:none;font-family:'Courier New',monospace;text-align:center;text-shadow:0 2px 10px rgba(56,189,248,0.5)}
        .captcha-refresh{width:56px;height:56px;background:rgba(56,189,248,0.15);border:2px solid rgba(56,189,248,0.3);border-radius:12px;color:#38bdf8;cursor:pointer;transition:.3s;font-size:24px;display:flex;align-items:center;justify-content:center}
        .captcha-refresh:hover{background:rgba(56,189,248,0.25);transform:rotate(180deg)}
        .forgot-remember{display:flex;justify-content:space-between;align-items:center;margin-bottom:28px}
        .forgot-link{color:#38bdf8;text-decoration:none;font-size:14px;font-weight:600;transition:.3s}
        .forgot-link:hover{color:#8b5cf6}
        .remember-label{color:rgba(255,255,255,0.7);font-size:14px;font-weight:500;display:flex;align-items:center;gap:8px;cursor:pointer}
        .remember-label input{cursor:pointer;accent-color:#38bdf8;width:18px;height:18px}
        .btn-login{width:100%;padding:14px 24px;background:linear-gradient(135deg,#38bdf8,#22d3ee);border:none;border-radius:12px;color:#020617;font-size:15px;font-weight:600;cursor:pointer;transition:.3s;box-shadow:0 10px 30px rgba(56,189,248,0.3);letter-spacing:0.5px;position:relative;overflow:hidden}
        .btn-login::before{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.2),transparent);transition:left .5s}
        .btn-login:hover::before{left:100%}
        .btn-login:hover{transform:translateY(-2px);box-shadow:0 15px 40px rgba(56,189,248,0.4)}
        .btn-login:active{transform:translateY(0)}
        .btn-login:disabled{opacity:0.6;cursor:not-allowed;transform:none}
        .signup-link{text-align:center;margin-top:28px;color:rgba(255,255,255,0.6);font-size:14px;font-weight:500}
        .signup-link a{color:#38bdf8;text-decoration:none;font-weight:700;transition:.3s}
        .signup-link a:hover{color:#8b5cf6}
        .input-error{display:block;color:#f87171;font-size:13px;margin-top:8px;font-weight:500}
        @media(max-width:768px){
            .login-card{padding:24px 20px}
            .logo-icon{width:60px;height:60px;font-size:32px}
            .logo-section h1{font-size:24px}
            .captcha-display{font-size:24px;letter-spacing:6px;padding:16px}
            .captcha-refresh{width:48px;height:48px;font-size:20px}
            .form-input{padding:11px 12px;font-size:16px}
            .btn-login{padding:12px 20px;font-size:14px}
        }
    </style>
</head>
<body>
    <button class="lang-btn" onclick="toggleLanguageSelector()" title="Change Language">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <line x1="2" y1="12" x2="22" y2="12"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
        </svg>
    </button>

    <div class="login-container">
        <div class="login-card">
            <div class="logo-section">
                <!-- <div class="logo-icon">💎</div> -->
                <h1>CRYPTEXA</h1>
                <p>{{ __t('welcome_back') }}</p>
            </div>
                @if(session('success'))
                <div class="alert alert-success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    {{ session('error') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    <div>
                        @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                        @endforeach
                    </div>
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

                    <div class="form-group">
                        <label class="form-label">{{ __t('verify_human') ?? 'Verify You\'re Human' }}</label>
                        <div class="captcha-wrapper">
                            <div id="captchaDisplay" class="captcha-display"></div>
                            <button type="button" onclick="generateCaptcha()" class="captcha-refresh" title="Refresh captcha">🔄</button>
                        </div>
                        <input
                            type="text"
                            name="captcha"
                            id="captchaInput"
                            class="form-input"
                            placeholder="{{ __t('enter_code') ?? 'Enter the code above' }}"
                            required
                            autocomplete="off"
                            maxlength="6"
                            style="text-transform:uppercase;letter-spacing:4px;font-weight:700">
                        <input type="hidden" name="captcha_token" id="captchaToken">
                        @if($errors->has('captcha'))
                        <span class="input-error">{{ $errors->first('captcha') }}</span>
                        @endif
                    </div>

                    <div class="forgot-remember">
                        <a href="/forgot-password" class="forgot-link">{{ __t('forgot_password') }}</a>
                        <label class="remember-label">
                            <input type="checkbox" name="remember">
                            {{ __t('remember_me') }}
                        </label>
                    </div>

                    <button type="submit" class="btn-login" id="loginBtn">
                        {{ __t('sign_in') }}
                    </button>

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
        // Captcha generation
        function generateCaptcha() {
            const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
            let captcha = '';
            for (let i = 0; i < 6; i++) {
                captcha += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('captchaDisplay').textContent = captcha;
            document.getElementById('captchaToken').value = captcha;
            document.getElementById('captchaInput').value = '';
        }

        // Generate captcha on page load
        window.addEventListener('load', generateCaptcha);

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