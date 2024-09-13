@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
    <div class="container">
        <h1>Crear Usuario</h1>

        <!-- Botón para volver a la pantalla anterior -->
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Volver</a>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="surname">Apellido</label>
                <input type="text" class="form-control" id="surname" name="surname" required>
            </div>
            <div class="form-group">
                <label for="gender">Sexo</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">Selecciona</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="other">Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
           
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-success">Crear</button>
        </form>
    </div>
@stop
