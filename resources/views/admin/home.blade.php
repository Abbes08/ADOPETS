@extends('adminlte::page')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <!-- Mensaje de bienvenida -->
            <div class="card mb-4">
                <div class="card-header" style="background: linear-gradient(90deg, #6dbf8b, #3a8c54);">
                    <h3 class="card-title text-white">¡Bienvenido a Adopets, {{ Auth::user()->name }}!</h3>
                </div>
                <div class="card-body">
                    <p class="lead">Tu dedicación marca la diferencia en la vida de nuestras mascotas. ¡Gracias por ser parte de nuestra misión!</p>
                    <img src="{{ asset('images/gallery-2.jpg') }}" alt="Bienvenido a Adopets" class="img-fluid rounded mb-3" style="max-height: 200px;">
                    <p class="text-muted">"Hasta que no hayas amado a un animal, una parte de tu alma permanecerá dormida." - Anatole France</p>
                </div>
            </div>

            <!-- Estadísticas de impacto -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header" style="background: linear-gradient(90deg, #77d99a, #58a359);">
                            <h5 class="card-title text-white">Mascotas en venta</h5>
                        </div>
                        <div class="card-body">
                            <h2 class="display-4">{{ $adoptionsCount ?? 0 }}</h2>
                            <p>Mascotas que aún no han sido compradas</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header" style="background: linear-gradient(90deg, #a8e063, #6ab04c);">
                            <h5 class="card-title text-white">Mascotas Activas</h5>
                        </div>
                        <div class="card-body">
                            <h2 class="display-4">{{ $activePets ?? 0 }}</h2>
                            <p>Mascotas que aún no han encontrado un hogar.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-header" style="background: linear-gradient(90deg, #ffc371, #ff5f6d);">
                            <h5 class="card-title text-white">Miembros Activos</h5>
                        </div>
                        <div class="card-body">
                            <h2 class="display-4">{{ $communityMembers ?? 0 }}</h2>
                            <p>Personas como tú, ayudando a cambiar vidas.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Motivación para explorar -->
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" style="background: linear-gradient(90deg, #6dbf8b, #4e937a);">
                            <h5 class="card-title text-white">Explora las Mascotas</h5>
                        </div>
                        <div class="card-body">
                            <p>Visita el catálogo de mascotas para conocer a los nuevos miembros que esperan un hogar.</p>
                            <a href="{{ route('gallery') }}" class="btn btn-success">Ver Mascotas</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" style="background: linear-gradient(90deg, #77d99a, #58a359);">
                            <h5 class="card-title text-white">Historias de Éxito</h5>
                        </div>
                        <div class="card-body">
                            <p>Lee sobre adopciones exitosas que has facilitado y siente el impacto de tu trabajo.</p>
                            <a href="{{ route('blog') }}" class="btn btn-primary">Ver Historias</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
