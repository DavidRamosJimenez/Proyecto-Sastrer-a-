{{-- =====================================================
    VISTA: Mis citas (cliente)
    Lista todas las citas del usuario logueado
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Mis Citas — Sastrería Jiménez')

@section('contenido')
    <section>
        <h2>Mis Citas</h2>

        @if($citas->count())
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Nota</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr>
                            <td>{{ $cita->servicio->nombre }}</td>
                            <td>{{ $cita->fecha_cita->format('d/m/Y H:i') }}</td>
                            {{-- Badge de estado con color --}}
                            <td><span class="status-{{ $cita->status }}">{{ ucfirst($cita->status) }}</span></td>
                            <td>{{ $cita->notas ?: '—' }}</td>
                            <td>
                                {{-- Solo puede cancelar si está pendiente --}}
                                @if($cita->status === 'pendiente')
                                    <form method="POST" action="{{ route('cliente.citas.cancel', $cita->id) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-small">Cancelar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No tenés citas aún.</p>
        @endif
    </section>
@endsection
