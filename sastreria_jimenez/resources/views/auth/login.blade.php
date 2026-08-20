{{-- =====================================================
    VISTA: Formulario de login
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Iniciar Sesión — Sastrería Jiménez')

@section('contenido')
    <section>
        <h2>Iniciar Sesión</h2>

        {{-- Errores de validación --}}
        @if ($errors->any())
            <ul class="errores">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="campoFormulario">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="campoFormulario">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Entrar</button>
        </form>

        <p style="margin-top:1rem;"><a href="{{ route('password.forgot') }}">Olvidé mi contraseña</a></p>
        <p>¿No tenés cuenta? <a href="{{ route('register') }}">Registrate acá</a></p>
    </section>
@endsection
