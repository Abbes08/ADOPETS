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
                            @forelse($publicidades as $publicidad)
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
                                        <button class="btn btn-danger btn-sm" style="border-radius: 5px;" onclick="confirmDelete('{{ route('publicidad.destroy', $publicidad->id) }}')">Eliminar</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No hay publicidades registradas en este momento.</td>
                                </tr>
                            @endforelse
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

