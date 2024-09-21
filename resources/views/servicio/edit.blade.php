@extends('adminlte::page')

@section('title', 'Editar Servicio')

@section('content_header')
    <h1>Editar Servicio</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('servicio.update', $servicio->servicio_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre del Servicio</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $servicio->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" name="descripcion">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-control" name="estado">
                        <option value="1" {{ $servicio->estado == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $servicio->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Servicio</button>
            </form>
        </div>
    </div>
@endsection
