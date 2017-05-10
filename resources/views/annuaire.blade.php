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

    @include('includes.buttonImportExport')

    <div id="modal_export" class="modal">
        <div class="modal-content">
            <h4>Exportation des données</h4>
            <div class="row">
                <div class="input-field col s12">
                    <select >
                        <option class="blue-text" value="1">PDF</option>
                        <option class="blue-text"  value="2">CSV</option>
                        <option class="blue-text" value="3">Excel</option>
                    </select>
                    <label>Format du fichier</label>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat blue-text">Exporter</a>
        </div>
    </div>
    <!-- END MODAL EXPORT -->

    <!-- MODAL IMPORT -->
    <div id="modal_import" class="modal">
        <div class="modal-content">
            <h4>Importation d'une liste d'enseignants</h4>
            
            <div class="row">
                <div class="file-field input-field">
                    <div class="btn btn-flat purple-text">
                        <span>Fichier</span>
                        <input type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat purple-text">Importer</a>
        </div>
    </div>
    
     
@stop