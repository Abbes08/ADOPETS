@extends('adminlte::page')

@section('title', 'Registrar Mascota')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 60%;">
        <div class="card shadow" style="border-radius: 15px; overflow-y: auto; max-height: 80vh;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); color: white; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h3 class="card-title">Registrar Nueva Mascota</h3>
            </div>

            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-secondary mb-5" style="border-radius: 20px; padding: 10px 20px;">Volver</a>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('mascotas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edad">Edad</label>
                            <input type="number" name="edad" class="form-control" value="{{ old('edad') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="sexo">Sexo</label>
                            <select name="sexo" class="form-control" required>
                                <option value="Macho" {{ old('sexo') == 'Macho' ? 'selected' : '' }}>Macho</option>
                                <option value="Hembra" {{ old('sexo') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="whatsapp_link">Enlace de WhatsApp</label>
                            <input type="url" name="whatsapp_link" class="form-control" value="{{ old('whatsapp_link') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="caracteristicas">Características</label>
                        <textarea name="caracteristicas" class="form-control" required>{{ old('caracteristicas') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="es_venta">¿Está en venta?</label>
                        <input type="checkbox" name="es_venta" id="es_venta" value="1" {{ old('es_venta') ? 'checked' : '' }}>
                    </div>

                    <div class="form-group" id="venta_fields" style="{{ old('es_venta') ? 'display:block;' : 'display:none;' }}">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="raza">Raza</label>
                                <input type="text" name="raza" class="form-control" value="{{ old('raza') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="precio">Precio</label>
                                <input type="number" name="precio" class="form-control" value="{{ old('precio') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fotos">Subir nuevas imágenes</label>
                        <input type="file" name="fotos[]" class="form-control" multiple accept="image/*" id="new_images">
                    </div>

                    <div class="form-group">
                        <label>Imágenes actuales</label>
                        <div class="row" id="current_images">
                            @if(isset($mascota))
                                @foreach($mascota->fotos as $foto)
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/' . $foto->ruta) }}" class="img-thumbnail" alt="Imagen de la mascota" width="150">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="eliminar_fotos[]" value="{{ $foto->id }}">
                                            <label class="form-check-label">
                                                Eliminar esta imagen
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="new_images_preview" class="row mt-2"></div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block" style="border-radius: 20px; padding: 10px 20px;">Registrar Mascota</button>
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

    // Vista previa de las nuevas imágenes
    document.getElementById('new_images').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('new_images_preview');
        previewContainer.innerHTML = ''; // Limpiar el contenedor de previsualización

        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const div = document.createElement('div');
                div.classList.add('col-md-3');
                div.innerHTML = `
                    <img src="${e.target.result}" class="img-thumbnail" alt="Vista previa" width="150">
                `;
                previewContainer.appendChild(div);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
