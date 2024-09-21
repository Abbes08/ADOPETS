@extends('adminlte::page')

@section('title', 'Roles')

@section('content')
<div class="container">
    <h1>Editar Rol</h1>
    
    <!-- Mostrar mensajes de éxito o error -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('roles.update', $rol->rol_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre del Rol</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $rol->nombre) }}" required>
            @error('nombre')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $rol->descripcion) }}</textarea>
            @error('descripcion')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                <option value="activo" {{ old('estado', $rol->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ old('estado', $rol->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('estado')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Rol</button>
    </form>
</div>
@endsection
