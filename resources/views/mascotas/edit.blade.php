@extends('adminlte::page')

@section('title', 'Editar Mascota')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 60%;">
        <div class="card shadow" style="border-radius: 15px; overflow-y: auto; max-height: 80vh;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); color: white; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h3 class="card-title">Editar Mascota</h3>
            </div>

            <div class="card-body">
                <!-- Mostrar mensajes de error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('mascotas.update', $mascota->mascota_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Información básica -->
                    <div class="form-group row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $mascota->nombre) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edad">Edad</label>
                            <input type="number" name="edad" class="form-control" value="{{ old('edad', $mascota->edad) }}" required>
                        </div>
                    </div>

                    <!-- Sexo y Teléfono -->
                    <div class="form-group row">
                        <div class="col-md-6 mb-3">
                            <label for="sexo">Sexo</label>
                            <select name="sexo" class="form-control" required>
                                <option value="Macho" {{ old('sexo', $mascota->sexo) == 'Macho' ? 'selected' : '' }}>Macho</option>
                                <option value="Hembra" {{ old('sexo', $mascota->sexo) == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', $mascota->telefono) }}" required>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Características -->
                    <div class="form-group mb-3">
                        <label for="caracteristicas">Características</label>
                        <textarea name="caracteristicas" class="form-control" required>{{ old('caracteristicas', $mascota->caracteristicas) }}</textarea>
                    </div>

                    <!-- Checkbox para venta -->
                    <div class="form-group mb-3">
                        <label for="es_venta">¿Está en venta?</label>
                        <div class="form-check">
                            <input type="checkbox" name="es_venta" id="es_venta" value="1" class="form-check-input" {{ old('es_venta', $mascota->es_venta) ? 'checked' : '' }}>
                            <label class="form-check-label" for="es_venta">Sí</label>
                        </div>
                    </div>

                    <!-- Campos adicionales solo si es venta -->
                    <div class="form-group" id="venta_fields" style="{{ old('es_venta', $mascota->es_venta) ? 'display:block;' : 'display:none;' }}">
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label for="raza">Raza</label>
                                <input type="text" name="raza" class="form-control" value="{{ old('raza', $mascota->raza) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="precio">Precio</label>
                                <input type="number" name="precio" class="form-control" value="{{ old('precio', $mascota->precio) }}">
                            </div>
                        </div>
                    </div>

                    <!-- Subir nuevas imágenes -->
                    <div class="form-group mb-3">
                        <label for="fotos">Subir nuevas imágenes</label>
                        <input type="file" name="fotos[]" class="form-control" multiple>
                    </div>

                    <!-- Imágenes actuales -->
                    <div class="form-group mb-3">
                        <label>Imágenes actuales</label>
                        <div class="row">
                            @foreach($mascota->fotos as $foto)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset('storage/' . $foto) }}" class="img-thumbnail" alt="Imagen de la mascota" width="150">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="eliminar_fotos[]" value="{{ $foto }}">
                                        <label class="form-check-label">
                                            Eliminar esta imagen
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block mt-3" style="border-radius: 20px; padding: 10px 20px;">Actualizar Mascota</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Mostrar los campos de venta si se marca el checkbox
    document.getElementById('es_venta').addEventListener('change', function() {
        var ventaFields = document.getElementById('venta_fields');
        ventaFields.style.display = this.checked ? 'block' : 'none';
    });
</script>

@endsection
