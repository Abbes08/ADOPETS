@extends('adminlte::page')

@section('title', 'Editar Adopción Exitosa')

@section('content_header')
    <h1>Editar Adopción Exitosa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('exitosas.update', $exitosa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Select para seleccionar el usuario -->
                <div class="form-group">
                    <label for="idUser">Seleccionar Usuario:</label>
                    <select name="idUser" class="form-control" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $exitosa->idUser == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Campo de texto para el nombre -->
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $exitosa->nombre }}" required>
                </div>

                <!-- Campo de texto para la historia -->
                <div class="form-group">
                    <label for="Historia">Historia:</label>
                    <textarea name="Historia" class="form-control" required>{{ $exitosa->Historia }}</textarea>
                </div>

                <!-- Campo para la imagen de la mascota -->
                <div class="form-group">
                    <label for="fotomascota">Foto de la mascota:</label>
                    <input type="file" name="fotomascota" class="form-control-file" accept="image/*">
                    @if($exitosa->fotomascota)
                        <img src="{{ Storage::url('fotomascotas/' . $exitosa->fotomascota) }}" alt="Foto de la mascota" width="100" class="mt-2">
                    @endif
                </div>

                <!-- Campo para la fecha -->
                <div class="form-group">
                    <label for="Fecha">Fecha de la adopción:</label>
                    <input type="date" name="Fecha" class="form-control" value="{{ $exitosa->Fecha }}" required>
                </div>

                <!-- Botón para actualizar -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@stop
