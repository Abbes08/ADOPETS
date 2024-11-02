@extends('adminlte::page')

@section('title', 'Editar Publicidad')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 60%;">
        <div class="card shadow" style="border-radius: 15px; overflow-y: auto; max-height: 80vh;">
            <div class="card-header text-center" style="background: linear-gradient(90deg, #a8e063, #56ab2f); color: white; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h3 class="card-title">Editar Publicidad</h3>
            </div>

            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-secondary mb-4" style="border-radius: 20px; padding: 10px 20px;">Volver</a>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('publicidad.update', $publicidad->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $publicidad->nombre) }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="precio">Precio</label>
                            <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" value="{{ old('precio', $publicidad->precio ?? '') }}">
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $publicidad->descripcion) }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', $publicidad->telefono) }}" required>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="user_id">Usuario</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                <option value="">Seleccionar Usuario</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $publicidad->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen">
                        @if($publicidad->imagen)
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$publicidad->imagen) }}" alt="Imagen actual" class="img-thumbnail" width="150">
                            </div>
                        @endif
                        @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="fechaInicio">Fecha de Inicio</label>
                            <input type="date" class="form-control @error('fechaInicio') is-invalid @enderror" id="fechaInicio" name="fechaInicio" value="{{ old('fechaInicio', $publicidad->fechaInicio) }}" required>
                            @error('fechaInicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="fechaFinal">Fecha Final</label>
                            <input type="date" class="form-control @error('fechaFinal') is-invalid @enderror" id="fechaFinal" name="fechaFinal" value="{{ old('fechaFinal', $publicidad->fechaFinal) }}" required>
                            @error('fechaFinal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                            <option value="activo" {{ old('estado', $publicidad->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('estado', $publicidad->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-success mr-2" style="border-radius: 20px; padding: 10px 20px;">Actualizar Publicidad</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary" style="border-radius: 20px; padding: 10px 20px;">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
