<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo/48.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/logo/48.png') }}">
    <title>Login | CRYPTEXA</title>
    <style>
        :root {
            --panel: rgba(8, 19, 35, .9);
            --line: rgba(106, 227, 255, .18);
            --line2: rgba(106, 227, 255, .38);
            --text: #e8f0ff;
            --muted: rgba(232, 240, 255, .66);
            --accent: #6ae3ff;
            --accent2: #1bb8f2;
            --success: #2dd4bf;
            --danger: #fb7185
        }

        * {
            box-sizing: border-box
        }

        html,
        body {
            min-height: 100%
        }

        body {
            margin: 0;
            font-family: "Sora", "Segoe UI", sans-serif;
            color: var(--text);
            background: radial-gradient(circle at top left, rgba(27, 184, 242, .18), transparent 30%), radial-gradient(circle at bottom right, rgba(45, 212, 191, .12), transparent 24%), linear-gradient(180deg, #06101d 0%, #07111f 48%, #0a1422 100%);
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            overflow-x: hidden
        }

        .page {
            min-height: 100vh;
            padding: 1rem;
            position: relative;
            display: flex;
            align-items: center
        }

        .nav-btn,
        .lang-btn {
            position: fixed;
            top: 1rem;
            z-index: 5;
            width: 3rem;
            height: 3rem;
            border: 1px solid var(--line2);
            border-radius: 1rem;
            background: linear-gradient(180deg, rgba(10, 24, 42, .96), rgba(7, 18, 34, .92));
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 16px 34px rgba(0, 0, 0, .32), inset 0 1px 0 rgba(255, 255, 255, .06);
            transition: border-color .2s ease, transform .2s ease, background .2s ease
        }

        .nav-btn {
            left: 1rem;
            color: var(--accent)
        }

        .lang-btn {
            right: 1rem
        }

        .nav-btn:hover,
        .lang-btn:hover {
            transform: translateY(-1px);
            border-color: rgba(106, 227, 255, .58);
            background: linear-gradient(180deg, rgba(11, 27, 48, .98), rgba(8, 20, 37, .96))
        }

        .nav-btn span {
            display: block;
            color: var(--accent);
            font-size: 2rem;
            line-height: .8;
            font-weight: 700;
            transform: translateX(-1px)
        }

        .lang-btn img {
            width: 1.15rem;
            height: 1.15rem;
            display: block;
            opacity: .92;
            filter: brightness(0) saturate(100%) invert(83%) sepia(31%) saturate(864%) hue-rotate(159deg) brightness(103%) contrast(103%)
        }

        .layout {
            max-width: 640px;
            margin: 0 auto;
            display: grid;
            gap: 1rem;
            padding-top: 4.25rem;
            width: 100%
        }

        .card {
            margin-top: -20px;
            border: 1px solid var(--line);
            border-radius: 1.5rem;
            background: linear-gradient(180deg, rgba(10, 20, 36, .94), var(--panel));
            box-shadow: 0 24px 70px rgba(0, 0, 0, .42);
            position: relative;
            overflow: hidden;
            padding: 1.25rem
        }

        .card:before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(106, 227, 255, .08), transparent 28%, transparent 70%, rgba(45, 212, 191, .05));
            pointer-events: none
        }

        .top,
        .brand,
        .eyebrow,
        .field-label,
        .remember-row,
        .checkline {
            display: flex
        }

        .top,
        .field-label,
        .remember-row {
            justify-content: space-between
        }

        .top,
        .brand,
        .eyebrow,
        .remember-row,
        .checkline {
            align-items: center
        }

        .brand {
            gap: .85rem
        }

        .mark {
            width: 2.9rem;
            height: 2.9rem;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(106, 227, 255, .22), rgba(27, 184, 242, .3));
            border: 1px solid rgba(106, 227, 255, .32)
        }

        .brand h1 {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: .16em
        }

        .brand p,
        .sub,
        .field-label small,
        .login-link,
        .forgot-link,
        .input-error,
        .errs p {
            color: var(--muted)
        }

        .brand p {
            margin: .18rem 0 0;
            font-size: .75rem;
            letter-spacing: .08em;
            text-transform: uppercase
        }

        .badge,
        .eyebrow {
            padding: .45rem .7rem;
            border-radius: 999px;
            font-size: .72rem
        }

        .badge {
            border: 1px solid rgba(45, 212, 191, .28);
            background: rgba(45, 212, 191, .08);
            color: #96f7df
        }

        .eyebrow {
            gap: .45rem;
            background: rgba(106, 227, 255, .08);
            border: 1px solid rgba(106, 227, 255, .18);
            color: #b7f4ff;
            text-transform: uppercase;
            letter-spacing: .08em;
            display: inline-flex;
            margin-bottom: .8rem
        }

        .hero-title {
            margin: .25rem 0;
            font-size: clamp(1.7rem, 7vw, 2.2rem);
            line-height: 1.02;
            letter-spacing: -.05em
        }

        .sub {
            margin: 0;
            line-height: 1.5;
            font-size: .92rem
        }

        .top-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: .65rem;
            margin: .9rem 0 1rem
        }

        .strip-item {
            padding: .7rem;
            border-radius: 1rem;
            background: rgba(255, 255, 255, .03);
            border: 1px solid rgba(255, 255, 255, .04)
        }

        .strip-item span {
            display: block;
            font-size: .66rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: .2rem;
            color: var(--muted)
        }

        .strip-item strong {
            font-size: .85rem
        }

        .alert,
        .errs {
            position: relative;
            z-index: 1;
            border-radius: 1rem;
            padding: .9rem 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            font-size: .88rem
        }

        .alert-success {
            background: rgba(45, 212, 191, .1);
            color: #99f6e4;
            border-color: rgba(45, 212, 191, .25)
        }

        .alert-danger,
        .errs {
            background: rgba(251, 113, 133, .1);
            border-color: rgba(251, 113, 133, .24);
            color: #fecdd3
        }

        .errs p {
            margin: .22rem 0;
            color: #fecdd3
        }

        form {
            display: grid;
            gap: .95rem;
            position: relative;
            z-index: 1
        }

        .field {
            display: grid;
            gap: .45rem
        }

        .field-label {
            gap: .75rem;
            font-size: .82rem;
            font-weight: 600;
            letter-spacing: .04em;
            text-transform: uppercase;
            color: rgba(232, 240, 255, .88)
        }

        .required {
            color: var(--danger)
        }

        .input-wrap {
            position: relative
        }

        .input-wrap.has-btn input {
            padding-right: 3.4rem
        }

        input {
            width: 100%;
            min-height: 3.5rem;
            padding: .95rem 1rem;
            border-radius: 1rem;
            border: 1px solid rgba(106, 227, 255, .18);
            background: rgba(6, 16, 30, .86);
            color: var(--text);
            font-size: 1rem
        }

        .is-invalid {
            border-color: rgba(251, 113, 133, .52)
        }

        input::placeholder {
            color: rgba(232, 240, 255, .34)
        }

        input:focus {
            outline: none;
            border-color: rgba(106, 227, 255, .56);
            background: rgba(8, 21, 39, .95);
            box-shadow: 0 0 0 4px rgba(106, 227, 255, .08)
        }

        .toggle {
            position: absolute;
            top: 50%;
            right: .7rem;
            transform: translateY(-50%);
            width: 2.35rem;
            height: 2.35rem;
            border: 0;
            border-radius: .85rem;
            background: transparent;
            color: rgba(232, 240, 255, .6);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color .2s ease, background .2s ease
        }

        .toggle:hover,
        .toggle.is-active {
            color: var(--accent);
            background: rgba(106, 227, 255, .08)
        }

        .checkline {
            gap: .6rem;
            color: rgba(232, 240, 255, .9);
            font-size: .82rem
        }

        .checkline input {
            width: 1.05rem;
            height: 1.05rem;
            min-height: auto;
            margin: 0;
            accent-color: var(--accent2)
        }

        .remember-row {
            gap: 1rem;
            margin-top: .1rem
        }

        .forgot-link {
            font-size: .82rem;
            text-decoration: none
        }

        .forgot-link:hover,
        .login-link a:hover {
            color: #aef2ff
        }

        a {
            color: var(--accent);
            text-decoration: none
        }

        .submit {
            width: 100%;
            min-height: 3.6rem;
            border: 0;
            border-radius: 1.05rem;
            background: linear-gradient(135deg, #74ebff 0%, #1bb8f2 52%, #16a5d7 100%);
            color: #03101d;
            font-size: .96rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            box-shadow: 0 18px 40px rgba(27, 184, 242, .28)
        }

        .login-link {
            text-align: center;
            font-size: .9rem
        }

        @media (min-width:768px) {
            .page {
                padding: 1.5rem
            }

            .layout {
                max-width: 720px;
                padding-top: 4.75rem
            }

            .card {
                padding: 1.5rem
            }
        }
    </style>
</head>

<body>
    <button type="button" class="nav-btn" onclick="goBack()" aria-label="Go back" title="Go back">
        <span aria-hidden="true">&#8249;</span>
    </button>
    <button type="button" class="lang-btn" onclick="toggleLanguageSelector()" aria-label="Select language">
        <img src="{{ asset('images/icons/globe.svg') }}" alt="" aria-hidden="true">
    </button>

    <main class="page">
        <section class="layout">
            <section class="card">
                <div class="top">
                    <div class="brand">
                        <div class="mark">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 14l4-4 3 3 7-7"></path>
                                <path d="M17 6h2v2"></path>
                                <path d="M4 19h16"></path>
                            </svg>
                        </div>
                        <div>
                            <h1>CRYPTEXA</h1>
                            <p>Pro Trader Access</p>
                        </div>
                    </div>
                    <div class="badge">Secure login</div>
                </div>

                <div class="head">
                    <div class="eyebrow">Sign in</div>
                    <h2 class="hero-title">Access account</h2>
                    <p class="sub">Trading dashboard login.</p>
                </div>

                <div class="top-strip">
                    <div class="strip-item"><span>Status</span><strong>Active</strong></div>
                    <div class="strip-item"><span>Access</span><strong>Secure</strong></div>
                    <div class="strip-item"><span>Next</span><strong>Trade</strong></div>
                </div>

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if($errors->any())
                <div class="errs">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" id="loginForm">
                    @csrf

                    <div class="field">
                        <label class="field-label" for="username"><span>{{ __t('username') }} <span class="required">*</span></span></label>
                        <div class="input-wrap">
                            <input id="username" type="text" name="username" value="{{ old('username') }}" class="{{ $errors->has('username') ? 'is-invalid' : '' }}" placeholder="Enter your username" autocomplete="username" required>
                        </div>
                        @if($errors->has('username'))<span class="input-error">{{ $errors->first('username') }}</span>@endif
                    </div>

                    <div class="field">
                        <label class="field-label" for="passwordInput"><span>{{ __t('password') }} <span class="required">*</span></span></label>
                        <div class="input-wrap has-btn">
                            <input id="passwordInput" type="password" name="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Enter your password" autocomplete="current-password" required>
                            <button type="button" class="toggle" id="togglePassword" aria-label="Show password" title="Show password">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        @if($errors->has('password'))<span class="input-error">{{ $errors->first('password') }}</span>@endif
                    </div>

                    <div class="remember-row">
                        <label class="checkline" for="rememberMe">
                            <input type="checkbox" id="rememberMe" name="remember">
                            <span>{{ __t('remember_me') }}</span>
                        </label>
                        <a href="/forgot-password" class="forgot-link">{{ __t('forgot_password') }}</a>
                    </div>

                    <button type="submit" class="submit" id="loginBtn">{{ __t('sign_in') }}</button>

                    <div class="login-link">
                        {{ __t('dont_have_account') }}
                        <a href="{{ route('register') }}">{{ __t('create_one') }}</a>
                    </div>
                </form>
            </section>
        </section>
    </main>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function goBack() {
            if (window.history.length > 1) {
                window.history.back()
            } else {
                window.location.href = '{{ url('/') }}'
            }
        }
        function toggleLanguageSelector() {
            Swal.fire({
                title: 'Select Language',
                html: `<div style="display:grid;gap:8px;text-align:left;max-height:400px;overflow-y:auto;"><button onclick="changeLanguage('en')" style="padding:12px;background:linear-gradient(135deg, rgba(106,227,255,.1), rgba(27,184,242,.05));border:1px solid rgba(106,227,255,.18);border-radius:12px;color:#e5e7eb;cursor:pointer;">English</button><button onclick="changeLanguage('es')" style="padding:12px;background:linear-gradient(135deg, rgba(106,227,255,.1), rgba(27,184,242,.05));border:1px solid rgba(106,227,255,.18);border-radius:12px;color:#e5e7eb;cursor:pointer;">Espanol</button><button onclick="changeLanguage('fr')" style="padding:12px;background:linear-gradient(135deg, rgba(106,227,255,.1), rgba(27,184,242,.05));border:1px solid rgba(106,227,255,.18);border-radius:12px;color:#e5e7eb;cursor:pointer;">Francais</button><button onclick="changeLanguage('de')" style="padding:12px;background:linear-gradient(135deg, rgba(106,227,255,.1), rgba(27,184,242,.05));border:1px solid rgba(106,227,255,.18);border-radius:12px;color:#e5e7eb;cursor:pointer;">Deutsch</button><button onclick="changeLanguage('zh')" style="padding:12px;background:linear-gradient(135deg, rgba(106,227,255,.1), rgba(27,184,242,.05));border:1px solid rgba(106,227,255,.18);border-radius:12px;color:#e5e7eb;cursor:pointer;">Chinese</button><button onclick="changeLanguage('ja')" style="padding:12px;background:linear-gradient(135deg, rgba(106,227,255,.1), rgba(27,184,242,.05));border:1px solid rgba(106,227,255,.18);border-radius:12px;color:#e5e7eb;cursor:pointer;">Japanese</button><button onclick="changeLanguage('ko')" style="padding:12px;background:linear-gradient(135deg, rgba(106,227,255,.1), rgba(27,184,242,.05));border:1px solid rgba(106,227,255,.18);border-radius:12px;color:#e5e7eb;cursor:pointer;">Korean</button><button onclick="changeLanguage('pt')" style="padding:12px;background:linear-gradient(135deg, rgba(106,227,255,.1), rgba(27,184,242,.05));border:1px solid rgba(106,227,255,.18);border-radius:12px;color:#e5e7eb;cursor:pointer;">Portugues</button></div>`,
                background: 'linear-gradient(180deg, rgba(8,21,39,.98), rgba(8,18,33,.98))',
                color: '#e5e7eb',
                showConfirmButton: false,
                showCloseButton: true,
                width: '400px',
                padding: '20px',
                backdrop: 'rgba(0,0,0,.8)'
            })
        }

        function changeLanguage(lang) {
            fetch('/language/change', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    language: lang
                })
            }).then(r => r.json()).then(d => {
                if (d.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Language Changed',
                        text: 'Language preference saved',
                        background: 'linear-gradient(180deg, rgba(8,21,39,.98), rgba(8,18,33,.98))',
                        color: '#e5e7eb',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => window.location.reload())
                }
            }).catch(() => Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to change language',
                background: 'linear-gradient(180deg, rgba(8,21,39,.98), rgba(8,18,33,.98))',
                color: '#e5e7eb'
            }))
        }
        const togglePassword = document.getElementById('togglePassword'),
            passwordInput = document.getElementById('passwordInput'),
            loginForm = document.getElementById('loginForm'),
            loginBtn = document.getElementById('loginBtn');
        const eyeIcon = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
        const eyeOffIcon = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3l18 18"></path><path d="M10.6 10.7a3 3 0 0 0 4.2 4.2"></path><path d="M9.4 5.2A10.4 10.4 0 0 1 12 5c6.5 0 10 7 10 7a18.8 18.8 0 0 1-3.1 4.1"></path><path d="M6.6 6.7C4.1 8.4 2.5 12 2.5 12s3.5 7 9.5 7a10.6 10.6 0 0 0 4-.7"></path></svg>';
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', e => {
                e.preventDefault();
                const hidden = passwordInput.type === 'password';
                passwordInput.type = hidden ? 'text' : 'password';
                togglePassword.classList.toggle('is-active', hidden);
                togglePassword.setAttribute('aria-label', hidden ? 'Hide password' : 'Show password');
                togglePassword.setAttribute('title', hidden ? 'Hide password' : 'Show password');
                togglePassword.innerHTML = hidden ? eyeOffIcon : eyeIcon
            })
        }
        if (loginForm) {
            loginForm.addEventListener('submit', () => {
                if (loginBtn) {
                    loginBtn.disabled = true;
                    loginBtn.textContent = 'Signing in...'
                }
            })
        }
    </script>
</body>

</html>
