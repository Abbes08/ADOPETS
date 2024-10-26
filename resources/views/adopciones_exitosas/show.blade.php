@extends('adminlte::page')

@section('title', 'Detalles de Adopción Exitosa')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 600px; padding: 0 15px;">
        <div class="card shadow" style="border-radius: 15px; overflow: hidden;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
                <h2>Mascota: {{ $adopcion->mascota->nombre }}</h2>
            </div>
            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                <h4>Reseña:</h4>
                <p>{{ $adopcion->reseña }}</p>

                <h4>Fecha de Reseña:</h4>
                <p>{{ \Carbon\Carbon::parse($adopcion->fecha_reseña)->toDateString() }}</p>

                <h4>Estado:</h4>
                <p>{{ $adopcion->estado ? 'Activo' : 'Inactivo' }}</p>

                @if($adopcion->imagen)
                    <h4>Imagen:</h4>
                    <img src="{{ asset('storage/' . $adopcion->imagen) }}" class="img-fluid rounded mx-auto d-block" alt="Imagen de adopción" style="max-height: 300px; object-fit: cover;">
                @endif
            </div>
            <div class="card-footer text-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary mb-5" style="border-radius: 20px; padding: 10px 20px;">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
