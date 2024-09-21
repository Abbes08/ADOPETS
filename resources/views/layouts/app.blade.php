<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Adopets') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
    body {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('/images/bg_1.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        z-index: -2; /* Asegura que la imagen de fondo esté detrás del contenido */
    }
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Color negro con opacidad */
        z-index: -1; /* Asegura que la superposición esté detrás del contenido */
    }

    /* Custom Styles */
    .brand-container {
        position: absolute;
        top: 10px;
        left: 10px;
    }
    .brand-link {
        font-size: 24px;
        color: #ffffff;
        text-decoration: none;
    }
    </style>

</head>
<body>
    
<div class="background-image"></div> <!-- Imagen de fondo -->
<div class="overlay"></div> <!-- Superposición negra -->
    <div id="app">
        <!-- Custom Brand Link -->
        <div class="brand-container">
        <a class="brand-link" href="{{ url('/') }}">Adopets</a>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
