@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Detalles de la Adopción Exitosa</h1>
    <div class="mb-3">
        <label class="form-label">ID de Usuario</label>
        <p>{{ $exitosa->idUser }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <p>{{ $exitosa->nombre }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Historia</label>
        <p>{{ $exitosa->Historia }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Foto de la Mascota</label>
        <img src="{{ asset('storage/' . $exitosa->fotomascota) }}" width="200">
    </div>
    <div class="mb-3">
        <label class="form-label">Fecha</label>
        <p>{{ $exitosa->Fecha }}</p>
    </div>
    <a href="{{ route('exitosas.index') }}" class="btn btn-primary">Volver a la lista</a>
</div>
@endsection
