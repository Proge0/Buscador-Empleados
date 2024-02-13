<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Este middleware verifica si el usuario está autenticado y lo redirige al login si no lo está
class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::check()) {
            if ($request->routeIs('auth.*')) {
                return redirect()->route('auth.login')->with('fail', 'Debes estar logeado');
            }
        }
        return $next($request);
    }
}
