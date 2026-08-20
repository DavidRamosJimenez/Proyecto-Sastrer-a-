{{-- =====================================================
    VISTA: Admin - Crear nuevo servicio
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Nuevo Servicio — Sastrería Jiménez')

@section('contenido')
    <section>
        <h2>Crear Servicio</h2>

        @if ($errors->any())
            <ul class="errores">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('admin.servicios.store') }}">
            @csrf

            <div class="campoFormulario">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="campoFormulario">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="3">{{ old('descripcion') }}</textarea>
            </div>

            <div class="campoFormulario">
                <label for="precio">Precio (Bs):</label>
                <input type="number" id="precio" name="precio" value="{{ old('precio') }}" step="0.01" min="0" required>
            </div>

            {{-- Select con los dos tipos de servicio --}}
            <div class="campoFormulario">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Seleccionar...</option>
                    <option value="confeccion" {{ old('tipo') === 'confeccion' ? 'selected' : '' }}>Confección</option>
                    <option value="arreglo" {{ old('tipo') === 'arreglo' ? 'selected' : '' }}>Arreglo</option>
                </select>
            </div>

            <button type="submit">Guardar</button>
            <a href="{{ route('admin.servicios.index') }}" class="btn" style="background-color:var(--input-border);color:var(--text-color);margin-left:0.5rem;">Cancelar</a>
        </form>
    </section>
@endsection
