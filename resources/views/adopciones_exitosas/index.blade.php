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
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Botón Nueva Adopción y campo de búsqueda -->
                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('adopciones_exitosas.create') }}" class="btn btn-success">Nueva Adopción Exitosa</a>
                    <div class="input-group" style="width: 300px;">
                        <input type="text" id="search" placeholder="Buscar adopción..." class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-0">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Adopciones Exitosas -->
                <div class="table-responsive" id="table-container">
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
                            @forelse ($adopciones as $adopcion)
                                <tr>
                                    <td>{{ $adopcion->mascota->nombre }}</td>
                                    <td>{{ $adopcion->reseña }}</td>
                                    <td>{{ $adopcion->fecha_reseña->format('d-m-Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $adopcion->estado ? 'success' : 'secondary' }}">
                                            {{ $adopcion->estado ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('adopciones_exitosas.show', $adopcion->adop_id) }}" class="btn btn-info btn-sm" style="border-radius: 5px;">Ver</a>
                                        <a href="{{ route('adopciones_exitosas.edit', $adopcion->adop_id) }}" class="btn btn-primary btn-sm" style="border-radius: 5px;">Editar</a>
                                        <button class="btn btn-danger btn-sm" style="border-radius: 5px;" onclick="confirmDelete('{{ route('adopciones_exitosas.destroy', $adopcion->adop_id) }}')">Eliminar</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay adopciones exitosas registradas en este momento.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
                url: "{{ route('adopciones_exitosas.index') }}",
                type: "GET",
                data: { search: query },
                success: function(adopciones) {
                    let rows = '';
                    if (adopciones.length > 0) {
                        adopciones.forEach(adopcion => {
                            rows += `
                                <tr>
                                    <td>${adopcion.mascota ? adopcion.mascota.nombre : ''}</td>
                                    <td>${adopcion.reseña}</td>
                                    <td>${new Date(adopcion.fecha_reseña).toLocaleDateString()}</td>
                                    <td><span class="badge badge-${adopcion.estado ? 'success' : 'secondary'}">${adopcion.estado ? 'Activo' : 'Inactivo'}</span></td>
                                    <td>
                                        <a href="/adopciones_exitosas/${adopcion.adop_id}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="/adopciones_exitosas/${adopcion.adop_id}/edit" class="btn btn-primary btn-sm">Editar</a>
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete('/adopciones_exitosas/${adopcion.adop_id}')">Eliminar</button>
                                    </td>
                                </tr>`;
                        });
                    } else {
                        rows = `<tr><td colspan="5" class="text-center">No se encontraron resultados.</td></tr>`;
                    }
                    $('#table-container tbody').html(rows);
                }
            });
        });
    });

    // Confirmación de eliminación con SweetAlert
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
