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
     
          <table>
            <thead>
              <tr>
                <th>Nom</th>
                <th>Statut</th>
                <th>Service statutaire</th>
                <th>Service réalisé</th>
                <th>Service réalisé à la FST</th>
              </tr>
            </thead>
            <tbody>
               @foreach($usersStatut as $userStatut)
               {{ $userStatut->nom.$userStatut->statut }}
               @endforeach

              @foreach($usersHeure as $userHeure)
               {{ $userHeure->nom.$userHeure->cm_nb_heures }}
               @endforeach


               {{$usersHeure}}

              {{var_dump($tableauHeureTotale)}}



                <tr>

                  <td>Chuck Norris</td>
                  <td>Enseignant chercheur</td>
                  <td>192</td>
                  <td><span class="red-text">170</span></td>
                  <td><span class="red-text">140</span></td>
                </tr>
                <tr>
                  <td>Groot</td>
                  <td>Doctorant</td>
                  <td>64</td>
                  <td><span class="red-text">52</span></td>
                  <td><span class="red-text">52</span></td>
                </tr>
                <tr>
                  <td>Chuck Norris</td>
                  <td>Enseignant chercheur</td>
                  <td>192</td>
                  <td><span class="red-text">170</span></td>
                  <td><span class="red-text">140</span></td>
                </tr>
                <tr>
                  <td>Groot</td>
                  <td>Doctorant</td>
                  <td>64</td>
                  <td><span class="red-text">52</span></td>
                  <td><span class="red-text">52</span></td>
                </tr>
                <tr>
                  <td>Chuck Norris</td>
                  <td>Enseignant chercheur</td>
                  <td>192</td>
                  <td><span class="red-text">170</span></td>
                  <td><span class="red-text">140</span></td>
                </tr>
                <tr>
                  <td>Groot</td>
                  <td>Doctorant</td>
                  <td>64</td>
                  <td><span class="red-text">52</span></td>
                  <td><span class="red-text">52</span></td>
                </tr>
                
            </tbody>
          </table>
        </div>
        </div>
    </div>
    
     
@stop