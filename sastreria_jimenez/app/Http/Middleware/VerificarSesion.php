<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// Middleware de sesión: protege rutas que requieren estar logueado
// Uso en rutas: ->middleware('sesion')
class VerificarSesion
{
    public function handle(Request $request, Closure $next)
    {
        // Si no hay sesión activa, redirige al login
        if (!session('usuario_id')) {
            return redirect()->route('login')->with('error', 'Necesitás iniciar sesión.');
        }

        $usuario = \App\Models\Usuario::find(session('usuario_id'));

        // Si el usuario fue eliminado o desactivado, cierra sesión
        if (!$usuario || !$usuario->activo) {
            session()->forget('usuario_id');
            return redirect()->route('login')->with('error', 'Tu cuenta no está disponible.');
        }

        // Pasa el usuario al request para que esté disponible en controladores
        $request->merge(['usuario_actual' => $usuario]);

        return $next($request);
    }
}
