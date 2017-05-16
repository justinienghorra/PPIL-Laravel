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
                             <li><a class="dropdown-button" href="#!" data-activates="dropdown_fonctionnalite">Fonctionnalitées<i class="material-icons right">arrow_drop_down</i></a>
                             </li>

                                <ul id="dropdown_fonctionnalite" class="dropdown-content">
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
                                    <li>
                                        <a href="/profil"> Accéder à votre profil </a>
                                    </li>
                                </ul>
                                @endif 
                    </ul>     

                     @if (Auth::guest()) 
                        <ul id="slide-out" class="side-nav">
                            <li><a href="{{ route('login') }}">Connexion</a></li>
                            <li><a href="{{ route('register') }}">Inscription</a></li>        
                            </ul>
                                <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a> 
                    @else
                        <ul id="slide-out" class="side-nav">
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
                            <li><a href="/profil">Acceder à votre profil</a></li>        
                            </ul>
                                <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a> 

                            @endif                              
            </div>
        </nav>
        @yield('content')
    </div>
</body>

  <script src="/js/jquery-2.1.1.min.js"></script>
  <script src="/js/materialize.js"></script>    <script>
    $( document ).ready(function(){      
      $('.modal').modal();
      $(".button-collapse").sideNav();
      $('.collapsible').collapsible();
      $('.dropdown-button').dropdown({ 
        hover: true, // Activate on hover
        belowOrigin: true,
        constrainWidth: false,
      });
      $('.tooltipped').tooltip({delay: 50});
    });
    
  </script>

</html>
