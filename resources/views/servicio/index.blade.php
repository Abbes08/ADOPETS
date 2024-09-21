@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
    <h1>Listado de Servicios</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('servicio.create') }}" class="btn btn-primary">Crear Servicio</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicios as $servicio)
                        <tr>
                            <td>{{ $servicio->servicio_id }}</td>
                            <td>{{ $servicio->nombre }}</td>
                            <td>{{ $servicio->descripcion }}</td>
                            <td>{{ $servicio->estado ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                <a href="{{ route('servicio.edit', $servicio->servicio_id) }}" class="btn btn-warning">Editar</a>
                                
                                <form action="{{ route('servicio.destroy', $servicio->servicio_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este servicio?');">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
