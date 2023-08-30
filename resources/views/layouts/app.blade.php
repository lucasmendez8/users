<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth()
                            <li class="nav-item dropdown">
                                @if (Auth::user()->super_admin || Auth::user()->hasPermiso('listar-modulos') || Auth::user()->hasPermiso('listar-usuarios'))
                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Administrar</a>
                                    <ul class="dropdown-menu">
                                        @if (Auth::user()->super_admin)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('modulos') }}">Módulos</a>
                                        </li>
                                        @endif

                                        @if (Auth::user()->super_admin || Auth::user()->hasPermiso('listar-usuarios'))
                                        <li>
                                            <a class="dropdown-item" href="{{ route('usuarios') }}">Usuarios</a>
                                        </li>
                                        @endif
                                    </ul>
                                @endif
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('usuarios.edit', ['usuario' => Auth::user()]) }}">
                                        Editar Perfil
                                    </a>

                                    <a class="dropdown-item" href="{{ route('usuarios.cambiarPassword', ['usuario' => Auth::user()]) }}">
                                        Modificar Contraseña
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            @if (session('success'))
                <div class="container-fluid">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <a  class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="container-fluid">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <a  class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                    </div>
                </div>
            @endif

            @if (session('warning'))
                <div class="container-fluid">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <a  class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                    </div>
                </div>
            @endif

            @if (session('info'))
                <div class="container-fluid">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('info') }}
                        <a  class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        function send(el)
        {
            el.disabled = true;
            $('form').submit();
        }
    </script>
</body>
</html>
