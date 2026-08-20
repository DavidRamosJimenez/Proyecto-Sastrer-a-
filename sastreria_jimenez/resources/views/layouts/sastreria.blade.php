{{-- =====================================================
    LAYOUT BASE - Sastrería Jiménez
    Todas las páginas heredan de este archivo
    ===================================================== --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Sastrería Jiménez')</title>
    <link rel="stylesheet" href="{{ asset('css/sastreria.css') }}">
</head>
<body>
    {{-- HEADER: navegación principal --}}
    <header>
        <h1><a href="{{ route('home') }}" style="color:inherit;text-decoration:none;">Sastrería Jiménez</a></h1>
        <nav>
            <ul class="nav-menu">
                {{-- Links siempre visibles --}}
                <li><a href="{{ route('home') }}">Inicio</a></li>
                <li><a href="{{ route('servicios.index') }}">Servicios</a></li>

                {{-- Busca el usuario logueado --}}
                @php $u = App\Models\Usuario::find(session('usuario_id')); @endphp

                @if($u)
                    {{-- Si es admin, muestra links de administración --}}
                    @if($u->esAdmin())
                        <li><a href="{{ route('admin.servicios.index') }}">Admin Servicios</a></li>
                        <li><a href="{{ route('admin.citas.index') }}">Admin Citas</a></li>
                    @else
                        {{-- Si es cliente, muestra sus citas --}}
                        <li><a href="{{ route('cliente.citas.index') }}">Mis Citas</a></li>
                    @endif
                    {{-- Botón de cerrar sesión --}}
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="nav-btn">Salir ({{ $u->nombre_completo }})</button>
                        </form>
                    </li>
                @else
                    {{-- Si no está logueado, muestra login y registro --}}
                    <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                    <li><a href="{{ route('register') }}">Registrarse</a></li>
                @endif

                {{-- Botón de tema claro/oscuro --}}
                <li>
                    <button id="theme-toggle" type="button" class="theme-toggle" aria-label="Cambiar tema">
                        <span class="icon-sun">☀️</span>
                        <span class="icon-moon">🌙</span>
                    </button>
                </li>
            </ul>
        </nav>
    </header>

    {{-- CONTENIDO PRINCIPAL: cada vista inyecta su contenido aquí --}}
    <main>
        {{-- Mensajes de éxito/error (flash messages) --}}
        @if(session('exito'))
            <div class="alerta exito">{{ session('exito') }}</div>
        @endif
        @if(session('error'))
            <div class="alerta error">{{ session('error') }}</div>
        @endif
        @yield('contenido')
    </main>

    {{-- FOOTER --}}
    <footer>
        <p>&copy; {{ date('Y') }} Sastrería Jiménez — Jhonathan David Ramos Jiménez</p>
    </footer>

    {{-- BOTÓN FLONTANTE DE WHATSAPP --}}
    <a href="https://wa.me/59165741113?text=Hola%2C%20quiero%20una%20consulta%20sobre%20la%20sastrer%C3%ADa" class="whatsapp-float" target="_blank" rel="noopener">
        <svg viewBox="0 0 32 32" fill="#fff" width="28" height="28"><path d="M16.004 0h-.008C7.174 0 0 7.176 0 16c0 3.5 1.128 6.744 3.046 9.378L1.054 31.2l6.062-1.962A15.91 15.91 0 0016.004 32C24.826 32 32 24.822 32 16S24.826 0 16.004 0zm9.306 22.608c-.39 1.1-1.932 2.014-3.164 2.27-.84.174-1.936.312-5.626-1.206-4.724-1.94-7.762-6.724-7.996-7.036-.226-.312-1.86-2.476-1.86-4.724s1.178-3.344 1.6-3.806c.39-.462.922-.612 1.228-.612.15 0 .282.008.402.014.426.018.638.044.916.708.35.832 1.194 2.912 1.296 3.124.102.212.204.508.06.8-.138.3-.26.438-.486.712-.226.274-.428.486-.654.782-.196.252-.414.52-.17.942.244.422 1.086 1.792 2.33 2.904 1.602 1.436 2.874 1.882 3.34 2.082.366.156.796.118 1.082-.23.362-.446.812-1.182 1.268-1.912.324-.522.732-.586 1.154-.396.426.186 2.704 1.274 3.168 1.502.464.228.774.342.886.532.114.194.114 1.12-.276 2.22z"/></svg>
    </a>

    {{-- JS principal --}}
    <script src="{{ asset('js/sastreria.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
