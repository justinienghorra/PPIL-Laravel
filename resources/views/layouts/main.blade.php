<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
@include('includes.header-main-v2')
<main>

    <div id="main-container" class="section no-pad-bot" id="index-banner">

        <div class="container">
            <br><br>

            @yield('content')

        </div>
    </div>

</main>

@include('includes.footer')
<script>

    function update() {
        var velocity = 0.5;
        var pos = $(window).scrollTop();
        $('.container').each(function () {
            var $element = $(this);
            // subtract some from the height b/c of the padding
            var height = $element.height() - 18;
            $(this).css('backgroundPosition', '50% ' + Math.round((height - pos) * velocity) + 'px');
        });
    };

    $(document).ready(function () {

        $('select').material_select();

        $('.modal').modal();

        $('.button-collapse').sideNav();

        $('.collapsible').collapsible();

        $('.dropdown-button').dropdown({
            hover: true, // Activate on hover
            belowOrigin: true,
            constrainWidth: false,
        });

        $('.tooltipped').tooltip({delay: 50});

        $(window).bind('scroll', update);


    });

</script>
</body>
</html>