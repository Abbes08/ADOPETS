@extends('adminlte::page')

@section('title', 'Publicidad')

@section('content')
<div class="container">
    <h1>Lista de Publicidades</h1>

    <!-- Mostrar mensaje de éxito si existe -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mostrar mensaje de error si existe -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Botón para crear nueva publicidad -->
    <a href="{{ route('publicidad.create') }}" class="btn btn-success mb-3">Crear Publicidad</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th> 
                <th>Descripción</th>
                <th>Teléfono</th>
                <th>Fecha Inicio</th>
                <th>Fecha Final</th>
                <th>Imagen</th> 
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($publicidades as $publicidad)
                <tr>
                    <td>{{ $publicidad->id }}</td>
                    <td>{{ $publicidad->nombre }}</td>
                    <td>{{ $publicidad->precio }}</td> 
                    <td>{{ $publicidad->descripcion }}</td>
                    <td>{{ $publicidad->telefono }}</td>
                    <td>{{ $publicidad->fechaInicio }}</td>
                    <td>{{ $publicidad->fechaFinal }}</td>
                    <td>
                        @if($publicidad->imagen)
                            <img src="{{ asset('storage/' . $publicidad->imagen) }}" alt="Imagen de la publicidad" width="100">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>{{ $publicidad->estado }}</td>
                    <td>
                        <a href="{{ route('publicidad.edit', $publicidad->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('publicidad.destroy', $publicidad->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta publicidad?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    {{ $publicidades->links() }}

</div>
@stop
