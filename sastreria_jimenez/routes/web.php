<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\CitaController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS (sin sesión)
|--------------------------------------------------------------------------
*/

// Página de inicio con info de la sastrería
Route::get('/', [HomeController::class, 'index'])->name('home');

// Catálogo público de servicios
Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');

/*
|--------------------------------------------------------------------------
| RUTAS DE AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Recuperar contraseña: pedir enlace
Route::get('/olvidar-contrasena', [AuthController::class, 'showForgotPassword'])->name('password.forgot');
Route::post('/olvidar-contrasena', [AuthController::class, 'sendResetLink'])->name('password.send');
// Recuperar contraseña: nueva contraseña
Route::get('/recuperar/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset.show');
Route::post('/recuperar/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');

/*
|--------------------------------------------------------------------------
| RUTAS DEL CLIENTE (requieren sesión)
|--------------------------------------------------------------------------
*/

Route::prefix('cliente')->middleware('sesion')->group(function () {
    // Ver mis citas
    Route::get('/citas', [CitaController::class, 'index'])->name('cliente.citas.index');
    // Formulario para agendar cita con un servicio
    Route::get('/citas/nueva/{servicio_id}', [CitaController::class, 'create'])->name('cliente.citas.create');
    // Guardar la cita (un solo servicio)
    Route::post('/citas', [CitaController::class, 'store'])->name('cliente.citas.store');
    // Carrito de arreglos: ver resumen y reservar varios servicios
    Route::get('/citas/carrito', [CitaController::class, 'carrito'])->name('cliente.citas.carrito');
    // Guardar carrito (varios servicios a la vez)
    Route::post('/citas/carrito', [CitaController::class, 'storeCarrito'])->name('cliente.citas.storeCarrito');
    // Cancelar una cita pendiente
    Route::post('/citas/{id}/cancelar', [CitaController::class, 'cancel'])->name('cliente.citas.cancel');
});

/*
|--------------------------------------------------------------------------
| RUTAS DEL ADMINISTRADOR (requieren sesión + rol admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('admin')->group(function () {
    // CRUD de servicios
    Route::get('/servicios', [ServicioController::class, 'adminIndex'])->name('admin.servicios.index');
    Route::get('/servicios/nuevo', [ServicioController::class, 'create'])->name('admin.servicios.create');
    Route::post('/servicios', [ServicioController::class, 'store'])->name('admin.servicios.store');
    Route::get('/servicios/{id}/editar', [ServicioController::class, 'edit'])->name('admin.servicios.edit');
    Route::put('/servicios/{id}', [ServicioController::class, 'update'])->name('admin.servicios.update');
    Route::delete('/servicios/{id}', [ServicioController::class, 'destroy'])->name('admin.servicios.destroy');

    // Gestión de citas (cambiar estado)
    Route::get('/citas', [CitaController::class, 'adminIndex'])->name('admin.citas.index');
    Route::put('/citas/{id}/status', [CitaController::class, 'updateStatus'])->name('admin.citas.updateStatus');
});
