@extends('adminlte::page')

@section('title', 'Publicidad')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Añadir jQuery -->

@if(auth()->check() && (auth()->user()->email === 'adminadopets@gmail.com' || auth()->user()->role === 'premium'))
    <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="container" style="max-width: 90%;">
            <div class="card shadow" style="border-radius: 15px;">
                <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
                    <h3 class="card-title">Lista de Publicidades</h3>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- Sección de búsqueda y botón Crear Publicidad -->
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('publicidad.create') }}" class="btn btn-success" style="border-radius: 20px; padding: 10px 20px;">Crear Publicidad</a>
                        <div class="input-group" style="width: 300px;">
                            <input type="text" id="search" placeholder="Buscar publicidad..." class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text bg-white border-0">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de Publicidades -->
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;" id="table-container">
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
                                @foreach($publicidades as $publicidad)
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
                                            <form action="{{ route('publicidad.destroy', $publicidad->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta publicidad?');">
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

                    <!-- Paginación -->
                    <div class="d-flex justify-content-center mt-3" id="pagination-container">
                        {{ $publicidades->appends(['search' => request('search')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Acceso Denegado',
            text: 'No tienes acceso a esta sección, porque no eres un usuario premium. Comunícate con el administrador.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            window.location.href = '/home';
        });
    </script>
@endif

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
                url: "{{ route('publicidad.index') }}",
                type: "GET",
                data: { search: query },
                success: function(data) {
                    $('#table-container').html($(data).find('#table-container').html()); // Actualiza la tabla
                    $('#pagination-container').html($(data).find('#pagination-container').html()); // Actualiza la paginación
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
