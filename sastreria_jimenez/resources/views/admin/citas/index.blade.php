{{-- =====================================================
    VISTA: Admin - Gestionar citas
    Cambia estados: pendiente → confirmada → completada
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Administrar Citas — Sastrería Jiménez')

@section('contenido')
    <section>
        <h2>Gestionar Citas</h2>

        @if($citas->count())
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Cliente</th>
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
                            <td>{{ $cita->usuario->nombre_completo }}</td>
                            <td>{{ $cita->servicio->nombre }}</td>
                            <td>{{ $cita->fecha_cita->format('d/m/Y H:i') }}</td>
                            <td><span class="status-{{ $cita->status }}">{{ ucfirst($cita->status) }}</span></td>
                            <td>{{ $cita->notas ?: '—' }}</td>
                            <td>
                                {{-- Si está pendiente: puede confirmar o cancelar --}}
                                @if($cita->status === 'pendiente')
                                    <form method="POST" action="{{ route('admin.citas.updateStatus', $cita->id) }}" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="confirmada">
                                        <button type="submit" class="btn btn-info btn-small">Confirmar</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.citas.updateStatus', $cita->id) }}" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="cancelada">
                                        <button type="submit" class="btn btn-danger btn-small">Cancelar</button>
                                    </form>
                                {{-- Si está confirmada: puede marcar como completada --}}
                                @elseif($cita->status === 'confirmada')
                                    <form method="POST" action="{{ route('admin.citas.updateStatus', $cita->id) }}" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="completada">
                                        <button type="submit" class="btn btn-success btn-small">Completar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay citas registradas.</p>
        @endif
    </section>
@endsection
