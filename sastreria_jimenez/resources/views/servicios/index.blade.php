{{-- =====================================================
    VISTA: Catálogo público de servicios
    Muestra servicios activos con opción de agendar cita
    ===================================================== --}}
@extends('layouts.sastreria')

@section('titulo', 'Servicios — Sastrería Jiménez')

@section('contenido')
    <section>
        <h2>Nuestros Servicios</h2>
        @if($servicios->count())
            <div class="grid-servicios">
                @foreach($servicios as $s)
                    <div class="card-servicio">
                        {{-- Badge: tipo de servicio --}}
                        <span class="tipo-badge {{ $s->tipo === 'confeccion' ? 'tipo-confeccion' : 'tipo-arreglo' }}">
                            {{ ucfirst($s->tipo) }}
                        </span>
                        <h3>{{ $s->nombre }}</h3>
                        <p>{{ $s->descripcion }}</p>
                        <div class="precio">Bs {{ number_format($s->precio, 2) }}</div>
                        <div class="acciones">
                            @if(session('usuario_id'))
                                {{-- Solo clientes pueden agendar cita --}}
                                @php $u = App\Models\Usuario::find(session('usuario_id')); @endphp
                                @if(!$u->esAdmin())
                                    <a href="{{ route('cliente.citas.create', $s->id) }}" class="btn btn-small">Agendar Cita</a>
                                @endif
                            @else
                                {{-- Si no está logueado, pide login --}}
                                <a href="{{ route('login') }}" class="btn btn-small">Iniciá sesión para agendar</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No hay servicios disponibles por el momento.</p>
        @endif
    </section>
@endsection
