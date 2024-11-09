@extends('adminlte::page')

@section('title', 'Crear/Editar Servicio')

@section('content')
<div class="container" style="max-width: 700px;">
    <div class="card shadow" style="border-radius: 15px;">
        <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
            <h3 class="card-title">{{ isset($servicio) ? 'Editar Servicio' : 'Crear Servicio' }}</h3>
        </div>

        <div class="card-body">
            <form action="{{ isset($servicio) ? route('servicio.update', $servicio->id) : route('servicio.store') }}" method="POST">
                @csrf
                @if (isset($servicio))
                    @method('PUT')
                @endif

                <!-- Campo Nombre -->
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $servicio->nombre ?? '') }}" required>
                </div>

                <!-- Campo Descripción -->
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion', $servicio->descripcion ?? '') }}</textarea>
                </div>

                <!-- Campo Estado (Activo/Inactivo) -->
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" class="form-control">
                        <option value="1" {{ (old('estado', $servicio->estado ?? '') == 1) ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ (old('estado', $servicio->estado ?? '') == 0) ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <!-- Botones de acción -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success" style="border-radius: 5px;">{{ isset($servicio) ? 'Actualizar Servicio' : 'Crear Servicio' }}</button>
                    <a href="{{ route('servicio.index') }}" class="btn btn-secondary" style="border-radius: 5px;">Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
