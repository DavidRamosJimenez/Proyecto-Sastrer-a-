{{-- =====================================================
    VISTA: Admin - Editar servicio existente
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Editar Servicio — Sastrería Jiménez')

@section('contenido')
    <section>
        <h2>Editar Servicio</h2>

        @if ($errors->any())
            <ul class="errores">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {{-- Método PUT para actualizar --}}
        <form method="POST" action="{{ route('admin.servicios.update', $servicio->id) }}">
            @csrf
            @method('PUT')

            <div class="campoFormulario">
                <label for="nombre">Nombre:</label>
                {{-- old() muestra el valor anterior si hay error de validación --}}
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $servicio->nombre) }}" required>
            </div>

            <div class="campoFormulario">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $servicio->descripcion) }}</textarea>
            </div>

            <div class="campoFormulario">
                <label for="precio">Precio (Bs):</label>
                <input type="number" id="precio" name="precio" value="{{ old('precio', $servicio->precio) }}" step="0.01" min="0" required>
            </div>

            <div class="campoFormulario">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" required>
                    <option value="confeccion" {{ old('tipo', $servicio->tipo) === 'confeccion' ? 'selected' : '' }}>Confección</option>
                    <option value="arreglo" {{ old('tipo', $servicio->tipo) === 'arreglo' ? 'selected' : '' }}>Arreglo</option>
                </select>
            </div>

            <button type="submit">Actualizar</button>
            <a href="{{ route('admin.servicios.index') }}" class="btn" style="background-color:var(--input-border);color:var(--text-color);margin-left:0.5rem;">Cancelar</a>
        </form>
    </section>
@endsection
