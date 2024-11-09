<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detalles de {{ $mascota->nombre }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Estilos y Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}"><span class="flaticon-pawprint-1 mr-2"></span>Adopets</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="{{ route('index') }}" class="nav-link">Home</a></li>
                   
                    <li class="nav-item"><a href="{{ route('vet') }}" class="nav-link">Publicidad</a></li>
                   
                    <li class="nav-item active"><a href="{{ route('gallery') }}" class="nav-link">Mascotas</a></li>
                    <li class="nav-item"><a href="{{ route('blog') }}" class="nav-link">Adopciones Exitosas</a></li>
                    <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contactanos</a></li>
                    @auth
                        <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">Admin</a></li>
                    @endauth
                    @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Registrarse</a></li>
                        @endif
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Encabezado Hero -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/bg_2.jpg') }}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs mb-2">
                        <span class="mr-2"><a href="{{ route('index') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> 
                        <span>Mascotas <i class="ion-ios-arrow-forward"></i></span>
                    </p>
                    <h1 class="mb-0 bread">Galeria de Mascotas</h1>
                </div>
            </div>
        </div>
    </section>

    <style>
        .container-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            margin: 30px auto;
        }
        .header-card {
    background: linear-gradient(90deg, #007BFF, #28A745); /* Azul normal a verde */
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 1.5em;
    font-weight: bold;
}


        .body-card {
            padding: 20px;
        }
        .mascota-info, .mascota-gallery {
            margin-bottom: 20px;
        }
        .mascota-info p, .mascota-gallery h4 {
            font-size: 1.1em;
            margin: 8px 0;
        }
        .mascota-gallery .img-thumbnail {
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .mascota-gallery .img-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-action {
            display: inline-block;
            width: 100%;
            text-align: center;
            font-size: 1.1em;
            font-weight: bold;
            padding: 12px;
            border-radius: 20px;
            margin-top: 20px;
            transition: background 0.3s;
        }
        .btn-primary {
            background-color: #4CAF50;
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
        .btn-secondary {
            background-color: #777;
            color: white;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <!-- Contenedor Principal -->
    <section class="ftco-section">
        <div class="container-card">
            <!-- Encabezado -->
            <div class="header-card">Detalles de {{ $mascota->nombre }}</div>

            <!-- Formulario con información y galería -->
            <form action="{{ route('mascotas.adquirir', $mascota->mascota_id) }}" method="POST">
                @csrf
                <div class="body-card row">
                    <!-- Información de la Mascota -->
                    <div class="col-md-6 mascota-info">
                        <h4 class="text-center mb-3">Información de la Mascota</h4>
                        <p><strong>Nombre: </strong> {{ $mascota->nombre }}</p>
                        <p><strong>Edad: </strong> {{ $mascota->edad }} años</p>
                        <p><strong>Sexo: </strong> {{ $mascota->sexo }}</p>
                        <p><strong>Características: </strong> {{ $mascota->caracteristicas }}</p>
                        <p><strong>Estado en: </strong> {{ $mascota->es_venta ? 'Venta' : 'Adopción' }}</p>
                        @if ($mascota->es_venta)
                            <p><strong>Raza: </strong> {{ $mascota->raza }}</p>
                            <p><strong>Precio: </strong> ${{ number_format($mascota->precio, 2) }}</p>
                        @endif
                    </div>

                    <!-- Galería de Fotos -->
                    <div class="col-md-6 mascota-gallery">
                        <h4 class="text-center mb-3">Galería de Fotos</h4>
                        <div class="row">
                            @foreach ($mascota->fotos as $foto)
                                <div class="col-md-6 mb-3">
                                    <img src="{{ asset('storage/' . $foto) }}" class="img-fluid img-thumbnail" alt="Foto de {{ $mascota->nombre }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="body-card text-center">

<a href="https://wa.me/{{ $mascota->telefono }}?text={{ urlencode('Estoy interesado en ' . ($mascota->es_venta ? 'comprar' : 'adoptar') . ' a ' . $mascota->nombre) }}" 
   target="_blank" 
   class="btn btn-primary btn-action w-50">
    {{ $mascota->es_venta ? 'Comprar Mascota' : 'Adoptar Mascota' }}
</a>


    <!-- Botón de "Volver" -->
    <a href="{{ route('gallery') }}" class="btn btn-secondary btn-action w-50">Volver</a>
</div>


    <!-- Scripts JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


    <!-- Scripts JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/scrollax.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
