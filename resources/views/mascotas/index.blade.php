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
                    <a href="{{ route('mascotas.create') }}" class="btn btn-success" style="border-radius: 20px; padding: 10px 20px;">Registrar Nueva Mascota</a>

                    <!-- Cuadro de búsqueda -->
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
                            @forelse ($mascotas as $mascota)
                                <tr>
                                    <td>{{ $mascota->nombre }}</td>
                                    <td>{{ $mascota->edad }} años</td>
                                    <td>{{ $mascota->sexo }}</td>
                                    <td>{{ $mascota->caracteristicas }}</td>
                                    <td>
                                        <span class="badge badge-{{ $mascota->activo ? 'success' : 'secondary' }}">
                                            {{ $mascota->activo ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('mascotas.show', $mascota) }}" class="btn btn-info btn-sm" style="border-radius: 5px;">Ver</a>
                                        <a href="{{ route('mascotas.edit', $mascota) }}" class="btn btn-primary btn-sm" style="border-radius: 5px;">Editar</a>
                                        <button class="btn btn-danger btn-sm" style="border-radius: 5px;" onclick="confirmDelete('{{ route('mascotas.destroy', $mascota) }}')">Eliminar</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No hay mascotas registradas en este momento.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Enlaces de paginación -->
                    <div class="d-flex justify-content-center mt-3" id="pagination-links">
                        {{ $mascotas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
                url: "{{ route('mascotas.index') }}",
                type: "GET",
                data: { search: query },
                success: function(data) {
                    let rows = '';
                    data.mascotas.data.forEach(mascota => {
                        rows += `
                            <tr>
                                <td>${mascota.nombre}</td>
                                <td>${mascota.edad} años</td>
                                <td>${mascota.sexo}</td>
                                <td>${mascota.caracteristicas}</td>
                                <td>
                                    <span class="badge badge-${mascota.activo ? 'success' : 'secondary'}">
                                        ${mascota.activo ? 'Activo' : 'Inactivo'}
                                    </span>
                                </td>
                                <td>
                                    <a href="/mascotas/${mascota.id}" class="btn btn-info btn-sm" style="border-radius: 5px;">Ver</a>
                                    <a href="/mascotas/${mascota.id}/edit" class="btn btn-primary btn-sm" style="border-radius: 5px;">Editar</a>
                                    <button class="btn btn-danger btn-sm" style="border-radius: 5px;" onclick="confirmDelete('/mascotas/${mascota.id}')">Eliminar</button>
                                </td>
                            </tr>`;
                    });

                    // Actualizar tabla y paginación
                    $('#table-container tbody').html(rows);
                    $('#pagination-links').html(data.links);
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
@endsection
