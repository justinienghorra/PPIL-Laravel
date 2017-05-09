@extends('layouts.admin')
@section('title')
Récapitulatif des enseignants
@stop
@section('content')
   

    <div class="card">
        <div class="card-content">
             <div class="row">
                <h3 class="header s12 orange-text center">Annuaire</h3>
            </div>
            <div class="row">
          <form action="#" class="col s12">
            <div class="row">
              <div class="input-field col s9">
                <input id="first_name" type="text" class="validate">
                <label for="first_name">Votre recherche</label>
              </div>
              <div class="input-field col s3">
                <butto class="btn btn-flat green-text">Rechercher</butto>
              </div>
            </div>
          </form>
      </div>



      <div class="row">
          <table>
            <thead>
              <tr>
                <th>Enseignant</th>
                <th>Statut</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>Chuck Norris</td>
                  <td>Enseignant chercheur</td>
                  <td>chuck-norris@hotmail.fr</td>
                </tr>
                <tr>
                  <td>Chuck Norris</td>
                  <td>Enseignant chercheur</td>
                  <td>chuck-norris@hotmail.fr</td>
                </tr>
                <tr>
                  <td>Chuck Norris</td>
                  <td>Enseignant chercheur</td>
                  <td>chuck-norris@hotmail.fr</td>
                </tr>
                <tr>
                  <td>Chuck Norris</td>
                  <td>Enseignant chercheur</td>
                  <td>chuck-norris@hotmail.fr</td>
                </tr>
                <tr>
                  <td>Chuck Norris</td>
                  <td>Enseignant chercheur</td>
                  <td>chuck-norris@hotmail.fr</td>
                </tr>
                <tr>
                  <td>Chuck Norris</td>
                  <td>Enseignant chercheur</td>
                  <td>chuck-norris@hotmail.fr</td>
                </tr>
                
            </tbody>
          </table>
      </div>
        </div>
    </div>
    
     
@stop