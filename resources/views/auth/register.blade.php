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

    <title>Register</title>
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

    <div class="pt-45">
        <div class="tf-container">

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
            <p class="text-success text-center mt-16">
                {{ session('success') }}
            </p>
            @endif

            {{-- ERROR MESSAGES --}}
            @if($errors->any())
            <div class="text-danger mt-16">
                @foreach($errors->all() as $error)
                <p class="text-small">{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}" class="mt-32 mb-16">
                @csrf

                <h2 class="text-center">Register Cointex</h2>

                <fieldset class="mt-40">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Name</p>
                        <input type="text" name="name" value="{{ old('name') }}" required>
                    </label>
                </fieldset>

                <fieldset class="mt-16">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Email</p>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </label>
                </fieldset>

                <fieldset class="mt-16">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Phone Number</p>
                        <input type="text" name="phone" value="{{ old('phone') }}">
                    </label>
                </fieldset>

                <fieldset class="mt-16">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Password</p>
                        <div class="box-auth-pass">
                            <input type="password" name="password" required placeholder="6 - 20 characters" class="password-field">
                            <span class="show-pass">
                                <i class="icon-view"></i>
                                <i class="icon-view-hide"></i>
                            </span>
                        </div>
                    </label>
                </fieldset>

                <fieldset class="mt-16">
                    <label class="label-ip">
                        <p class="mb-8 text-small">Confirm Password</p>
                        <div class="box-auth-pass">
                            <input type="password" name="password_confirmation" required placeholder="Confirm password" class="password-field2">
                            <span class="show-pass2">
                                <i class="icon-view"></i>
                                <i class="icon-view-hide"></i>
                            </span>
                        </div>
                    </label>
                </fieldset>

                <fieldset class="group-cb cb-signup mt-12">
                    <input type="checkbox" class="tf-checkbox" id="cb-ip" required>
                    <label for="cb-ip">
                        I agree to <span class="text-white">Terms and condition</span>
                    </label>
                </fieldset>

                <button type="submit" class="mt-40">Create an account</button>
            </form>

        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>