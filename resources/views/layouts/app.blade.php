<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Breeze Vite build -->
    @vite(['resources/js/app.js'])

    <!-- तुमचं Bootstrap आणि Custom Styles - नंतर load करा -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            @yield('content')
        </main>
    </div>

    @auth
    <script>
        // Generate a unique key for this tab
        const tabKey = 'tab_' + Date.now();
        localStorage.setItem(tabKey, 'open');

        // Remove this tab key on unload, then check if it's last tab
        window.addEventListener('beforeunload', function () {
            localStorage.removeItem(tabKey);
            setTimeout(() => {
                const remaining = Object.keys(localStorage).filter(k => k.startsWith('tab_'));
                if (remaining.length === 0) {
                    navigator.sendBeacon('/logout-on-tab-close');
                }
            }, 0); // delay to ensure localStorage updates
        });

        // Optional cleanup for old/stale keys
        window.addEventListener('load', function () {
            const now = Date.now();
            Object.keys(localStorage).forEach(key => {
                if (key.startsWith('tab_')) {
                    const time = parseInt(key.split('_')[1]);
                    if (now - time > 1000 * 60 * 60) {
                        localStorage.removeItem(key);
                    }
                }
            });
        });
    </script>
    @endauth

</body>
</html>
