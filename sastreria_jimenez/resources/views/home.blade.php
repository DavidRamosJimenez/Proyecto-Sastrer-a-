{{-- =====================================================
    VISTA: Página de inicio
    Muestra info de la sastrería, servicios, contacto y mapa
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Sastrería Jiménez — Inicio')

@section('contenido')
    {{-- Banner principal --}}
    <section class="hero">
        <h2>Sastrería Jiménez</h2>
        <p>Confecciones y arreglos de calidad. Más de 10 años de experiencia cosiendo para vos.</p>
    </section>

    {{-- Sección: qué hacemos --}}
    <section>
        <h2>¿Qué hacemos?</h2>
        <div class="info-grid">
            <div class="info-card">
                <h3>Confecciones</h3>
                <p>Trajes masculinos y femeninos, pantalones y más. Todo a tu medida.</p>
            </div>
            <div class="info-card">
                <h3>Arreglos</h3>
                <p>Reparaciones, ajustes y modificaciones en tus prendas favoritas.</p>
            </div>
            <div class="info-card">
                <h3>Citas Online</h3>
                <p>Agendá tu cita desde la web. Elegí el servicio, dejá tu nota y listo.</p>
            </div>
        </div>
    </section>

    {{-- Sección: servicios activos desde la BD --}}
    <section>
        <h2>Servicios disponibles</h2>
        @if($servicios->count())
            <div class="grid-servicios">
                @foreach($servicios as $s)
                    <div class="card-servicio">
                        {{-- Badge de tipo: confección o arreglo --}}
                        <span class="tipo-badge {{ $s->tipo === 'confeccion' ? 'tipo-confeccion' : 'tipo-arreglo' }}">
                            {{ ucfirst($s->tipo) }}
                        </span>
                        <h3>{{ $s->nombre }}</h3>
                        <p>{{ $s->descripcion }}</p>
                        <div class="precio">Bs {{ number_format($s->precio, 2) }}</div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No hay servicios disponibles por el momento.</p>
        @endif
    </section>

    {{-- Sección: calculadora de presupuesto y carrito --}}
    <section>
        <h2>Calculá tu presupuesto</h2>
        <p style="margin-bottom:1.5rem;">Elegí un servicio y agregalo al carrito. Para arreglos podés poner cantidad.</p>

        <div class="calculadora">
            {{-- Select con todos los servicios activos --}}
            <div class="campoFormulario">
                <label for="servicio-select">Seleccioná un servicio:</label>
                <select id="servicio-select" onchange="mostrarOpciones()">
                    <option value="">-- Elegí un servicio --</option>
                    @foreach($servicios as $s)
                        <option value="{{ $s->id }}" data-precio="{{ $s->precio }}" data-tipo="{{ $s->tipo }}" data-nombre="{{ $s->nombre }}">
                            {{ $s->nombre }} — Bs {{ number_format($s->precio, 2) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Resultado: precio y opciones --}}
            <div id="resultado-calculo" style="display:none;">
                <div class="presupuesto-resultado">
                    <span class="presupuesto-label">Servicio:</span>
                    <span id="calc-nombre" class="presupuesto-valor"></span>
                </div>
                <div class="presupuesto-resultado">
                    <span class="presupuesto-label">Precio unitario:</span>
                    <span id="calc-precio" class="presupuesto-valor"></span>
                </div>

                {{-- Campo cantidad: solo visible para arreglos --}}
                <div id="campo-cantidad" class="campoFormulario" style="display:none; margin-top:1rem;">
                    <label for="cantidad-input">¿Cuántos artículos?</label>
                    <input type="number" id="cantidad-input" value="1" min="1" max="50" style="width:80px;" onchange="actualizarSubtotal()">
                    <span id="calc-subtotal" style="margin-left:1rem; font-weight:bold; color:var(--success);"></span>
                </div>

                {{-- Botón agregar al carrito (siempre visible para ambos tipos) --}}
                <div style="margin-top:1rem;">
                    <button id="btn-agregar" class="btn" onclick="agregarAlCarrito()">+ Agregar al carrito</button>
                </div>
            </div>
        </div>

        {{-- Carrito --}}
        <div id="carrito" style="display:none; margin-top:2rem;">
            <h3>Tu carrito</h3>
            <table class="tabla" style="margin-top:1rem;">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Tipo</th>
                        <th>Cant.</th>
                        <th>Precio Unit.</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="carrito-items"></tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align:right; font-weight:bold;">Total:</td>
                        <td id="carrito-total" style="font-weight:bold; color:var(--success);"></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div style="margin-top:1rem;">
                <button class="btn btn-danger btn-small" onclick="limpiarCarrito()">Vaciar carrito</button>
                <a href="{{ route('cliente.citas.carrito') }}" class="btn" style="margin-left:0.5rem;">Reservar todo</a>
            </div>
        </div>
    </section>

    {{-- Sección: datos de contacto --}}
    <section>
        <h2>Contacto</h2>
        <div class="info-grid">
            <div class="info-card">
                <h3>Teléfono</h3>
                <p>65741113</p>
            </div>
            <div class="info-card">
                <h3>Correo</h3>
                <p>laura65741113</p>
            </div>
            <div class="info-card">
                <h3>Horario</h3>
                <p>Lun - Vie: 9am - 8pm</p>
                <p>Sábados: 9am - 2pm</p>
            </div>
        </div>
    </section>

    {{-- Sección: mapa de ubicación --}}
    <section>
        <h2>Ubicación</h2>
        <div class="mapa-container">
            <iframe
                src="https://maps.google.com/maps?q=-17.3878556,-66.1762267&z=17&output=embed"
                width="100%"
                height="350"
                style="border:0; border-radius:10px;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <p style="margin-top:1rem; text-align:center; color:var(--text-color); opacity:0.8;">
            Cochabamba, Bolivia — Sastrería Jiménez
        </p>
    </section>

    {{-- Script de la calculadora y carrito --}}
    <script>
        // Carrito guardado en localStorage
        var carrito = JSON.parse(localStorage.getItem('carrito_arreglos') || '[]');

        // Muestra u oculta campos según el servicio seleccionado
        function mostrarOpciones() {
            var select = document.getElementById('servicio-select');
            var resultado = document.getElementById('resultado-calculo');
            var campoCantidad = document.getElementById('campo-cantidad');
            var option = select.options[select.selectedIndex];

            if (!option.value) {
                resultado.style.display = 'none';
                return;
            }

            var nombre = option.getAttribute('data-nombre');
            var precio = parseFloat(option.getAttribute('data-precio'));
            var tipo = option.getAttribute('data-tipo');

            document.getElementById('calc-nombre').textContent = nombre;
            document.getElementById('calc-precio').textContent = 'Bs ' + precio.toFixed(2);

            // Arreglos: mostrar campo cantidad
            // Confecciones: ocultar campo cantidad (siempre 1)
            if (tipo === 'arreglo') {
                campoCantidad.style.display = 'block';
                document.getElementById('cantidad-input').value = 1;
                actualizarSubtotal();
            } else {
                campoCantidad.style.display = 'none';
            }

            resultado.style.display = 'block';
        }

        // Actualiza el subtotal al cambiar cantidad
        function actualizarSubtotal() {
            var select = document.getElementById('servicio-select');
            var option = select.options[select.selectedIndex];
            var precio = parseFloat(option.getAttribute('data-precio'));
            var cantidad = parseInt(document.getElementById('cantidad-input').value) || 1;
            var subtotal = precio * cantidad;
            document.getElementById('calc-subtotal').textContent = '= Bs ' + subtotal.toFixed(2);
        }

        // Agrega un servicio al carrito (confección o arreglo)
        function agregarAlCarrito() {
            var select = document.getElementById('servicio-select');
            var option = select.options[select.selectedIndex];

            if (!option.value) return;

            var id = parseInt(option.value);
            var nombre = option.getAttribute('data-nombre');
            var precio = parseFloat(option.getAttribute('data-precio'));
            var tipo = option.getAttribute('data-tipo');
            var cantidad = 1;

            // Si es arreglo, toma la cantidad del input
            if (tipo === 'arreglo') {
                cantidad = parseInt(document.getElementById('cantidad-input').value) || 1;
            }

            // Si ya existe el mismo servicio, suma la cantidad
            var encontrado = false;
            for (var i = 0; i < carrito.length; i++) {
                if (carrito[i].id === id) {
                    carrito[i].cantidad += cantidad;
                    encontrado = true;
                    break;
                }
            }

            if (!encontrado) {
                carrito.push({ id: id, nombre: nombre, precio: precio, tipo: tipo, cantidad: cantidad });
            }

            guardarCarrito();
            renderizarCarrito();

            // Resetea el select
            select.value = '';
            document.getElementById('resultado-calculo').style.display = 'none';
        }

        // Elimina un item del carrito
        function eliminarDelCarrito(index) {
            carrito.splice(index, 1);
            guardarCarrito();
            renderizarCarrito();
        }

        // Vacia todo el carrito
        function limpiarCarrito() {
            carrito = [];
            guardarCarrito();
            renderizarCarrito();
        }

        // Guarda el carrito en localStorage
        function guardarCarrito() {
            localStorage.setItem('carrito_arreglos', JSON.stringify(carrito));
        }

        // Renderiza la tabla del carrito
        function renderizarCarrito() {
            var contenedor = document.getElementById('carrito');
            var tbody = document.getElementById('carrito-items');
            var totalTd = document.getElementById('carrito-total');

            if (carrito.length === 0) {
                contenedor.style.display = 'none';
                return;
            }

            var html = '';
            var total = 0;
            for (var i = 0; i < carrito.length; i++) {
                var item = carrito[i];
                var subtotal = item.precio * item.cantidad;
                total += subtotal;
                var tipoBadge = item.tipo === 'confeccion'
                    ? '<span class="tipo-badge tipo-confeccion">Confección</span>'
                    : '<span class="tipo-badge tipo-arreglo">Arreglo</span>';
                html += '<tr>';
                html += '<td>' + item.nombre + '</td>';
                html += '<td>' + tipoBadge + '</td>';
                html += '<td>' + item.cantidad + '</td>';
                html += '<td>Bs ' + item.precio.toFixed(2) + '</td>';
                html += '<td>Bs ' + subtotal.toFixed(2) + '</td>';
                html += '<td><button class="btn btn-danger btn-small" onclick="eliminarDelCarrito(' + i + ')">X</button></td>';
                html += '</tr>';
            }
            tbody.innerHTML = html;
            totalTd.textContent = 'Bs ' + total.toFixed(2);
            contenedor.style.display = 'block';
        }

        // Al cargar la página, mostrar carrito si tiene items
        renderizarCarrito();
    </script>
@endsection
