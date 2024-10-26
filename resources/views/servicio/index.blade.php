@extends('adminlte::page')

@section('title', 'Servicios')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 90%;">
        <div class="card shadow" style="border-radius: 15px;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
                <h3 class="card-title">Listado de Servicios</h3>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="text-right mb-3">
                    <a href="{{ route('servicio.create') }}" class="btn btn-success" style="border-radius: 20px; padding: 10px 20px;">Crear Servicio</a>
                </div>

                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-light">
                            <tr>
                              
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servicios as $servicio)
                                <tr>
                                   <td>{{ $servicio->nombre }}</td>
                                    <td>{{ $servicio->descripcion }}</td>
                                    <td>
                                        <span class="badge badge-{{ $servicio->estado ? 'success' : 'secondary' }}">
                                            {{ $servicio->estado ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('servicio.edit', $servicio->id) }}" class="btn btn-primary btn-sm" style="border-radius: 5px;">Editar</a>
                                        <form action="{{ route('servicio.destroy', $servicio->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este servicio?');">
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

                
            </div>
        </div>
    </div>
</div>
@stop
