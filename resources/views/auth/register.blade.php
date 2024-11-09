@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center"style="height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <!-- Card principal -->
            <div class="card" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #f5f9ff; height: 80vh; width: 150%; max-width: 600px; margin-top: 50px;">

                <!-- Encabezado -->
                <div class="card-header text-center" style="background: linear-gradient(90deg, #28a745, #d4edda); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h3>{{ __('Registrar Usuario') }}</h3>
                </div>

                <!-- Cuerpo del card -->
                <div class="card-body" style="overflow-y: auto;">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                        
                        <!-- Campo Nombre -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="border: 2px solid #004d40; border-radius: 5px;">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo Apellidos -->
                        <div class="row mb-3">
                            <label for="surname" class="col-md-4 col-form-label text-md-end">{{ __('Apellidos') }}</label>
                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required style="border: 2px solid #004d40; border-radius: 5px;">
                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo Género -->
                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Género') }}</label>
                            <div class="col-md-6">
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required style="border: 2px solid #004d40; border-radius: 5px;">
                                    <option value="" disabled selected>Seleccionar</option>
                                    <option value="Masculino" {{ old('gender') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ old('gender') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="Otro" {{ old('gender') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo Teléfono -->
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Número de Teléfono') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" style="border: 2px solid #004d40; border-radius: 5px;">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo Dirección -->
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Dirección') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" style="border: 2px solid #004d40; border-radius: 5px;">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo Correo Electrónico -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="border: 2px solid #004d40; border-radius: 5px;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo Contraseña -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="border: 2px solid #004d40; border-radius: 5px;">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Campo Confirmar Contraseña -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="border: 2px solid #004d40; border-radius: 5px;">
                            </div>
                        </div>

                       <!-- Campo de selección para el rol -->
                       <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Tipo de usuario') }}</label>
                            <div class="col-md-6">
                            <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
    <option value="" disabled selected>Seleccionar</option>
    <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Invitado</option>
    <option value="premium" {{ old('role') == 'premium' ? 'selected' : '' }}>Premium</option>
</select>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
<!-- reCAPTCHA -->
<div class="form-group row mb-3">
        <div class="col-md-6 offset-md-4">
            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}"></div>
            @error('g-recaptcha-response')
                <span class="invalid-feedback" style="display: block;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Botón de registro -->
    <div class="row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-success" style="background-color: #28a745; border: none; border-radius: 5px; padding: 10px 50px;">
                {{ __('Regístrate') }}
            </button>
        </div>
    </div>
</form>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection