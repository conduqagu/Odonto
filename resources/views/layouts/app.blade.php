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
            <a class="navbar-brand" href="{{ url('/home') }}">
                <img src={{ asset('/favicon.png') }} height="32px"> {{ config('app.name', 'Laravel') }}
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                        </li>
                    <!--
                            @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        -->
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->userType =='student')
                                    <a class="dropdown-item" href="{{ url('/patients/index') }}">
                                        Pacientes
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/perfiles/perfilstudent') }}">
                                        Perfil
                                    </a>
                                @endif
                            <!--
                                    <a class="dropdown-item" href="{{ url('/dientes') }}">
                                        Dientes
                                    </a>-->

                                @if(Auth::user()->userType =='teacher')
                                    <a class="dropdown-item" href="{{ url('/patients/indexteacher') }}">
                                        Pacientes
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/perfiles/perfilteacher') }}">
                                        Perfil
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/user/createT') }}">
                                        Nuevo alumno
                                    </a>

                                @endif

                                @if(Auth::user()->userType =='admin')
                                    <a class="dropdown-item" href="{{ url('/user') }}">
                                        Usuarios
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/exams/indexExamsAdmin') }}">
                                        Exámenes
                                    </a>
                                    <div class="subnav">
                                        <button class="subnavbtn dropdown-item">Ajustes <i class="fa fa-caret-down"></i></button>
                                        <div class="subnav-content">
                                            <a href="{{ url('/perfiladmin') }}">Perfil</a>
                                            <a href="{{ url('/tipo_tratamientos') }}">Tratamientos</a>
                                            <a href="{{ url('/brakets') }}">Brakets</a>
                                            <a href="{{ url('/diagnosticos') }}">Diagnósticos</a>

                                        </div>
                                    </div>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </a>



                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
        @yield('content')
    </main>
</div>
</body>
</html>
