<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// Middleware de admin: protege rutas del panel de administración
// Uso en rutas: ->middleware('admin')
class VerificarAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Si no hay sesión, redirige al login
        if (!session('usuario_id')) {
            return redirect()->route('login');
        }

        $usuario = \App\Models\Usuario::find(session('usuario_id'));

        // Si no es administrador, redirige al inicio
        if (!$usuario || !$usuario->esAdmin()) {
            return redirect()->route('home')->with('error', 'No tenés acceso a esa sección.');
        }

        // Pasa el usuario admin al request
        $request->merge(['usuario_actual' => $usuario]);

        return $next($request);
    }
}
