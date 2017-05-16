<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>    

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/materialize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="light-blue lighten-1" role="navigation">
            <div class="nav-wrapper container">                 
                
                    <!-- Branding Image -->
		                <a id="logo-container" href="#" class="brand-logo">
		                 <img class="navbar-logo-connexion" src="/images/SGE.png" alt="">
		                </a>                  
		   
                    <!-- Right Side Of Navbar -->
                    <ul class="right hide-on-med-and-down">
                        <!-- Authentication Links -->
                        @if (Auth::guest())  
                                           
                            <li><a href="{{ route('login') }}">Connexion</a></li>
                            <li><a href="{{ route('register') }}">Inscription</a></li>
                        
                        @else                        
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Déconnexion
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>   

                          <ul id="slide-out" class="side-nav">

                            <li><a href="{{ route('login') }}">Connexion</a></li>
                            <li><a href="{{ route('register') }}">Inscription</a></li>
        
                         </ul>
                     <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>


            </div>
        </nav>
        @yield('content')
    </div>

</body>
</html>
