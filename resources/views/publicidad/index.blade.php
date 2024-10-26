@extends('adminlte::page')

@section('title', 'Publicidad')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 90%;">
        <div class="card shadow" style="border-radius: 15px;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
                <h3 class="card-title">Lista de Publicidades</h3>
            </div>

            <div class="card-body">
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

                <div class="text-right mb-3">
                    <a href="{{ route('publicidad.create') }}" class="btn btn-success" style="border-radius: 20px; padding: 10px 20px;">Crear Publicidad</a>
                </div>

                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                                
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

                                    <td>{{ $publicidad->nombre }}</td>
                                    <td>${{ number_format($publicidad->precio, 2) }}</td>
                                    <td>{{ $publicidad->descripcion }}</td>
                                    <td>{{ $publicidad->telefono }}</td>
                                    <td>{{ $publicidad->fechaInicio }}</td>
                                    <td>{{ $publicidad->fechaFinal }}</td>
                                    <td>
                                        @if($publicidad->imagen)
                                            <img src="{{ asset('storage/' . $publicidad->imagen) }}" alt="Imagen de la publicidad" width="100" style="border-radius: 10px;">
                                        @else
                                            <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $publicidad->estado == 'activo' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($publicidad->estado) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('publicidad.edit', $publicidad->id) }}" class="btn btn-primary btn-sm" style="border-radius: 5px;">Editar</a>
                                        <form action="{{ route('publicidad.destroy', $publicidad->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta publicidad?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 5px;">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $publicidades->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
