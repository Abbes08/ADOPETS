<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Publicidad</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       <!-- CSS de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Luego tus otros estilos y fuentes -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="css/magnific-popup.css">
<link rel="stylesheet" href="css/bootstrap-datepicker.css">
<link rel="stylesheet" href="css/jquery.timepicker.css">
<link rel="stylesheet" href="css/flaticon.css">

<!-- Finalmente, tu archivo personalizado de estilos -->
<link rel="stylesheet" href="css/style.css">


<!-- Agregar esto justo antes de cerrar el tag </body> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>

 
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
    <a class="navbar-brand" href="{{ route('index') }}"><span class="flaticon-pawprint-1 mr-2"></span>Adopets</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fa fa-bars"></span> Menu
    </button>
	<div class="collapse navbar-collapse" id="ftco-nav">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item "><a href="{{ route('index') }}" class="nav-link">Home</a></li>
     
        <li class="nav-item active"><a href="{{ route('vet') }}" class="nav-link">Publicidad</a></li>
     
        <li class="nav-item"><a href="{{ route('gallery') }}" class="nav-link">Mascotas</a></li>
        <li class="nav-item "><a href="{{ route('blog') }}" class="nav-link">Adopciones Exitosas</a></li>
        <li class="nav-item "><a href="{{ route('contact') }}" class="nav-link">Contactanos</a></li></li>
		@auth
    <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">admin</a></li>
@endauth

@guest
    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
    @if (Route::has('register'))
        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Registrate</a></li>
    @endif
@endguest


    </ul>
</div>

</div>
</nav>
<!-- END nav -->

<!-- Sección Hero -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('images/bg_2.jpg') }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs mb-2">
                    <span class="mr-2"><a href="{{ route('index') }}">Inicio <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Apartado de Publicidad <i class="ion-ios-arrow-forward"></i></span>
                </p>
                <h1 class="mb-0 bread">¿Deseas crear una publicidad?</h1>
                
                @guest
                    <!-- Activar el modal para usuarios no registrados -->
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#loginAlertModal" class="btn btn-primary">Has click aquí</a>
                @else
                    <!-- Redirigir a la ruta de crear publicidad si el usuario está registrado -->
                    <a href="{{ route('publicidad.create') }}" class="btn btn-primary">Has click aquí</a>
                @endguest

            </div>
        </div>
    </div>
</section>



<!-- Modal para alerta de registro -->
<div class="modal fade" id="loginAlertModal" tabindex="-1" aria-labelledby="loginAlertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #e3fcec; color: #155724; border: 2px solid #c3e6cb;">
            <div class="modal-header">
                <h5 class="modal-title" id="loginAlertModalLabel">Atención</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                <p>Para crear una publicidad, primero debes estar registrado en el sistema.</p>
                <p><strong>Por favor, inicia sesión o regístrate para continuar.</strong></p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Mostrar lista de publicidades en vet.blade.php -->
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            @forelse($publicidad as $pub)
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="staff">
                        <div class="img-wrap d-flex align-items-stretch position-relative">
                            <div class="img align-self-stretch" style="background-image: url('{{ asset('storage/' . $pub->imagen) }}');">
                                <a href="{{ asset('storage/' . $pub->imagen) }}" class="icon image-popup d-flex justify-content-center align-items-center icon-expand">
                                    <span class="fa fa-expand"></span>
                                </a>
                            </div>
                        </div>
                        <div class="text pt-3 px-3 pb-4 text-center">
                            <h3>{{ $pub->nombre }}</h3>
                            <span class="position mb-2">{{ $pub->descripcion }}</span>
                            <ul class="ftco-social text-center">
                                <li class="ftco-animate">
                                    <a href="https://wa.me/{{ $pub->telefono }}" target="_blank" class="d-flex align-items-center justify-content-center">
                                        <span class="fa fa-whatsapp"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No hay publicidades registradas en este momento.</p>
                </div>
            @endforelse
        </div>
        <div class="row">
            <div class="col text-center">
                <nav aria-label="Page navigation">
                    {{ $publicidad->links('pagination::bootstrap-4') }}
                </nav>
            </div>
        </div>
    </div>
</section>



<!-- Mostrar lista de publicidades -->
					
    

    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>


    
  </body>
</html>