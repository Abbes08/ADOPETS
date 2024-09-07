@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content')
    <div class="container">
   
        <h1>Editar Usuario</h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Volver</a>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="surname">Apellido</label>
                <input type="text" class="form-control" id="surname" name="surname" value="{{ $user->surname }}" required>
            </div>
            <div class="form-group">
                <label for="gender">Sexo</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">Selecciona</option>
                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Masculino</option>
                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Femenino</option>
                    <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Dejar en blanco para no cambiar">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@stop
