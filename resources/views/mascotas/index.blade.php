@extends('adminlte::page')

@section('title', 'Lista de Mascotas')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 90%;">
        <div class="card shadow" style="border-radius: 15px;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
                <h3 class="card-title">Lista de Mascotas</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('mascotas.create') }}" class="btn btn-success mb-3" style="border-radius: 20px; padding: 10px 20px;">Registrar Nueva Mascota</a>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Sexo</th>
                                <th>Características</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mascotas as $mascota)
                                <tr>
                                    <td>{{ $mascota->nombre }}</td>
                                    <td>{{ $mascota->edad }} años</td>
                                    <td>{{ $mascota->sexo }}</td>
                                    <td>{{ $mascota->caracteristicas }}</td>
                                    <td>{{ $mascota->es_venta ? 'Venta' : 'Adopción' }}</td>
                                    <td>
                                        <a href="{{ route('mascotas.show', $mascota->mascota_id) }}" class="btn btn-info btn-sm" style="border-radius: 5px;">Ver</a>
                                        <a href="{{ route('mascotas.edit', $mascota->mascota_id) }}" class="btn btn-primary btn-sm" style="border-radius: 5px;">Editar</a>
                                        <!-- Botón de eliminación con confirm() -->
                                        <form action="{{ route('mascotas.destroy', $mascota->mascota_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro que deseas eliminar esta mascota?');">
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
@endsection
