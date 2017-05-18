@extends('layouts.main')
@section('title')
Journal
@stop
@section('content')

<div class="col s12">
        <div class="card-content grey lighten-5">
            <br>
            <h3 class="header s12 orange-text center">Journal des modifications</h3>
            @if (isset($events))


        <table class="responsive-table bordered">
        <thead>
          <tr>
              <th>Type</th>
              <th>Nom</th>
              <th>Prenom</th>
              <th>Accepter</th>
              <th>Refuser</th>
          </tr>
        </thead>

        <tbody>

         @foreach($events as $event)

        <?php
         $user = $event->toString();
        ?>

          <tr>
            <td class="stripped">{{ $event->getType()}} </td>
            <td>{{ $user['nom']}} </td>
            <td>{{ $user['prenom']}} </td>
            <td> <button name="{{ $event->id }}" class="waves-effect waves-light btn btn-accept">Accepter</button>  </td>
            <td> <button name="{{ $event->id }}" class="waves-effect waves-light btn btn-deny">Refuser</button> </td>
          </tr>         
          
            @endforeach
        </tbody>
      </table> 
        @else 

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
