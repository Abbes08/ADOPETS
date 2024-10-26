@extends('adminlte::page')

@section('title', 'Detalles de Mascota')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 80%;">
        <div class="row">
            <!-- Contenedor de datos de la mascota -->
            <div class="col-md-6">
                <div class="card shadow" style="border-radius: 15px; overflow-y: auto; max-height: 80vh;">
                    <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); color: white; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h4>Información de la Mascota</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre:</strong> {{ $mascota->nombre }}</p>
                        <p><strong>Edad:</strong> {{ $mascota->edad }} años</p>
                        <p><strong>Sexo:</strong> {{ $mascota->sexo }}</p>
                        <p><strong>Características:</strong> {{ $mascota->caracteristicas }}</p>
                        <p><strong>Tipo:</strong> {{ $mascota->es_venta ? 'Venta' : 'Adopción' }}</p>

                        @if ($mascota->es_venta)
                            <p><strong>Raza:</strong> {{ $mascota->raza }}</p>
                            <p><strong>Precio:</strong> ${{ number_format($mascota->precio, 2) }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contenedor de galería de fotos -->
            <div class="col-md-6">
                <div class="card shadow" style="border-radius: 15px; overflow-y: auto; max-height: 80vh;">
                    <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); color: white; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h4>Galería de Fotos</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($mascota->fotos as $foto)
                                <div class="col-md-4 mb-3">
                                    <img src="{{ asset('storage/' . $foto) }}" class="img-fluid img-thumbnail" alt="Foto de {{ $mascota->nombre }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón para adoptar o comprar, pasando por el controlador para registrar la transacción -->
        <form action="{{ route('mascotas.adquirir', $mascota->mascota_id) }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-primary" style="border-radius: 20px; padding: 10px 20px;">
                {{ $mascota->es_venta ? 'Comprar Mascota' : 'Adoptar Mascota' }}
            </button>
        </form>

        <a href="{{ route('mascotas.index') }}" class="btn btn-secondary mt-3" style="border-radius: 20px; padding: 10px 20px;">Volver</a>
    </div>
</div>
@endsection
