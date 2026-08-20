<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cita Confirmada</title>
    <style>
        body { font-family: 'Helvetica Neue', Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header { background-color: #2c3e50; color: #ffffff; text-align: center; padding: 2rem 1rem; }
        .header h1 { margin: 0; font-size: 1.8rem; }
        .content { padding: 2rem; color: #333333; }
        .info-box { background-color: #f8f9fa; border-left: 4px solid #e67e22; padding: 1rem 1.5rem; margin: 1rem 0; border-radius: 5px; }
        .info-box strong { color: #2c3e50; }
        .footer { background-color: #2c3e50; color: #ffffff; text-align: center; padding: 1.5rem; font-size: 0.9rem; }
        .btn { display: inline-block; background-color: #25d366; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 5px; font-weight: bold; margin-top: 1rem; }
        .status-badge { display: inline-block; background-color: #27ae60; color: #ffffff; padding: 4px 12px; border-radius: 20px; font-size: 0.9rem; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        {{-- Header con nombre de la sastrería --}}
        <div class="header">
            <h1>✂️ Sastrería Jiménez</h1>
        </div>

        <div class="content">
            <h2>¡Tu cita ha sido confirmada!</h2>
            <p>Hola <strong>{{ $cliente->nombre_completo }}</strong>,</p>
            <p>Tu cita ha sido <span class="status-badge">Confirmada</span> por nuestro equipo.</p>

            {{-- Datos de la cita --}}
            <div class="info-box">
                <p><strong>📌 Servicio:</strong> {{ $servicio->nombre }}</p>
                <p><strong>📋 Tipo:</strong> {{ ucfirst($servicio->tipo) }}</p>
                <p><strong>📅 Fecha:</strong> {{ $cita->fecha_cita->format('d/m/Y') }}</p>
                <p><strong>🕐 Hora:</strong> {{ $cita->fecha_cita->format('H:i') }}</p>
                <p><strong>💰 Precio:</strong> Bs {{ number_format($servicio->precio, 2) }}</p>
                @if($cita->notas)
                    <p><strong>📝 Nota:</strong> {{ $cita->notas }}</p>
                @endif
            </div>

            <p>Te esperamos en nuestra sastrería. Si necesitas cambiar la fecha o cancelar, avísanos con anticipación.</p>

            {{-- Botón de WhatsApp --}}
            <p>
                <a href="https://wa.me/59165741113?text=Hola, tengo una cita confirmada el {{ $cita->fecha_cita->format('d/m/Y') }}" class="btn">
                    📱 Contactar por WhatsApp
                </a>
            </p>
        </div>

        {{-- Footer con info de contacto --}}
        <div class="footer">
            <p>📍 Sastrería Jiménez — Cochabamba</p>
            <p>📞 65741113 | 📧 laura65741113</p>
            <p>🕐 Lun-Vie: 9am-8pm | Sáb: 9am-2pm</p>
        </div>
    </div>
</body>
</html>
