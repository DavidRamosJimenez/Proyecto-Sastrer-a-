@extends('layouts\base')

@section('content')
    <p>Somos una ferretería de barrio dedicada a brindar las mejores herramientas y materiales para los trabajos del hogar y la construcción.</p>

    <p><strong>Hay {{ count($herramientas) }} herramientas en el inventario.</strong></p>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio (Bs)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($herramientas as $herramienta)
                <tr>
                    <td>{{ $herramienta->nombre }}</td>
                    <td>{{ $herramienta->precio }} Bs</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><em>Inventario atendido por jhonathan david ramos jimenez</em></p>

    <a href="/herramientas/nuevo" class="btn">Registrar nueva herramienta</a>
@endsection
