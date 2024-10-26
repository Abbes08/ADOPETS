@extends('adminlte::page')

@section('title', 'Editar Servicio')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 30%; padding: 0 15px;"> <!-- Ajustado a 60% y padding -->
        <div class="card shadow" style="border-radius: 15px;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
                <h3 class="card-title">Editar Servicio</h3>
            </div>

            <div class="card-body">
                <!-- Asegúrate de que la ruta sea correcta y el método sea PUT -->
                <form action="{{ route('servicio.update', $servicio->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nombre">Nombre del Servicio</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $servicio->nombre) }}" required style="max-width: 400px;">
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" name="descripcion" required style="max-width: 400px; height: 100px;">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" name="estado" style="max-width: 400px;">
                            <option value="1" {{ $servicio->estado == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ $servicio->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success" style="border-radius: 20px; padding: 10px 20px;">Actualizar Servicio</button>
                        <a href="{{ route('servicio.index') }}" class="btn btn-secondary" style="border-radius: 20px; padding: 10px 20px;">Volver</a> <!-- Botón de volver -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
