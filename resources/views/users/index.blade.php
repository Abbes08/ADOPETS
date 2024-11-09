@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 90%;">
        <div class="card shadow" style="border-radius: 15px;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
                <h3 class="card-title">Lista de Usuarios</h3>
            </div>

            <div class="card-body">
<<<<<<< HEAD
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Sección de búsqueda -->
                <div class="d-flex justify-content-between mb-3">
=======
                <div class="text-right mb-3">
>>>>>>> 732668186e9a27aa232564c4e68e74d9f9feaf5f
                    <a href="{{ route('users.create') }}" class="btn btn-success" style="border-radius: 20px; padding: 10px 20px;">Crear Usuario</a>
                    <div class="input-group" style="width: 300px;">
                        <input type="text" id="search" placeholder="Buscar usuario..." class="form-control">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-0">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Contenedor de la tabla de usuarios -->
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-striped table-hover" id="users-table">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Género</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Correo Electrónico</th>
                                <th>Habilitar/Deshabilitar</th>
                                <th>Aprobar/Desaprobar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->surname }}</td>
                                    <td>{{ ucfirst($user->gender) }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td>
<<<<<<< HEAD
                                        @if ($user->is_active)
                                            <form action="{{ route('users.deactivate', $user->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-danger btn-sm">Deshabilitar</button>
                                            </form>
                                        @else
                                            <form action="{{ route('users.activate', $user->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm">Habilitar</button>
                                            </form>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($user->role === 'premium')
                                            @if ($user->premium_approved)
                                                <form action="{{ route('users.disapprovePremium', $user->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-warning btn-sm">Desaprobar Premium</button>
                                                </form>
                                            @else
                                                <form action="{{ route('users.approvePremium', $user->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm">Aprobar Premium</button>
                                                </form>
                                            @endif
                                        @endif
=======
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm" style="border-radius: 5px;">Editar</a>
                                        <button class="btn btn-danger btn-sm" style="border-radius: 5px;" onclick="confirmDelete('{{ route('users.destroy', $user) }}')">Eliminar</button>
>>>>>>> 732668186e9a27aa232564c4e68e74d9f9feaf5f
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

<<<<<<< HEAD
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
                url: "{{ route('users.index') }}",
                type: "GET",
                data: { search: query },
                success: function(users) {
                    let rows = '';
                    users.forEach(user => {
                        rows += `
                            <tr>
                                <td>${user.name}</td>
                                <td>${user.surname}</td>
                                <td>${user.gender.charAt(0).toUpperCase() + user.gender.slice(1)}</td>
                                <td>${user.phone}</td>
                                <td>${user.address}</td>
                                <td>${user.email}</td>
                                <td>
                                    <form action="/users/${user.id}/${user.is_active ? 'deactivate' : 'activate'}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn ${user.is_active ? 'btn-danger' : 'btn-success'} btn-sm">
                                            ${user.is_active ? 'Deshabilitar' : 'Habilitar'}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    ${user.role === 'premium' ? `
                                        <form action="/users/${user.id}/${user.premium_approved ? 'disapprovePremium' : 'approvePremium'}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn ${user.premium_approved ? 'btn-warning' : 'btn-primary'} btn-sm">
                                                ${user.premium_approved ? 'Desaprobar Premium' : 'Aprobar Premium'}
                                            </button>
                                        </form>` : ''}
                                </td>
                            </tr>`;
                    });
                    $('#users-table tbody').html(rows);
                }
            });
        });
    });
=======
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
>>>>>>> 732668186e9a27aa232564c4e68e74d9f9feaf5f
</script>
@stop
