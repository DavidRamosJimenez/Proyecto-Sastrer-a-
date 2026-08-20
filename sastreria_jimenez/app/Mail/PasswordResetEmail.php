<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario;

// Mailable: se envía cuando el usuario pide recuperar contraseña
class PasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $token;
    public $urlReset;

    // Recibe el usuario y el token de recuperación
    public function __construct(Usuario $usuario, string $token)
    {
        $this->usuario = $usuario;
        $this->token = $token;
        // Arma el link completo de recuperación
        $this->urlReset = url("recuperar/{$token}");
    }

    // Construye el correo
    public function build()
    {
        return $this->subject('Sastrería Jiménez - Recuperar Contraseña')
                    ->view('emails.password_reset');
    }
}
