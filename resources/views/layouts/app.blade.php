<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/xplod.png') }}" type="image/x-icon" />

    <title>XPLOD</title>

    <!-- Styles -->
    <link href="{{ asset('css/vendor.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div id="app">
          @auth
          <nav class="nav-fixed grey lighten-2">
            <div class="nav-wrapper container">
              <a href="#" data-activates="slide-out" class="button-collapse black-text" ><i class="material-icons">menu</i></a>
              {{-- <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a> --}}
              <a id="logo-container" class="brand-logo">
                <img src="{{ asset('img/infashion.png') }}" alt="" style="vertical-align: middle;" width="120px">
              </a>
              <!-- Horizontal Navbar links only shown on large resolutions -->
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                {{-- <li><a href="#" id="button_delete">Delete All<i class="mdi-action-delete left"></i></a></li> --}}
               {{--  @guest
                    <li><a href="{{ route('login') }}" class="black-text"><i class="material-icons left">power_settings_new</i>Iniciar sesión</a></li>
                    <li><a href="{{ route('register') }}">Registrarme</a></li>
                @else --}}
                    <li>
                        <a class="black-text" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"> 
                            <i class="material-icons left">power_settings_new</i>Cerrar sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                {{-- @endguest --}}
              </ul>
            </div>
          </nav>
          @endauth

          <!-- Sidebar navigation -->
          <ul id="slide-out" class="side-nav">
            @guest
                <li class="black-text"><a href="{{ route('login') }}"><i class="material-icons left">power_settings_new</i>Iniciar sesión</a></li>
                <li><a href="{{ route('register') }}">Registrarme</a></li>
            @else
                <li>
                    <a class="black-text" href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"> 
                        <i class="material-icons left">power_settings_new</i>Cerrar sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endguest
          </ul>
        
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    @yield('script')
</body>
</html>