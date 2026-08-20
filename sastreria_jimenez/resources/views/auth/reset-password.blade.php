{{-- =====================================================
    VISTA: Nueva contraseña
    Formulario para cambiar la contraseña con token válido
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Nueva Contraseña — Sastrería Jiménez')

@section('contenido')
    <section>
        <h2>Crear nueva contraseña</h2>
        <p style="margin-bottom:1.5rem;">Escribí tu nueva contraseña. Recordá que debe tener al menos 6 caracteres.</p>

        @if ($errors->any())
            <ul class="errores">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('password.reset', $token) }}">
            @csrf

            {{-- Token oculto para identificar al usuario --}}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="campoFormulario">
                <label for="password">Nueva contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="campoFormulario">
                <label for="password_confirmation">Repetir contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit">Guardar nueva contraseña</button>
        </form>
    </section>
@endsection
