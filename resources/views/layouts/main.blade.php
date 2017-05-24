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

    function deleteNotification(event, id_notification) {
        event.preventDefault();
        $.ajax({
            url: '/notifications/delete',
            method: 'post',
            data: 'id_notification=' + id_notification
        }).done(function (msg) {
            $('#notification-'+id_notification).remove();
            var count = parseInt($('#notif-count').text());
            console.log('Count : ' + count);
            count = count - 1;
            $('#notif-count').text(count);
        }).fail(function (xhr, msg) {
            makeToast('Erreur serveur : ' + xhr.status);
        });
    }

    function deleteNotificationMobile(event, id_notification) {
        event.preventDefault();
        $.ajax({
            url: '/notifications/delete',
            method: 'post',
            data: 'id_notification=' + id_notification
        }).done(function (msg) {
            $('#notification-mobile-'+id_notification).remove();
            var count = parseInt($('#notif-count-mobile').text());
            console.log('Count : ' + count);
            count = count - 1;
            $('#notif-count-mobile').text(count);

        }).fail(function (xhr, msg) {
            makeToast('Erreur serveur : ' + xhr.status);
        });
    }

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                // Important
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('select').material_select();

        $('.modal').modal();

        $('.button-collapse').sideNav();

        $('.collapsible').collapsible();

        $('.dropdown-button').dropdown({
            hover: true, // Activate on hover
            belowOrigin: true,
            constrainWidth: false
        });

        $('.tooltipped').tooltip({delay: 50});
    });

</script>
</body>
</html>