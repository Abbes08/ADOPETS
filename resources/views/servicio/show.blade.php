@extends('adminlte::page')

@section('title', 'Detalles del Servicio')

@section('content_header')
    <h1>Detalles del Servicio</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $servicio->nombre }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Descripción:</strong> {{ $servicio->descripcion }}</p>
            <p><strong>Estado:</strong> {{ $servicio->estado ? 'Activo' : 'Inactivo' }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('servicio.index') }}" class="btn btn-secondary">Volver al listado</a>
            <a href="{{ route('servicio.edit', $servicio->servicio_id) }}" class="btn btn-warning">Editar Servicio</a
