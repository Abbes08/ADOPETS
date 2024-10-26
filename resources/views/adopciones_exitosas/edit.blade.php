@extends('adminlte::page')

@section('title', 'Editar Adopción Exitosa')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 50%; padding: 0 15px;">
        <div class="card shadow" style="border-radius: 15px;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
                <h3 class="card-title">Editar Adopción Exitosa</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('adopciones_exitosas.update', $adopcion->adop_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="reseña">Reseña</label>
                        <textarea name="reseña" class="form-control" required>{{ $adopcion->reseña }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="fecha_reseña">Fecha de Reseña</label>
                        <input type="date" class="form-control" id="fecha_reseña" name="fecha_reseña" value="{{ \Carbon\Carbon::parse($adopcion->fecha_reseña)->toDateString() }}" required>
                    </div>

                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" class="form-control-file">
                        @if($adopcion->imagen)
                            <img src="{{ asset('storage/' . $adopcion->imagen) }}" class="img-fluid mt-2" alt="Imagen de adopción" style="max-width: 200px; border-radius: 10px; border: 2px solid #a8e063;">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" class="form-control">
                            <option value="1" {{ $adopcion->estado ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ !$adopcion->estado ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-success" style="border-radius: 20px; padding: 10px 20px;">Actualizar</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-5" style="border-radius: 20px; padding: 10px 20px;">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
