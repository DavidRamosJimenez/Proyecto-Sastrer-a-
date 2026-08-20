<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Modelo de servicio: confecciones (trajes, pantalones) y arreglos
class Servicio extends Model
{
    protected $table = 'servicios';

    // Campos editables al crear/actualizar
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'tipo',      // 'confeccion' o 'arreglo'
        'activo',    // 1 = visible para clientes, 0 = oculto
    ];

    // Relación: un servicio puede tener muchas citas
    public function citas()
    {
        return $this->hasMany(Cita::class, 'servicio_id');
    }
}
