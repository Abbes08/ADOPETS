@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="height: 100vh;">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <!-- Card principal -->
                <div class="card" style="border-radius: 15px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); background-color: #f5f9ff; height: 60vh; width: 100%; max-width: 500px; margin-top: 100px;">

                    <!-- Encabezado -->
                    <div class="card-header text-center" style="background: linear-gradient(90deg, #28a745, #d4edda); border-top-left-radius: 15px; border-top-right-radius: 15px; padding: 20px;">
                        <h3 style="margin: 0; font-size: 1.5rem;">{{ __('Iniciar Sesión') }}</h3>
                    </div>

                    <!-- Cuerpo de la tarjeta -->
                    <div class="card-body" style="overflow-y: auto; padding: 30px;">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="row mb-4">
    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>
    <div class="col-md-7">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border: 2px solid #004d40; border-radius: 5px; font-size: 1rem;">
        
        <!-- Muestra el mensaje de error si el usuario está deshabilitado -->
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


                            <!-- Password -->
                            <div class="row mb-4">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>
                                <div class="col-md-7">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="border: 2px solid #004d40; border-radius: 5px; font-size: 1rem;">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Recordarme y Olvidaste tu Contraseña -->
                            <div class="text-center mt-3">
                                <div class="form-check-center mb-4">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                    
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #28a745;">
                                            {{ __('Olvidaste tu contraseña?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Botón de Iniciar Sesión -->
                            <div class="mb-0 text-center">
                                <button type="submit" class="btn btn-success" style="background-color: #28a745; border: none; border-radius: 5px; padding: 12px 40px; font-size: 1.1rem;">
                                    {{ __('Iniciar Sesión') }}
                                </button>
                            </div>
                        </form>

                        <!-- Enlace para Registro -->
                        <div class="text-center mt-4">
                            <p>
                                ¿Aún no tienes una cuenta? <a href="{{ route('register') }}" style="color: #28a745;">Crea una nueva</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
