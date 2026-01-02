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

    <title>Email Verification</title>
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
        <a href="{{ route('login') }}" class="left back-btn">
            <i class="icon-left-btn"></i>
        </a>
    </div>

    <div class="pt-45 pb-20">
        <div class="tf-container">

            <h2 class="text-center mt-32">Verify Your Email</h2>
            <p class="text-center text-small mt-12">
                Enter the 6-digit code sent to your email
            </p>

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

            <form method="POST" action="{{ route('verify.post') }}" class="mt-32">
                @csrf

                <fieldset class="mt-16">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Verification Code</p>
                        <input type="text" name="otp" maxlength="6" required placeholder="Enter 6-digit code">
                    </label>
                </fieldset>

                <button type="submit" class="mt-24">Verify</button>
            </form>

            {{-- RESEND OTP --}}
            <form method="POST" action="{{ route('verify.resend') }}" class="mt-16 text-center">
                @csrf
                <button type="submit" class="text-secondary btn-link">
                    Resend Code
                </button>
            </form>

        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>