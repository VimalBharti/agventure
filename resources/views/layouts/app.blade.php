<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Agrishi - A Social networks for Agriculture</title>
    <meta name="description" content="Agrishi is a free social network platform designed specifically for farmers and other agricultural professionals who can communicate with each other and exchange informations">

    <link rel="manifest" href="{{asset('manifest.json')}}">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="msapplication-starturl" content="/">
    <meta name="theme-color" content="#479788">
    <!-- Apple Meta tags -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Weather PWA">
    <link rel="apple-touch-icon" href="/images/icons/icon-152x152.png">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body style="opacity:0">
    <div id="app">
        <v-app>
            <!-- Navbar -->
            @include('_partials.navbar')

            <main class="router-view">
                @yield('content')
            </main>
        </v-app>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        window.onload = function() {setTimeout(function(){document.body.style.opacity="100";},0);};
    </script>
    @yield('script')
</body>
</html>
