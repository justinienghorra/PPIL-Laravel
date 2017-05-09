@extends('layouts.admin')
@section('title')
Récapitulatif des enseignants
@stop
@section('content')
   

    <div class="card">
        <div class="card-content">
             <div class="row">
                <h3 class="header s12 orange-text center">Journal de modifications</h3>
             </div>

              <div class="row">
 
          <table>
            <thead class="bordered">
              <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Résumé</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>Chuck Norris</td>
                  <td>24 / 07 / 16</td>
                  <td>Ajout de l'UE - Base de données</td>
                  <td> <a class="btn btn-flat green-text">Valider</a>  <a class="btn btn-flat red-text">Refuser</a> </td>
                  
                </tr>
                <tr>
                  <td>Groot</td>
                  <td>24 / 07 / 16</td>
                  <td>Ajout de l'UE - Base de données</td>
                  <td> <a class="btn btn-flat green-text">Valider</a>  <a class="btn btn-flat red-text">Refuser</a> </td>
                  
                </tr>
                <tr>
                  <td>Chuck Norris</td>
                  <td>24 / 07 / 16</td>
                  <td>Ajout de l'UE - Base de données</td>
                  <td> <a class="btn btn-flat green-text">Valider</a>  <a class="btn btn-flat red-text">Refuser</a> </td>
                  
                </tr>
                <tr>
                  <td>Groot</td>
                  <td>24 / 07 / 16</td>
                  <td>Ajout de l'UE - Base de données</td>
                  <td> <a class="btn btn-flat green-text">Valider</a>  <a class="btn btn-flat red-text">Refuser</a> </td>
                  
                </tr>
                
                
            </tbody>
          </table>
      
      </div>
        </div>
    </div>
    
     
@stop