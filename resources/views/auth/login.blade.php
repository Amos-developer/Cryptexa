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

    <title>Login</title>
</head>

<body>

    <!-- Preloader -->
    <div class="preload preload-container">
        <div class="preload-logo" style="background-image: url('{{ asset('images/logo/144.png') }}')">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /Preloader -->

    <div class="header fixed-top bg-surface">
        <a href="{{ route('register') }}" class="left back-btn">
            <i class="icon-left-btn"></i>
        </a>
    </div>

    <div class="pt-45 pb-20">
        <div class="tf-container">

            <div class="mt-32">
                <h2 class="text-center">Login Cointex</h2>
            </div>

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
            <p class="text-success text-center mt-16">
                {{ session('success') }}
            </p>
            @endif

            {{-- ERROR MESSAGE --}}
            @if(session('error'))
            <p class="text-danger text-center mt-16">
                {{ session('error') }}
            </p>
            @endif

            {{-- VALIDATION ERRORS --}}
            @if($errors->any())
            <div class="text-danger mt-16">
                @foreach($errors->all() as $error)
                <p class="text-small">{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <div class="auth-line mt-12">Or</div>

            <form method="POST" action="{{ route('login.post') }}" class="mt-16">
                @csrf

                <fieldset class="mt-16">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Email</p>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </label>
                </fieldset>

                <fieldset class="mt-16 mb-12">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Password</p>
                        <div class="box-auth-pass">
                            <input type="password" name="password" required placeholder="Your password" class="password-field">
                            <span class="show-pass">
                                <i class="icon-view"></i>
                                <i class="icon-view-hide"></i>
                            </span>
                        </div>
                    </label>
                </fieldset>

                <a href="#" class="text-secondary">Forgot Password?</a>

                <button type="submit" class="mt-20">Login</button>

                <p class="mt-20 text-center text-small">
                    Don’t have an account?
                    &ensp;<a href="{{ route('register') }}">Sign up</a>
                </p>
            </form>

        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>