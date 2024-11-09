<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        // Permitir acceso si es el administrador por correo o tiene un rol permitido
        $user = Auth::user();
        if ($user->email === 'adminadopets@gmail.com' || in_array($user->role, $roles)) {
            return $next($request);
        }

        // Denegar acceso si no cumple con los criterios
        abort(403, 'No tienes permiso para acceder a esta página.');
    }
}
