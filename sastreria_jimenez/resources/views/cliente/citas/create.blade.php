{{-- =====================================================
    VISTA: Agendar cita (cliente)
    Formulario para crear una cita con un servicio
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Agendar Cita — Sastrería Jiménez')

@section('contenido')
    <section>
        <h2>Agendar Cita</h2>

        {{-- Card con info del servicio seleccionado --}}
        <div class="card-servicio" style="margin-bottom:1.5rem;">
            <span class="tipo-badge {{ $servicio->tipo === 'confeccion' ? 'tipo-confeccion' : 'tipo-arreglo' }}">
                {{ ucfirst($servicio->tipo) }}
            </span>
            <h3>{{ $servicio->nombre }}</h3>
            <p>{{ $servicio->descripcion }}</p>
            <div class="precio">Bs {{ number_format($servicio->precio, 2) }}</div>
        </div>

        @if ($errors->any())
            <ul class="errores">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('cliente.citas.store') }}">
            @csrf
            {{-- ID del servicio que viene por URL --}}
            <input type="hidden" name="servicio_id" value="{{ $servicio->id }}">

            <div class="campoFormulario">
                <label for="fecha_cita">Fecha y hora de la cita:</label>
                <input type="datetime-local" id="fecha_cita" name="fecha_cita" value="{{ old('fecha_cita') }}" required>
            </div>

            {{-- Campo opcional para que el cliente deje instrucciones --}}
            <div class="campoFormulario">
                <label for="notas">Nota (opcional):</label>
                <textarea id="notas" name="notas" rows="4" maxlength="500" placeholder="Ej: Traje azul oscuro, talla M...">{{ old('notas') }}</textarea>
            </div>

            <button type="submit">Confirmar Cita</button>
            <a href="{{ route('servicios.index') }}" class="btn" style="background-color:var(--input-border);color:var(--text-color);margin-left:0.5rem;">Volver</a>
        </form>
    </section>
@endsection
