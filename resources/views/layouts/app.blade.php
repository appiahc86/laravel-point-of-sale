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




    #preloader:before {
          content: "";
          position: fixed;
          top: calc(50% - 30px);
          left: calc(50% - 30px);
          border: 6px solid #f2f2f2;
          border-top: 6px solid #4e7dff;
          border-radius: 50%;
          width: 60px;
          height: 60px;
          -webkit-animation: animate-preloader 1s linear infinite;
          animation: animate-preloader 1s linear infinite;
      }

    @-webkit-keyframes animate-preloader {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes animate-preloader {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

</style>

<body style="background: rgba(195,207,220,0.76)">
    <div id="app">

        @yield('header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <div id="preloader"></div>



    <script>
        window.onload = function () {
            const prev = document.querySelector('.prev');
            const myForm = document.querySelector('.myForm');



                if ($('#preloader').length) {
                    $('#preloader').delay(100).fadeOut('slow', function () {
                        $(this).remove();
                    });
                }



            myForm.onsubmit = function () {
                // prev.style.display = 'none';
                prev.disabled = true;
                prev.value = 'Please wait...'
            }

        }
    </script>
</body>
</html>
