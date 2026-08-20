<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Modelo de cita: une a un usuario con un servicio en una fecha
class Cita extends Model
{
    protected $table = 'citas';

    // Campos editables al crear/actualizar
    protected $fillable = [
        'usuario_id',   // FK → usuarios
        'servicio_id',  // FK → servicios
        'fecha_cita',   // fecha y hora de la cita
        'status',       // pendiente, confirmada, completada, cancelada
        'notas',        // nota que deja el cliente
    ];

    // Convierte fecha_cita a objeto Carbon para usar formatos
    protected $casts = [
        'fecha_cita' => 'datetime',
    ];

    // Relación: cada cita pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relación: cada cita es para un servicio
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
}
