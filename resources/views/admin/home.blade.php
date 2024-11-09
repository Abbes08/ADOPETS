@extends('adminlte::page')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(90deg, #6dbf8b, #3a8c54);">
                    <h3 class="card-title text-white">¡Bienvenido a Adopets!</h3>
                </div>
                <div class="card-body">
                    <p class="lead">Estamos felices de tenerte aquí. En Adopets, ayudamos a encontrar un hogar para mascotas necesitadas.</p>
                    <img src="{{ asset('images/gallery-1.jpg') }}" alt="Bienvenido a Adopets" class="img-fluid rounded mb-3" style="max-height: 200px;"> <!-- Tamaño de la imagen ajustado -->
                </div>
                <div class="card-footer text-muted">
                    Explora las diferentes secciones para empezar a ayudar a nuestras mascotas.
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" style="background: linear-gradient(90deg, #77d99a, #58a359);">
                            <h5 class="card-title text-white">¿Cómo Funciona?</h5>
                        </div>
                        <div class="card-body">
                            <p>Descubre cómo puedes adoptar, dar en adopción o ayudar a nuestras mascotas.</p>
                            <img src="{{ asset('images/gallery-2.jpg') }}" alt="Cómo Funciona" class="img-fluid rounded">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" style="background: linear-gradient(90deg, #a8e063, #6ab04c);">
                            <h5 class="card-title text-white">Únete a la Comunidad</h5>
                        </div>
                        <div class="card-body">
                            <p>Conviértete en un miembro activo de nuestra comunidad y ayuda a promover la adopción.</p>
                            <img src="{{ asset('images/gallery-3.jpg') }}" alt="Comunidad" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
