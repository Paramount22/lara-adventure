<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Adventure')</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body style="background-image: url({{ asset('img/Adventure-Time.jpg') }})">

      @include('navigation.nav')



        <main class="container">
            @include('errors.errors')
            @yield('content')

            @include('flash::message')
        </main>



      <!-- Scripts -->
      <script src="{{ asset('js/jquery.js') }}"></script>
      <script src="{{ asset('js/app.js') }}" defer></script>
      <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
