@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #f5f9ff; margin-top: 200px;"> <!-- Cambié el margin-top a 200px -->
                <!-- Encabezado con estilo -->
                <div class="card-header text-center" style="background: linear-gradient(90deg, #28a745, #d4edda); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h3 class="card-title">{{ __('Cambiar Contraseña') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Campo de correo electrónico -->
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border: 2px solid #004d40; border-radius: 5px;">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Botón de envío -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success" style="background-color: #28a745; border: none; border-radius: 5px; padding: 10px 20px;">
                                    {{ __('Enviar cambio de contraseña') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Enlace para regresar al login -->
                    <div class="text-center mt-4">
                        <p>
                            <a href="{{ route('login') }}" style="color: #28a745;">Regresar al login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
