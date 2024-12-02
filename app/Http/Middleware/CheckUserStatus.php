<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
{
    $user = Auth::user();

    if ($user) {
        // Revisar si el usuario está activo
        if (!$user->is_active) {
            Auth::logout();
            session()->flash('premium_alert', 'Tu cuenta está deshabilitada.');
            return redirect()->route('login');
        }

        // Revisar si el usuario premium está aprobado
        if ($user->role === 'premium' && !$user->premium_approved) {
            Auth::logout();
            session()->flash('premium_alert', 'Tu cuenta premium es de pago, necesitas la aprobación del administrador.');
            session()->flash('whatsapp_url', 'https://wa.me/86853430?text=Hola, necesito ayuda para activar mi cuenta premium en el sistema.');
            return redirect()->route('login');
        }
    }

    return $next($request);
}

}
