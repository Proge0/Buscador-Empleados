<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Obtener el rol del usuario autenticado
        $userRole = auth()->user()->rol;

        // Comparar con el rol esperado
        if ($userRole == $role) {
            // Dejar pasar la petición
            return $next($request);
        } else {
            // Redirigir al usuario
            return redirect('auth/home');
        }
    }
}
