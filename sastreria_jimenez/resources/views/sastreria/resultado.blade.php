@extends('layouts.sastreria')

@section('titulo', 'Consulta recibida - Sastrería Jimenez')

@section('contenido')
    <section>
        <h2>Consulta recibida en Sastrería Jimenez</h2>

        <p><strong>Nombre:</strong> {{ $datos['nombre'] }}</p>
        <p><strong>Correo:</strong> {{ $datos['correo'] }}</p>
        <p><strong>Mensaje:</strong> {{ $datos['mensaje'] }}</p>

        <h3>Servicios disponibles</h3>
        <ul>
            @foreach ($servicios as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        <p>Te responde Jhonathan David Ramos Jimenez</p>

        <p><a href="{{ route('contacto.index') }}">Volver al formulario</a></p>
    </section>
@endsection
