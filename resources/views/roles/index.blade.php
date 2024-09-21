@extends('adminlte::page')

@section('title', 'Roles')

@section('content')
<div class="container">
    <h1>Lista de Roles</h1>

    <!-- Mostrar mensajes de éxito -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mostrar mensajes de error -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('roles.create') }}" class="btn btn-success mb-3">Crear Nuevo Rol</a>

    <table class="table table-striped">
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
            @foreach($roles as $rol)
                <tr>
                    <td>{{ $rol->rol_id }}</td>
                    <td>{{ $rol->nombre }}</td>
                    <td>{{ $rol->descripcion }}</td>
                    <td>{{ $rol->estado }}</td>
                    <td>
                        <a href="{{ route('roles.edit', $rol->rol_id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('roles.destroy', $rol->rol_id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este rol?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
