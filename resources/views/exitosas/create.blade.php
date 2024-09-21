@extends('adminlte::page')

@section('title', 'Crear Adopción Exitosa')

@section('content_header')
    <h1>Crear Adopción Exitosa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('exitosas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Select para seleccionar el usuario -->
                <div class="form-group">
                    <label for="idUser">Seleccionar Usuario:</label>
                    <select name="idUser" class="form-control" required>
                        <option value="">Selecciona un usuario</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo de texto para el nombre -->
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <!-- Campo de texto para la historia -->
                <div class="form-group">
                    <label for="Historia">Historia:</label>
                    <textarea name="Historia" class="form-control" required></textarea>
                </div>

                <!-- Campo para subir la imagen de la mascota -->
                <div class="form-group">
                    <label for="fotomascota">Foto de la mascota:</label>
                    <input type="file" name="fotomascota" class="form-control-file" accept="image/*" required>
                </div>

                <!-- Campo para la fecha -->
                <div class="form-group">
                    <label for="Fecha">Fecha de la adopción:</label>
                    <input type="date" name="Fecha" class="form-control" required>
                </div>
                        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control">
                <option value="1" {{ isset($exitosa) && $exitosa->estado == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ isset($exitosa) && $exitosa->estado == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

                <!-- Botón para guardar -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@stop
