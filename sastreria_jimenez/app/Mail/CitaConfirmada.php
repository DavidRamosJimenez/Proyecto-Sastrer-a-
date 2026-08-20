<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Cita;

// =====================================================
// Mailable: se envía cuando el admin confirma una cita
// =====================================================
class CitaConfirmada extends Mailable
{
    use Queueable, SerializesModels;

    // Datos que se pasarán a la vista del correo
    public $cita;
    public $cliente;
    public $servicio;

    // Recibe la cita confirmada y extrae usuario y servicio
    public function __construct(Cita $cita)
    {
        $this->cita = $cita;
        $this->cliente = $cita->usuario;
        $this->servicio = $cita->servicio;
    }

    // Construye el correo: asunto y vista
    public function build()
    {
        return $this->subject('Sastrería Jiménez - Cita Confirmada')
                    ->view('emails.cita_confirmada');
    }
}
