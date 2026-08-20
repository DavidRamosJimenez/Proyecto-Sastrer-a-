<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Usuario;
use App\Mail\PasswordResetEmail;

// Controlador de autenticación: login, registro, logout y recuperar contraseña
class AuthController extends Controller
{
    // Muestra el formulario de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesa el login: valida credenciales y crea sesión
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Ingresa tu correo.',
            'email.email' => 'El correo no es válido.',
            'password.required' => 'Ingresa tu contraseña.',
        ]);

        // Busca usuario activo por correo
        $usuario = Usuario::where('email', $request->email)
            ->where('activo', 1)
            ->first();

        // Compara password con hash SHA-256
        if (!$usuario || hash('sha256', $request->password) !== $usuario->password) {
            return back()->withErrors(['email' => 'Correo o contraseña incorrectos.'])->withInput($request->only('email'));
        }

        // Guarda el ID del usuario en sesión
        session(['usuario_id' => $usuario->id]);

        // Redirige según el rol
        if ($usuario->esAdmin()) {
            return redirect()->route('admin.servicios.index');
        }

        return redirect()->route('cliente.citas.index');
    }

    // Muestra el formulario de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Procesa el registro de un nuevo cliente
    public function register(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:usuarios,email',
            'password' => 'required|min:6|confirmed',
            'telefono' => 'nullable|max:20',
        ], [
            'nombre_completo.required' => 'Escribí tu nombre completo.',
            'email.required' => 'Escribí tu correo.',
            'email.email' => 'El correo no es válido.',
            'email.unique' => 'Ese correo ya está registrado.',
            'password.required' => 'Escribí una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Crea el usuario con rol 'cliente' y password hasheado
        Usuario::create([
            'nombre_completo' => $request->nombre_completo,
            'email' => $request->email,
            'password' => hash('sha256', $request->password),
            'telefono' => $request->telefono,
            'rol' => 'cliente',
        ]);

        return redirect()->route('login')->with('exito', 'Cuenta creada. Ya podés iniciar sesión.');
    }

    // Muestra el formulario "Olvidé mi contraseña"
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // Genera un token y envía correo con link de recuperación
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Escribí tu correo.',
            'email.email' => 'El correo no es válido.',
        ]);

        // Busca el usuario (activo o no, para no revelar si existe)
        $usuario = Usuario::where('email', $request->email)->first();

        // Siempre muestra el mismo mensaje (por seguridad)
        if (!$usuario) {
            return redirect()->route('login')->with('exito', 'Si ese correo está registrado, te enviamos un enlace para recuperar tu contraseña.');
        }

        // Genera token único y guarda expiración (1 hora)
        $token = bin2hex(random_bytes(32));
        $usuario->update([
            'reset_token' => $token,
            'reset_token_expires_at' => now()->addHour(),
        ]);

        // Envía el correo con el link de recuperación
        Mail::to($usuario->email)->send(new PasswordResetEmail($usuario, $token));

        return redirect()->route('login')->with('exito', 'Te enviamos un correo con el enlace para recuperar tu contraseña. Revisá tu bandeja de entrada.');
    }

    // Muestra el formulario para escribir la nueva contraseña
    public function showResetPassword($token)
    {
        // Busca usuario con ese token y que no haya expirado
        $usuario = Usuario::where('reset_token', $token)
            ->where('reset_token_expires_at', '>', now())
            ->first();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'El enlace expiró o no es válido. Pedí uno nuevo.');
        }

        return view('auth.reset-password', compact('token'));
    }

    // Valida el token y actualiza la contraseña
    public function resetPassword(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Escribí una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Busca usuario con token válido
        $usuario = Usuario::where('reset_token', $token)
            ->where('reset_token_expires_at', '>', now())
            ->first();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'El enlace expiró o no es válido. Pedí uno nuevo.');
        }

        // Actualiza contraseña y limpia el token
        $usuario->update([
            'password' => hash('sha256', $request->password),
            'reset_token' => null,
            'reset_token_expires_at' => null,
        ]);

        return redirect()->route('login')->with('exito', 'Contraseña actualizada. Ya podés iniciar sesión.');
    }

    // Cierra la sesión y redirige al inicio
    public function logout()
    {
        session()->forget('usuario_id');
        return redirect()->route('home');
    }
}
