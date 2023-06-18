<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AccionES') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/css/menu.css'])
</head>

<body>
    <div id="app">
        @if (Auth::check())
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'AccionES') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <ul class="navbar-nav ms-auto">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                @if ($modulo == 'seguridad')
                                    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('seguridad') ? 'active' : '' }}">
                                        <a class="nav-link" href="/seguridad">Seguridad</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('usuario*') ? 'active' : '' }}">
                                        <a class="nav-link" href="/usuario">Gestión de Usuarios</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('empleado*') ? 'active' : '' }}">
                                        <a class="nav-link" href="/empleado">Gestión de Empleados</a>
                                    </li>
                                @elseif ($modulo == 'gestion')
                                    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('gestiones') ? 'active' : '' }}">
                                        <a class="nav-link" href="/gestiones">Gestiones de Proyectos</a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->is('gestiones/cat/departamentos*') || request()->is('gestiones/cat/municipios/*') ? 'active' : '' }}">
                                        <a class="nav-link" href="/gestiones/cat/departamentos">Departamentos y
                                            Municipios</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('gestiones') ? 'active' : '' }}">
                                        <a class="nav-link" href="/gestiones/listar">Proyectos</a>
                                    </li>
                                @elseif ($modulo == 'reportes')
                                    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('reportes') ? 'active' : '' }}">
                                        <a class="nav-link" href="/reportes">Reporte General</a>
                                    </li>
                                    @if (Auth::user()->usu_rol != 3)
                                        <li class="nav-item {{ request()->is('reportes/gesxestado') ? 'active' : '' }}">
                                            <a class="nav-link" href="/reportes/gesxestado">Reporte de Gestión por
                                                Estado</a>
                                        </li>
                                        <li class="nav-item {{ request()->is('reportes/gesxmun') ? 'active' : '' }}">
                                            <a class="nav-link" href="/reportes/gesxmun">Reporte de Gestión por Departamento
                                                y
                                                Municipio</a>
                                        </li>
                                        <li class="nav-item {{ request()->is('reportes/resxges') ? 'active' : '' }}">
                                            <a class="nav-link" href="/reportes/resxges">Reporte de Responsables por
                                                Gestión</a>
                                        </li>
                                    @endif
                                @endif

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->usu_usuario }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')

</html>
