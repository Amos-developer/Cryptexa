<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Cryptexa')</title>

    <!-- PWA -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#38bdf8">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Cryptexa">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/logo.png') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/font-icons.css') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/light-theme.css') }}">

    @stack('styles')

    <link rel="shortcut icon" href="{{ asset('images/logo/logo.png') }}">
</head>

<body>

    {{-- Preloader --}}
    {{-- @include('partials.preloader') --}}

    <div class="app-dark">

        {{-- Header --}}
        @auth
        @unless(View::hasSection('hide-header'))
        @include('partials.header')
        @endunless
        @endauth

        @if(View::hasSection('hide-header'))
        @include('partials.subpage-topbar')
        <style>
            .team-header,
            .team-topbar,
            .settings-topbar,
            .track-topbar,
            .plan-topbar,
            .luckybox-header,
            .checkin-header,
            .withdrawal-header,
            .pin-header,
            .settings-header,
            .header.fixed-top {
                display: none !important;
            }
        </style>
        @endif

        {{-- MAIN CONTENT --}}
        <main class="app-content">
            @yield('content')
        </main>

        {{-- Footer --}}
        @auth
        @include('partials.footer')
        @endauth

    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @include('partials.alerts')
    
    <script>
    // Clear theme from localStorage to reset to default dark mode
    localStorage.removeItem('theme');
    
    // Auto-reload on CSRF token expiration
    window.addEventListener('error', function(e) {
        if (e.message && e.message.includes('419')) {
            location.reload();
        }
    });
    
    // Register Service Worker for PWA
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js')
            .then(reg => console.log('Service Worker registered'))
            .catch(err => console.log('Service Worker registration failed:', err));
    }
    </script>

</body>

</html>
