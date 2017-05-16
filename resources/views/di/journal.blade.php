@extends('layouts.admin')
@section('title')
Journal
@stop
@section('content')

    <div class="card">
        <div class="card-content">
            <h1>Journal</h1>
            @if (isset($events))

                <table border="1">

                    @foreach($events as $event)

                        <tr>
                            <td>{{ $event->toString() }} </td>
                            <td>
                                <button name="{{ $event->id }}" class="btn-accept">Accepter</button>
                            </td>
                            <td>
                                <button name="{{ $event->id }}" class="btn-deny">Refuser</button>
                            </td>
                        </tr>


                    @endforeach

                </table>


            @endif
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
                $.ajax({
                    url: "/di/journal/accept",
                    type: "POST",
                    data: "id_journal=" + $(this).attr('name'),
                    success: function () {
                        alert('Success');
                    },
                    error: function () {
                        alert('Fail');
                    },
                    dataType: 'html'
                });
            });

            $('.btn-deny').click(function (e) {
                $.ajax({
                    url: "/di/journal/deny",
                    type: "POST",
                    data: "id_journal=" + $(this).attr('name'),
                    success: function () {
                        alert('Success');
                    },
                    error: function () {
                        alert('Fail');
                    },
                    dataType: 'html'
                });
            });
        });
    </script>
@stop
