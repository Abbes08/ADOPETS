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
                <!-- Sección de búsqueda y botón Registrar Nueva Mascota -->
                <div class="d-flex justify-content-between mb-3">
                    <!-- Botón "Registrar Nueva Mascota" alineado a la izquierda -->
                    <a href="{{ route('mascotas.create') }}" class="btn btn-success" style="border-radius: 20px; padding: 10px 20px;">Registrar Nueva Mascota</a>

                    <!-- Cuadro de búsqueda alineado a la derecha -->
                    <div class="input-group" style="width: 300px;">
                        <input type="text" id="search" placeholder="Buscar mascota..." class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-0">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;" id="table-container">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Sexo</th>
                                <th>Características</th>
                                <th>Estado</th>
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
                                    <a href="{{ route('mascotas.show', $mascota) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('mascotas.edit', $mascota) }}" class="btn btn-primary btn-sm">Editar</a>
                                    <form action="{{ route('mascotas.destroy', $mascota) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Estás seguro?');">
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
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
                url: "{{ route('mascotas.index') }}",
                type: "GET",
                data: { search: query },
                success: function(mascotas) {
                    let rows = '';
                    if (mascotas.length > 0) {
                        mascotas.forEach(mascota => {
                            rows += `
                                <tr>
                                    <td>${mascota.nombre}</td>
                                    <td>${mascota.edad} años</td>
                                    <td>${mascota.sexo}</td>
                                    <td>${mascota.caracteristicas}</td>
                                    <td>${mascota.es_venta ? 'Venta' : 'Adopción'}</td>
                                    <td>
                                        <a href="/mascotas/${mascota.id}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="/mascotas/${mascota.id}/edit" class="btn btn-primary btn-sm">Editar</a>
                                        <form action="/mascotas/${mascota.id}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>`;
                        });
                    } else {
                        rows = `<tr><td colspan="6" class="text-center">No se encontraron resultados.</td></tr>`;
                    }
                    $('#table-container tbody').html(rows);
                }
            });
        });
    });
</script>
@endsection
