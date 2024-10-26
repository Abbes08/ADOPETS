@extends('adminlte::page')

@section('title', 'Adopciones Exitosas')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 90%; padding: 0 15px;">
        <div class="card shadow" style="border-radius: 15px;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
                <h3 class="card-title">Mis Adopciones Exitosas</h3>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <a href="{{ route('adopciones_exitosas.create') }}" class="btn btn-success mb-3">Nueva Adopción Exitosa</a>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mascota</th>
                            <th>Reseña</th>
                            <th>Fecha de Reseña</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adopciones as $adopcion)
                            <tr>
                                <td>{{ $adopcion->mascota->nombre }}</td>
                                <td>{{ $adopcion->reseña }}</td>
                                <td>{{ $adopcion->fecha_reseña->format('d-m-Y') }}</td>
                                <td>{{ $adopcion->estado ? 'Activo' : 'Inactivo' }}</td>
                                <td>
                                    <a href="{{ route('adopciones_exitosas.show', $adopcion->adop_id) }}" class="btn btn-info">Ver</a>
                                    <a href="{{ route('adopciones_exitosas.edit', $adopcion->adop_id) }}" class="btn btn-primary">Editar</a>
                                    <form action="{{ route('adopciones_exitosas.destroy', $adopcion->adop_id) }}" method="POST" style="display:inline-block;">
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
        </div>
    </div>
</div>
@endsection
