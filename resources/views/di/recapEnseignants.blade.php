@extends('layouts.main')
@section('title')
Récapitulatif des enseignants
@stop
@section('content')
   

<div class="card">
    <div class="card-content">

         <div class="row">
              <h3 class="header s12 orange-text center">Récapitulatif des enseignants</h3>
        </div>

    <div class="row">
 
      <table class ="bordered responsive-table">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Statut</th>
            <th>Service statutaire minimum</th>
            <th>Service réalisé</th>
            <th>Service réalisé à la FST</th>
          </tr>
        </thead>
        <tbody>

            @foreach($usersStatut as $userStatut)

            <tr>
              <td>{{$userStatut->nom}}</td>
              <td>{{$userStatut->prenom}}</td>
              <td>{{$userStatut->statut}}</td>
              <td>{{$userStatut->volumeMin}}</td>

              @if( ($userStatut->volumeMin) > ($tableauHeureTotale[$userStatut->id]) )
              <td><span class="red-text">{{$tableauHeureTotale[$userStatut->id]}}</span></td>
              @else
              <td><span class="green-text">{{$tableauHeureTotale[$userStatut->id]}}</span></td>
              @endif
             
              @if( ($userStatut->volumeMin) > ($tableauHeureTotaleFST[$userStatut->id]) )
              <td><span class="red-text">{{$tableauHeureTotaleFST[$userStatut->id]}}</span></td>
              @else
              <td><span class="green-text">{{$tableauHeureTotaleFST[$userStatut->id]}}</span></td>
              @endif              
              
             
            </tr>        
            @endforeach        
            
        </tbody>
      </table>
    </div>
    </div>
</div>
     
@stop