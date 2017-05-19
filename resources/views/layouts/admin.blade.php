<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    @include('includes.header-resp-di')
    <main>

        <div class="section no-pad-bot" id="index-banner">

            <div class="container">
            <br><br>

            @yield('content')

            </div>
        </div>

    </main>

    @include('includes.footer')
    <script>
    $( document ).ready(function(){
      $('select').material_select();
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
</body>
</html>