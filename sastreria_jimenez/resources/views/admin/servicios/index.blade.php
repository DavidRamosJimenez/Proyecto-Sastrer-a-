{{-- =====================================================
    VISTA: Admin - Lista de servicios
    CRUD completo: crear, editar, desactivar servicios
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Administrar Servicios — Sastrería Jiménez')

@section('contenido')
    <section>
        <h2>Gestionar Servicios</h2>
        <a href="{{ route('admin.servicios.create') }}" class="btn" style="margin-bottom:1.5rem;">+ Nuevo Servicio</a>

        @if($servicios->count())
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios as $s)
                        <tr>
                            <td>{{ $s->nombre }}</td>
                            <td><span class="tipo-badge {{ $s->tipo === 'confeccion' ? 'tipo-confeccion' : 'tipo-arreglo' }}">{{ ucfirst($s->tipo) }}</span></td>
                            <td>Bs {{ number_format($s->precio, 2) }}</td>
                            <td>{{ $s->activo ? 'Activo' : 'Inactivo' }}</td>
                            <td>
                                {{-- Botón editar --}}
                                <a href="{{ route('admin.servicios.edit', $s->id) }}" class="btn btn-info btn-small">Editar</a>
                                {{-- Solo muestra desactivar si está activo --}}
                                @if($s->activo)
                                    <form method="POST" action="{{ route('admin.servicios.destroy', $s->id) }}" style="display:inline;" onsubmit="return confirm('¿Desactivar este servicio?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-small">Desactivar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay servicios creados.</p>
        @endif
    </section>
@endsection
