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
            // Revisar si el usuario está activo y aprobado para premium
            if (!$user->is_active) {
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => 'Tu cuenta está deshabilitada.']);
            }

            if ($user->role === 'premium' && !$user->premium_approved) {
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => 'Tu cuenta premium necesita aprobación del administrador.']);
            }
        }

        return $next($request);
    }
}
