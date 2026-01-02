<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Cryptexa')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-icons.css') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <link rel="shortcut icon" href="{{ asset('images/logo/48.png') }}">
</head>

<body>

    {{-- Header (only for authenticated users) --}}
    @auth
    @include('partials.header')
    @endauth

    {{-- MAIN CONTENT (THIS WAS MISSING) --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- Footer (only for authenticated users) --}}
    @auth
    @include('partials.footer')
    @endauth

    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>