<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <style>
        body { font-family: 'Helvetica Neue', Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header { background-color: #2c3e50; color: #ffffff; text-align: center; padding: 2rem 1rem; }
        .header h1 { margin: 0; font-size: 1.8rem; }
        .content { padding: 2rem; color: #333333; }
        .btn { display: inline-block; background-color: #e67e22; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 5px; font-weight: bold; margin-top: 1rem; }
        .footer { background-color: #2c3e50; color: #ffffff; text-align: center; padding: 1.5rem; font-size: 0.9rem; }
        .aviso { font-size: 0.85rem; color: #888; margin-top: 1.5rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✂️ Sastrería Jiménez</h1>
        </div>

        <div class="content">
            <h2>Recuperar contraseña</h2>
            <p>Hola <strong>{{ $usuario->nombre_completo }}</strong>,</p>
            <p>Recibimos tu solicitud para cambiar la contraseña. Hacé clic en el botón de abajo para crear una nueva:</p>

            <a href="{{ $urlReset }}" class="btn">🔑 Crear nueva contraseña</a>

            <p class="aviso">Si no pediste este cambio, podés ignorar este correo. Tu contraseña actual sigue siendo la misma.</p>

            <p class="aviso">Este enlace vence en 1 hora.</p>
        </div>

        <div class="footer">
            <p>📍 Sastrería Jiménez — Cochabamba</p>
            <p>📞 65741113 | 📧 laura65741113</p>
        </div>
    </div>
</body>
</html>
