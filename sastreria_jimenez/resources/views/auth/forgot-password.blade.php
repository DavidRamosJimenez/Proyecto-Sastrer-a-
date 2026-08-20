{{-- =====================================================
    VISTA: Olvidé mi contraseña
    Formulario para solicitar link de recuperación
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Recuperar Contraseña — Sastrería Jiménez')

@section('contenido')
    <section>
        <h2>Recuperar contraseña</h2>
        <p style="margin-bottom:1.5rem;">Escribí tu correo y te enviamos un enlace para crear una nueva contraseña.</p>

        @if(session('exito'))
            <div class="alerta exito">{{ session('exito') }}</div>
        @endif

        @if(session('error'))
            <div class="alerta error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <ul class="errores">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('password.send') }}">
            @csrf

            <div class="campoFormulario">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="tucorreo@ejemplo.com" required>
            </div>

            <button type="submit">Enviar enlace de recuperación</button>
            <a href="{{ route('login') }}" class="btn" style="background-color:var(--input-border); color:var(--text-color); margin-left:0.5rem;">Volver al login</a>
        </form>
    </section>
@endsection
