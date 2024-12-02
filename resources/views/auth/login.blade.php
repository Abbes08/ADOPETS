@extends('layouts.app')

@section('content')
@if(session('premium_alert'))
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'info',
                title: 'Atención',
                text: "{{ session('premium_alert') }}",
                confirmButtonText: 'Contactar en WhatsApp',
                confirmButtonColor: '#4CAF50',
                showCancelButton: true,
                cancelButtonText: 'Cerrar',
                preConfirm: () => {
                    window.open("{{ session('whatsapp_url') }}", "_blank");
                }
            });
        });
    </script>
@endif

<div class="container">
    <div class="row justify-content-center" style="height: 100vh;">
        <div class="col-md-5">
            <!-- Card de inicio de sesión -->
            <div class="card" style="border-radius: 15px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); background-color: #f5f9ff; width: 100%; max-width: 800px; margin-top: 200px;">
                <div class="card-header text-center" style="background: linear-gradient(90deg, #28a745, #d4edda); border-top-left-radius: 15px; border-top-right-radius: 15px; padding: 20px;">
                    <h3 style="margin: 0; font-size: 1.5rem;">{{ __('Iniciar Sesión') }}</h3>
                </div>
                <div class="card-body" style="overflow-y: auto; padding: 30px;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email -->
                        <div class="row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>
                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border: 2px solid #004d40; border-radius: 5px; font-size: 1rem;">
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
@endsection
