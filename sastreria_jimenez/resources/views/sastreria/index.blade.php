@extends('layouts.sastreria')

@section('titulo', 'Sastrería Jimenez - Contacto')

@section('contenido')
    <section id="servicios" class="servicios">
        <h2>Servicios disponibles</h2>
        <ul>
            <li>Confección de Traje Masculino - Bs 600</li>
            <li>Confección de Traje Femenino - Bs 600</li>
            <li>Arreglo (depende el arreglo varía el precio) - Bs 15</li>
        </ul>
    </section>

    <section id="contacto" class="contacto">
        <h2>Formulario de Contacto</h2>

        @if ($errors->any())
            <ul class="errores">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form id="form-contacto" method="POST" action="{{ route('contacto.procesar') }}">
            @csrf

            <div class="campoFormulario">
                <label for="nombre">Nombre completo:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="campoFormulario">
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required>
            </div>

            <div class="campoFormulario">
                <label for="mensaje">Detalle del arreglo o consulta:</label>
                <textarea id="mensaje" name="mensaje" rows="4" required>{{ old('mensaje') }}</textarea>
            </div>

            <button type="submit">Enviar mensaje</button>

            <p id="aviso" class="aviso"></p>
        </form>
    </section>
@endsection
