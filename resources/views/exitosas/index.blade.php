@extends('adminlte::page')

@section('title', 'Adopciones Exitosas')

@section('content_header')
    <h1>Adopciones Exitosas</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Botón para crear nueva adopción exitosa -->
    <div class="mb-3">
        <a href="{{ route('exitosas.create') }}" class="btn btn-success">Crear Nueva Adopción Exitosa</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Historia</th>
                        <th>Foto de la mascota</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exitosas as $exitosa)
                    <tr>
                        <td>{{ $exitosa->nombre }}</td>
                        <td>{{ $exitosa->Historia }}</td>
                        <td>
                            <img src="{{ Storage::url('fotomascotas/' . $exitosa->fotomascota) }}" alt="Foto de la mascota" width="100">
                        </td>
                        <td>{{ $exitosa->Fecha }}</td>
                        <td>
                            <a href="{{ route('exitosas.edit', $exitosa->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('exitosas.destroy', $exitosa->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
