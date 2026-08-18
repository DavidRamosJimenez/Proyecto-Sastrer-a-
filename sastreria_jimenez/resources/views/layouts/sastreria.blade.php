<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Sastrería Jimenez')</title>
    <link rel="stylesheet" href="{{ asset('css/sastreria.css') }}">
</head>
<body>
    <header>
        <h1>Sastreria Jimenez</h1>
        <nav>
            <ul class="nav-menu">
                <li><a href="{{ route('contacto.index') }}">Inicio</a></li>
                <li><a href="{{ route('contacto.index') }}#servicios">Servicios</a></li>
                <li><a href="{{ route('contacto.index') }}#contacto">Contacto</a></li>
                <li>
                    <button id="theme-toggle" type="button" class="theme-toggle" aria-label="Cambiar tema">
                        <span class="icon-sun">☀️</span>
                        <span class="icon-moon">🌙</span>
                    </button>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('contenido')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Sastrería Jimenez.</p>
    </footer>

    <script src="{{ asset('js/sastreria.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
