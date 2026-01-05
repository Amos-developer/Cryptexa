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

    <title>Login | CRYPTEXA</title>
</head>

<body style="background:#020617;">

    <!-- PRELOADER -->
    <!-- <div class="preload preload-container">
        <div class="preload-logo" style="background-image:url('{{ asset('images/logo/144.png') }}')">
            <div class="spinner"></div>
        </div>
    </div> -->

    <!-- HEADER -->
    <div class="header fixed-top"
        style="background:#020617;border-bottom:1px solid rgba(56,189,248,.15);">
        <a href="{{ route('register') }}" class="left back-btn">
            <i class="icon-left-btn text-white"></i>
        </a>
    </div>

    <!-- CONTENT -->
    <div class="pt-45 pb-20">
        <div class="tf-container">

            <!-- CARD -->
            <div class="mx-auto mt-32"
                style="
                max-width:420px;
                background:linear-gradient(180deg,#020617,#0f172a);
                border-radius:20px;
                padding:28px;
                border:1px solid rgba(56,189,248,.25);
                box-shadow:0 20px 40px rgba(56,189,248,.25);
             ">

                <!-- LOGO -->
                <!-- <div class="text-center mb-20">
                    <img src="{{ asset('images/logo/144.png') }}" style="width:72px;">
                </div> -->

                <h2 class="text-center text-white mb-4"
                    style="font-weight:600;text-shadow:0 0 20px rgba(56,189,248,.4);">
                    Login to CRYPTEXA
                </h2>

                <p class="text-center text-secondary text-small mb-20">
                    Secure access to your account
                </p>

                {{-- SUCCESS --}}
                @if(session('success'))
                <div class="alert alert-success text-center py-2 mb-12">
                    {{ session('success') }}
                </div>
                @endif

                {{-- ERROR --}}
                @if(session('error'))
                <div class="alert alert-danger text-center py-2 mb-12">
                    {{ session('error') }}
                </div>
                @endif

                {{-- VALIDATION --}}
                @if($errors->any())
                <div class="text-danger mb-12">
                    @foreach($errors->all() as $error)
                    <p class="text-small mb-1">{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <!-- EMAIL -->
                    <fieldset class="mb-16">
                        <label class="label-ip">
                            <p class="mb-8 text-small text-secondary">Email address</p>
                            <input type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                style="
                                    background:#020617;
                                    border:1px solid rgba(56,189,248,.35);
                                    color:#e5e7eb;
                                    border-radius:14px;
                                    padding:14px;
                               ">
                        </label>
                    </fieldset>

                    <!-- PASSWORD -->
                    <fieldset class="mb-8">
                        <label class="label-ip">
                            <p class="mb-8 text-small text-secondary">Password</p>
                            <div class="box-auth-pass">
                                <input type="password"
                                    name="password"
                                    required
                                    placeholder="Your password"
                                    class="password-field"
                                    style="
                                        background:#020617;
                                        border:1px solid rgba(56,189,248,.35);
                                        color:#e5e7eb;
                                        border-radius:14px;
                                        padding:14px;
                                   ">
                                <span class="show-pass">
                                    <i class="icon-view"></i>
                                    <i class="icon-view-hide"></i>
                                </span>
                            </div>
                        </label>
                    </fieldset>

                    <!-- FORGOT -->
                    <div class="text-end mb-20">
                        <a href="#" class="text-secondary text-small">
                            Forgot password?
                        </a>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-100"
                        style="
                            background:#38bdf8;
                            color:#020617;
                            font-weight:600;
                            padding:14px;
                            border-radius:14px;
                            border:none;
                            box-shadow:0 10px 30px rgba(56,189,248,.4);
                        ">
                        Login
                    </button>

                    <!-- REGISTER -->
                    <p class="mt-20 text-center text-small text-secondary">
                        Don’t have an account?
                        <a href="{{ route('register') }}" class="text-info fw-semibold">
                            Sign up
                        </a>
                    </p>

                </form>
            </div>
            <!-- END CARD -->

        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>