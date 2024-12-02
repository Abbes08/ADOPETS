@extends('adminlte::page')

@section('title', 'Detalles de Adopción Exitosa')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 60%; padding: 20px;">
        <div class="card shadow-lg" style="border-radius: 15px; overflow: hidden;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
                <h2 class="font-weight-bold">Adopción de {{ $adopcion->mascota->nombre }}</h2>
            </div>
            <div class="card-body p-4">
                <div class="row mb-4">
                    <!-- Información principal -->
                    <div class="col-md-6">
                        <h5 class="font-weight-bold">Reseña:</h5>
                        <p>{{ $adopcion->reseña }}</p>
                        
                        <h5 class="font-weight-bold">Fecha de Reseña:</h5>
                        <p>{{ \Carbon\Carbon::parse($adopcion->fecha_reseña)->format('d M, Y') }}</p>
                        
                        <h5 class="font-weight-bold">Estado:</h5>
                        <p>
                            <span class="badge badge-{{ $adopcion->estado ? 'success' : 'secondary' }}">
                                {{ $adopcion->estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </p>
                    </div>
                    <!-- Imagen -->
                    <div class="col-md-6 text-center">
                        @if($adopcion->imagen)
                            <h5 class="font-weight-bold">Imagen:</h5>
                            <img src="{{ asset('storage/' . $adopcion->imagen) }}" class="img-fluid rounded mb-3" style="max-height: 300px; object-fit: cover; border: 2px solid #56ab2f;">
                        @else
                            <p class="text-muted">No hay imagen disponible</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary" style="border-radius: 20px; padding: 10px 20px;">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection
