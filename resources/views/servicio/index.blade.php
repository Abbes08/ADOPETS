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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Mostrar alerta de éxito o error basado en la sesión
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: "{{ session('success') }}",
            confirmButtonColor: '#28a745'
        });
    @elseif(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}",
            confirmButtonColor: '#d33'
        });
    @endif

    // Confirmación de eliminación
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
