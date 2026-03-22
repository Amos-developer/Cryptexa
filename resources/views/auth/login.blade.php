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
        .login-card{background:linear-gradient(135deg,rgba(15,23,42,0.85),rgba(30,41,59,0.85));backdrop-filter:blur(20px);border:1px solid rgba(56,189,248,0.25);border-radius:20px;padding:28px 24px;box-shadow:0 20px 60px rgba(0,0,0,0.4),inset 0 1px 1px rgba(255,255,255,0.08);animation:fadeIn 0.8s ease-out 0.2s both}
        @keyframes fadeIn{from{opacity:0}to{opacity:1}}
        .logo-section{text-align:center;margin-bottom:40px}
        .logo-icon{width:56px;height:56px;margin:0 auto 12px;background:linear-gradient(135deg,#38bdf8,#22d3ee);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:28px;box-shadow:0 8px 24px rgba(56,189,248,0.3);animation:bounce 2s ease-in-out infinite}
        @keyframes bounce{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
        .logo-section h1{font-size:26px;font-weight:700;background:linear-gradient(135deg,#38bdf8,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin:0 0 6px 0;letter-spacing:-0.5px}
        .logo-section p{color:rgba(226,232,240,0.65);font-size:14px;font-weight:400;margin:0}
        .alert{padding:14px 16px;border-radius:14px;margin-bottom:20px;font-size:14px;font-weight:500;display:flex;align-items:center;gap:10px}
        .alert-success{background:rgba(34,197,94,0.15);border:1px solid rgba(34,197,94,0.3);color:#86efac}
        .alert-danger{background:rgba(239,68,68,0.15);border:1px solid rgba(239,68,68,0.3);color:#fca5a5}
        .form-group{margin-bottom:20px}
        .form-label{display:block;color:rgb(226,232,240);font-size:13px;font-weight:600;margin-bottom:8px;letter-spacing:0.2px}
        .form-label .required{color:#fca5a5}
        .form-input{width:100%;padding:13px 16px;background:rgba(15,23,42,0.6);border:1.5px solid rgba(56,189,248,0.25);border-radius:14px;color:rgb(226,232,240);font-size:15px;transition:all .3s}
        .form-input:focus{outline:0;border-color:rgba(56,189,248,0.6);background:rgba(15,23,42,0.8);box-shadow:0 0 0 4px rgba(56,189,248,0.12),0 8px 20px rgba(56,189,248,0.15)}
        .form-input::placeholder{color:rgba(226,232,240,0.5)}
        .input-group{position:relative}
        .input-icon{position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:rgba(56,189,248,0.5);cursor:pointer;font-size:16px;transition:.3s;padding:0;display:flex;align-items:center;justify-content:center;width:36px;height:36px}
        .input-icon:hover{color:#38bdf8}
        .form-input:focus~.input-icon{color:#38bdf8}
        .forgot-remember{display:flex;justify-content:space-between;align-items:center;margin-bottom:28px}
        .forgot-link{color:#38bdf8;text-decoration:none;font-size:14px;font-weight:600;transition:.3s}
        .forgot-link:hover{color:#22d3ee;text-decoration:underline}
        .remember-label{color:rgba(226,232,240,0.65);font-size:14px;font-weight:500;display:flex;align-items:center;gap:8px;cursor:pointer}
        .remember-label input{cursor:pointer;accent-color:#38bdf8;width:18px;height:18px}
        .btn-login{width:100%;padding:15px 24px;background:linear-gradient(135deg,#38bdf8,#22d3ee);border:none;border-radius:14px;color:#020617;font-size:15px;font-weight:700;cursor:pointer;transition:.3s;box-shadow:0 8px 24px rgba(56,189,248,0.35);letter-spacing:0.3px;position:relative;overflow:hidden}
        .btn-login::before{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.2),transparent);transition:left .5s}
        .btn-login:hover::before{left:100%}
        .btn-login:hover{transform:translateY(-2px);box-shadow:0 15px 40px rgba(56,189,248,0.4)}
        .btn-login:active{transform:translateY(0)}
        .btn-login:disabled{opacity:0.6;cursor:not-allowed;transform:none}
        .signup-link{text-align:center;margin-top:28px;color:rgba(226,232,240,0.65);font-size:14px;font-weight:500}
        .signup-link a{color:#38bdf8;text-decoration:none;font-weight:600;transition:.3s}
        .signup-link a:hover{color:#22d3ee;text-decoration:underline}
        .input-error{display:block;color:#fca5a5;font-size:12px;margin-top:5px;font-weight:500}
        @media(max-width:480px){
            .login-card{padding:24px 20px;border-radius:18px}
            .logo-icon{width:56px;height:56px;font-size:28px}
            .logo-section h1{font-size:24px}
            .logo-section p{font-size:13px}
            .form-input{padding:12px 14px;font-size:16px;border-radius:12px}
            .form-group{margin-bottom:18px}
            .form-label{font-size:13px}
            .btn-login{padding:14px 20px;font-size:15px;border-radius:12px}
        }
        @media(min-width:481px) and (max-width:768px){
            .login-card{padding:32px 28px}
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
                    <div class="form-group">
                        <label class="form-label">{{ __t('username') }}<span class="required">*</span></label>
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

                    <div class="form-group">
                        <label class="form-label">{{ __t('password') }}<span class="required">*</span></label>
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
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        @if($errors->has('password'))
                        <span class="input-error">{{ $errors->first('password') }}</span>
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

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function(e) {
                e.preventDefault();
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                if (type === 'password') {
                    this.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
                } else {
                    this.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
                }
            });
        }

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

        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
            });
            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });

        window.addEventListener('load', function() {
            if (passwordInput) {
                passwordInput.setAttribute('autocomplete', 'new-password');
            }
        });
    </script>

</body>

</html>
