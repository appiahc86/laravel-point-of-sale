<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon"  href="{{ asset('img/logo.ico') }}">

    <title>INNOCENT</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('css/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<style>
    .error-message{
        font-size: 1em;
    }
    .card-header{
        font-size: 3em;
        font-family: 'Times New Roman', Times, serif;
    }
</style>

<body style="background: rgba(195,207,220,0.76)">
    <div id="app">

        @yield('header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

@yield('scripts')

</body>
</html>
