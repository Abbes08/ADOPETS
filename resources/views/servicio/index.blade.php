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

                <!-- Botón Crear Servicio y barra de búsqueda -->
                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('servicio.create') }}" class="btn btn-success" style="border-radius: 20px; padding: 10px 20px;">Crear Servicio</a>
                    <div class="input-group" style="width: 300px;">
                        <input type="text" id="search" placeholder="Buscar servicio..." class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-0">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Servicios -->
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;" id="table-container">
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
                                        <button class="btn btn-danger btn-sm" style="border-radius: 5px;" onclick="confirmDelete('{{ route('servicio.destroy', $servicio->id) }}')">Eliminar</button>
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
                url: "{{ route('servicio.index') }}",
                type: "GET",
                data: { search: query },
                success: function(servicios) {
                    let rows = '';
                    servicios.forEach(servicio => {
                        rows += `
                            <tr>
                                <td>${servicio.nombre}</td>
                                <td>${servicio.descripcion}</td>
                                <td>
                                    <span class="badge badge-${servicio.estado ? 'success' : 'secondary'}">
                                        ${servicio.estado ? 'Activo' : 'Inactivo'}
                                    </span>
                                </td>
                                <td>
                                    <a href="/servicio/${servicio.id}/edit" class="btn btn-primary btn-sm" style="border-radius: 5px;">Editar</a>
                                    <form action="/servicio/${servicio.id}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este servicio?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 5px;">Eliminar</button>
                                    </form>
                                </td>
                            </tr>`;
                    });
                    $('#table-container tbody').html(rows);
                }
            });
        });
    });

    function confirmDelete(url) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.action = url;
                form.method = 'POST';
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@stop
