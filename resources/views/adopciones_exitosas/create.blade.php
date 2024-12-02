@extends('adminlte::page')

@section('title', 'Nueva Adopción Exitosa')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 50%; padding: 0 15px;">
        <div class="card shadow" style="border-radius: 15px;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); border-top-left-radius: 15px; border-top-right-radius: 15px; color: white;">
                <h3 class="card-title">Registrar Adopción Exitosa</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('adopciones_exitosas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                   <!-- Selección de Mascota -->
<div class="form-group">
    <label for="mascota_id">Seleccione una Mascota</label>
    <select name="mascota_id" class="form-control" required>
        <option value="">Seleccione una mascota</option>
        @foreach ($mascotas as $mascota)
            <option value="{{ $mascota->mascota_id }}">{{ $mascota->nombre }}</option>
        @endforeach
    </select>
</div>


                    <!-- Reseña -->
                    <div class="form-group">
                        <label for="reseña">Reseña</label>
                        <textarea name="reseña" class="form-control" rows="4" required>{{ old('reseña') }}</textarea>
                    </div>

                    <!-- Fecha de Reseña -->
                    <div class="form-group">
                        <label for="fecha_reseña">Fecha de Reseña</label>
                        <input type="date" class="form-control" id="fecha_reseña" name="fecha_reseña" value="{{ old('fecha_reseña') }}" required>
                    </div>

                    <!-- Imagen -->
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" class="form-control-file">
                    </div>

                    <!-- Estado -->
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" class="form-control" required>
                            <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="form-group d-flex justify-content-end">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mr-2" style="border-radius: 20px; padding: 10px 20px;">Volver</a>
                        <button type="submit" class="btn btn-success" style="border-radius: 20px; padding: 10px 20px;">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
