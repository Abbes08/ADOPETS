@extends('adminlte::page')

@section('title', 'Crear Publicidad')

@section('content')
    <div class="container">
        <h1>Crear Nueva Publicidad</h1>

        <!-- Botón para volver a la pantalla anterior -->
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Volver</a>

        <!-- Mostrar mensajes de error si los hay -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Mostrar mensaje de éxito si existe -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario para crear la publicidad -->
        <form action="{{ route('publicidad.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Campo nombre -->
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo precio -->
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio') }}" required>
                @error('precio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo descripción -->
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="5" required>{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo teléfono -->
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo usuario -->
            <div class="form-group">
                <label for="user_id">Usuario</label>
                <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    <option value="">Seleccionar Usuario</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo imagen -->
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" required>
                @error('imagen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo fecha de inicio -->
            <div class="form-group">
                <label for="fechaInicio">Fecha de Inicio</label>
                <input type="date" class="form-control @error('fechaInicio') is-invalid @enderror" id="fechaInicio" name="fechaInicio" value="{{ old('fechaInicio') }}" required>
                @error('fechaInicio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo fecha final -->
            <div class="form-group">
                <label for="fechaFinal">Fecha Final</label>
                <input type="date" class="form-control @error('fechaFinal') is-invalid @enderror" id="fechaFinal" name="fechaFinal" value="{{ old('fechaFinal') }}" required>
                @error('fechaFinal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo estado -->
            <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Crear Publicidad</button>
        </form>
    </div>
@stop

