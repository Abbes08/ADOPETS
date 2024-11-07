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
                <a href="{{ route('adopciones_exitosas.create') }}" class="btn btn-success mb-3">Nueva Adopción Exitosa</a>

                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
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
