@extends('layouts.main')
@section('title')
    Journal
@stop
@section('content')

    <div class="card">
        <div class="card-content">

            <h3 class="header s12 orange-text center">Journal des modifications</h3>

            <table class=" bordered">
                <thead>
                <tr>
                    <th>Description</th>
                    <th colspan="2">Actions</th>

                </tr>
                </thead>

                <tbody>

                @foreach($events as $event)

                    <tr id="row-{{$event->id}}">
                        <td>{{ $event->toString()}} </td>
                        <td>
                            <button name="{{ $event->id }}" class="waves-effect waves-light btn btn-flat green-text btn-accept">Accepter
                            </button>
                        </td>
                        <td>
                            <button name="{{ $event->id }}" class="waves-effect btn-flat red-text waves-light btn btn-deny">Refuser
                            </button>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script src="/js/jquery-2.1.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    // Important
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-accept').click(function (e) {
                $(this).blur();
                var id_event = $(this).attr('name');

                $.ajax({
                    url: "/di/journal/accept",
                    type: "POST",
                    data: "id_journal=" + id_event,
                }) .done(function (msg) {
                    if (msg['message'] === 'success') {
                        makeToast("Acceptation de la demande : OK");
                        $('#row-'+id_event).remove();
                    } else {
                        makeToast("Erreur serveur : ");
                    }
                });
            });

            $('.btn-deny').click(function (e) {
                $(this).blur();
                var id_event = $(this).attr('name');

                $.ajax({
                    url: "/di/journal/deny",
                    type: "POST",
                    data: "id_journal=" + id_event,
                }) .done(function (msg) {
                    if (msg['message'] === 'success') {
                        makeToast("Refus de la demande : OK");
                        $('#row-'+id_event).remove();
                    } else {
                        // TODO : erreur
                    }
                }) .fail(function (xhr, msg) {
                    makeToast("Erreur serveur : " + xhr.status);
                });
            });
        });
    </script>
@stop
