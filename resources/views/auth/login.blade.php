@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #f5f9ff; margin-top: 150px;">
                <!-- Imagen superior -->
                <div class="card-header text-center" style="background: linear-gradient(90deg, #28a745, #007bff); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h3>{{ __('Iniciar Sesión') }}</h3>
                </div>

                <div class="card-body" style="background-image: url('/path/to/your/background.jpg'); background-size: cover; background-position: center;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="row mb-3">
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

                        <!-- Password -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end" >{{ __('Contraseña') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="border: 2px solid #004d40; border-radius: 5px;">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
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
                        </div>

                        <!-- Submit Button and Forgot Password Link -->
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success" style="background-color: #28a745; border: none; border-radius: 5px; padding: 10px 50px;">
                                        {{ __('Iniciar Sesión') }}
                                    </button>

                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="text-center mt-4">
                        <p >
                            ¿Aún no tienes una cuenta? <a href="{{ route('register') }}" style="color: #28a745;">Crea una nueva</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
