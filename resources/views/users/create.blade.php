@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 400px;">  <!-- Aumenta el max-width aquí -->
        <div class="card shadow" style="border-radius: 15px;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
                <h3 class="card-title">Crear Usuario</h3>
            </div>

            <div class="card-body" style="max-height: 80vh; overflow-y: auto;"> <!-- Aumenta el max-height aquí -->
                <!-- Botón para volver a la pantalla anterior -->
                <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3" style="border-radius: 20px;">Volver</a>

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required style="max-width: 300px;">
                    </div>
                    <div class="form-group">
                        <label for="surname">Apellido</label>
                        <input type="text" class="form-control" id="surname" name="surname" required style="max-width: 300px;">
                    </div>
                    <div class="form-group">
                        <label for="gender">Género</label>
                        <select class="form-control" id="gender" name="gender" required style="max-width: 300px;">
                            <option value="">Selecciona</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required style="max-width: 300px;">
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" required style="max-width: 300px;">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required style="max-width: 300px;">
                    </div>
                    <div class="form-group">
    <label for="password">Contraseña</label>
    <input type="password" class="form-control" id="password" name="password" required style="max-width: 300px;">
</div>
<div class="form-group">
    <label for="password_confirmation">Confirmar Contraseña</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required style="max-width: 300px;">
</div>
<div class="form-group">
    <label for="role">Rol</label>
    <select class="form-control" id="role" name="role" required style="max-width: 300px;">
        <option value="">Selecciona un rol</option>
        <option value="guest">Invitado</option>
        <option value="premium">Premium</option>
    </select>
</div>


                    <button type="submit" class="btn btn-success" style="border-radius: 20px;">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
