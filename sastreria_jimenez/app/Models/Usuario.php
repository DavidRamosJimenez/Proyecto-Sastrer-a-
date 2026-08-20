<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Modelo de usuario: clientres y administrador de la sastrería
class Usuario extends Model
{
    protected $table = 'usuarios';

    // Campos editables al crear/actualizar
    protected $fillable = [
        'nombre_completo',
        'email',
        'password',
        'telefono',
        'direccion',
        'rol',           // 'cliente' o 'administrador'
        'activo',        // 1 = activo, 0 = inactivo
        'reset_token',                    // token para recuperar contraseña
        'reset_token_expires_at',         // fecha de expiración del token
    ];

    // Oculta el password en las respuestas (seguridad)
    protected $hidden = ['password'];

    // Relación: un usuario tiene muchas citas
    public function citas()
    {
        return $this->hasMany(Cita::class, 'usuario_id');
    }

    // Verifica si el usuario es administrador
    public function esAdmin()
    {
        return $this->rol === 'administrador';
    }
}
