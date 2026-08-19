@extends('layouts\base')

@section('content')
    @if ($errors->any())
        <div class="errores">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/herramientas/nuevo" method="POST">
        @csrf

        <div class="campo">
            <label for="nombre">Nombre de la herramienta</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
        </div>

        <div class="campo">
            <label for="precio">Precio en Bs</label>
            <input type="number" id="precio" name="precio" value="{{ old('precio') }}">
        </div>

        <button type="submit">Registrar herramienta</button>
    </form>
@endsection
