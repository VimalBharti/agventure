<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Agrishi - A Social networks for Agriculture</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

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
