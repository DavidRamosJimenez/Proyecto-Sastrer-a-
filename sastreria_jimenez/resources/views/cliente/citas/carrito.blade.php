{{-- =====================================================
    VISTA: Reservar carrito de arreglos
    Recibe los items del carrito (localStorage) y reserva varios servicios
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Reservar Carrito — Sastrería Jiménez')

@section('contenido')
    <section>
        <h2>Reservar tus arreglos</h2>

        {{-- Lista de items del carrito --}}
        <div id="carrito-resumen">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Cantidad</th>
                        <th>Precio Unit.</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody id="tabla-carrito"></tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align:right; font-weight:bold;">Total:</td>
                        <td id="total-carrito" style="font-weight:bold; color:var(--success);"></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Si el carrito está vacío --}}
        <div id="carrito-vacio" style="display:none; text-align:center; padding:2rem;">
            <p>Tu carrito está vacío.</p>
            <a href="{{ route('home') }}" class="btn" style="margin-top:1rem;">Volver al inicio</a>
        </div>

        {{-- Formulario de reserva --}}
        <form id="form-reserva" method="POST" action="{{ route('cliente.citas.storeCarrito') }}" style="margin-top:1.5rem;">
            @csrf
            {{-- Se envía el carrito como JSON oculto --}}
            <input type="hidden" name="carrito_json" id="carrito-json">

            <div class="campoFormulario">
                <label for="fecha_cita">¿Para cuándo querés la cita?</label>
                <input type="datetime-local" id="fecha_cita" name="fecha_cita" required>
            </div>

            <div class="campoFormulario">
                <label for="notas">Nota (opcional):</label>
                <textarea id="notas" name="notas" rows="3" maxlength="500" placeholder="Ej: Todos los jeans son bota, traer hilo negro..."></textarea>
            </div>

            <button type="submit" id="btn-reservar">Reservar todo</button>
            <a href="{{ route('home') }}" class="btn" style="background-color:var(--input-border); color:var(--text-color); margin-left:0.5rem;">Volver</a>
        </form>
    </section>

    <script>
        // Carga el carrito desde localStorage
        var carrito = JSON.parse(localStorage.getItem('carrito_arreglos') || '[]');

        // Si no hay items, muestra mensaje de carrito vacío
        if (carrito.length === 0) {
            document.getElementById('carrito-resumen').style.display = 'none';
            document.getElementById('form-reserva').style.display = 'none';
            document.getElementById('carrito-vacio').style.display = 'block';
        } else {
            // Renderiza la tabla
            var tbody = document.getElementById('tabla-carrito');
            var html = '';
            var total = 0;
            for (var i = 0; i < carrito.length; i++) {
                var item = carrito[i];
                var subtotal = item.precio * item.cantidad;
                total += subtotal;
                html += '<tr>';
                html += '<td>' + item.nombre + '</td>';
                html += '<td>' + item.cantidad + '</td>';
                html += '<td>Bs ' + item.precio.toFixed(2) + '</td>';
                html += '<td>Bs ' + subtotal.toFixed(2) + '</td>';
                html += '</tr>';
            }
            tbody.innerHTML = html;
            document.getElementById('total-carrito').textContent = 'Bs ' + total.toFixed(2);

            // Pone la fecha mínima en el datetime-local (mañana)
            var ahora = new Date();
            ahora.setDate(ahora.getDate() + 1);
            ahora.setHours(9, 0, 0, 0);
            var fechaMin = ahora.toISOString().slice(0, 16);
            document.getElementById('fecha_cita').setAttribute('min', fechaMin);
        }

        // Antes de enviar el form, guarda el carrito en el campo oculto y limpia localStorage
        document.getElementById('form-reserva').addEventListener('submit', function(e) {
            if (carrito.length === 0) {
                e.preventDefault();
                alert('No hay servicios en el carrito.');
                return;
            }
            document.getElementById('carrito-json').value = JSON.stringify(carrito);
            // Limpia el carrito después de enviar
            localStorage.removeItem('carrito_arreglos');
        });
    </script>
@endsection
