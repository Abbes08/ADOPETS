<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Sobrescribe el método attemptLogin para verificar si el usuario está activo.
     */
    protected function attemptLogin(Request $request)
    {
        // Encuentra el usuario con el correo proporcionado
        $user = User::where('email', $request->email)->first();

        // Si el usuario existe y está inactivo, evitar el inicio de sesión
        if ($user && !$user->is_active) {
            session()->flash('error', 'Este usuario está deshabilitado.'); // Guardar el mensaje de error en la sesión
            return false;
        }

        // Si el usuario está activo, intenta iniciar sesión normalmente
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    /**
     * Muestra un mensaje de error cuando el intento de inicio de sesión falla.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = session('error') ? ['email' => session('error')] : [
            'email' => trans('auth.failed'), // Mensaje de error genérico
        ];

        throw \Illuminate\Validation\ValidationException::withMessages($errors);
    }
    protected function authenticated(Request $request, $user)
{
    if (!$user->is_active) {
        Auth::logout();

        return redirect()->route('login')->withErrors([
            'email' => 'Tu cuenta debe ser aprobada por el administrador antes de iniciar sesión.',
        ]);
    }
}
protected function redirectTo()
{
    return '/home'; // Cambia esto a una ruta existente, como '/home' o '/perfil'.
}

}
