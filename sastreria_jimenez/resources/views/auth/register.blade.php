{{-- =====================================================
    VISTA: Formulario de registro de cliente
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Registrarse — Sastrería Jiménez')

@section('contenido')
    <section>
        <h2>Crear Cuenta</h2>

        {{-- Errores de validación --}}
        @if ($errors->any())
            <ul class="errores">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="campoFormulario">
                <label for="nombre_completo">Nombre completo:</label>
                <input type="text" id="nombre_completo" name="nombre_completo" value="{{ old('nombre_completo') }}" required>
            </div>

            <div class="campoFormulario">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="campoFormulario">
                <label for="telefono">Teléfono (opcional):</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}">
            </div>

            <div class="campoFormulario">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            {{-- Confirmación de contraseña --}}
            <div class="campoFormulario">
                <label for="password_confirmation">Confirmar contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit">Crear Cuenta</button>
        </form>

        <p style="margin-top:1rem;">¿Ya tenés cuenta? <a href="{{ route('login') }}">Iniciá sesión</a></p>
    </section>
@endsection
