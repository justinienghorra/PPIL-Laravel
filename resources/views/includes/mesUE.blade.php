@extends('layouts.liste')
@section('title')
Liste de vos UE
@stop
@section('content')
    
 <ul class="collapsible white" data-collapsible="expandable">
        <li class="collection-header orange-text"><h4 class="center">Liste de vos UE</h4></li>
    
    <li>
    
      <div class="collapsible-header "><strong class="orange-text">Compilation</strong><span class="right">L3 Informatique</span></div>
      <div class="collapsible-body white">
        <div class="row">
          
            
                <blockquote>
                <h4 class="header light">Description</h4>
                
                <!-- Contenu du premier EC -->

                <p class="flow-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada lacus risus, at sagittis mi scelerisque vel. </p>
                

                <h4 class="light">Synthèse</h4>
                </blockquote>

                <div class="row">

                  <table class="bordered">
                    <thead>
                        <tr>
                          <th></th>
                          <th>CM</th>
                          <th>TD</th>
                          <th>TP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <th>Volume attendu</th>
                          <td>12</td>
                          <td>12</td>
                          <td>12</td>
                        </tr>
                        <tr>
                          <th>Volume affecté</th>
                          <td><span class=" green-text">12</span></td>
                          <td><span class=" green-text">12</span></td>
                          <td><span class=" green-text">12</span></td>
                        </tr>
                        <tr>
                          <th>Nombre de groupes attendus</th>
                          <td></td>
                          <td>2</td>
                          <td>4</td>
                        </tr>
                        <tr>
                          <th>Nombre de groupes affecté</th>
                          <td></td>
                          <td><span class=" green-text">2</span></td>
                          <td><span class=" red-text">3</span></td>
                        </tr>
                    </tbody>
                  </table>

                
                <br>
                <blockquote class="hide-on-med-and-down"><h4 class="light">Détails par enseignant</h4></blockquote>

                <table class="hide-on-med-and-down bordered">
                <thead>
                  <tr>
                      
                      <th class="center">Nom</th>
                      <th class="center">CM</th>
                      <th class="center" colspan="2">TD</th>
                      <th  class="center"colspan="2">TP</th>
                  </tr>
                </thead>

                <thead>
                  <tr>
                      <th></th>
                      
                      <th class="center">Heure</th>
                      <th class="center">Nb de groupes</th>
                      <th class="center">Heures par groupes</th>
                      <th class="center">Nombre de groupes</th>
                      <th class="center">Heures par groupes</th>
                      
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    
                    <td>Alvin Eclair</td>
                    <td class="center">8</td>
                    <td class="center">1</td>
                    <td class="center">6</td>
                    <td class="center">1</td>
                    <td class="center">12</td>
                  </tr>
                  <tr>
                    
                    <td>Alan Jellybean</td>
                    <td class="center">4</td>
                    <td class="center">1</td>
                    <td class="center">6</td>
                    <td class="center">1</td>
                    <td class="center">12</td>
                  </tr>
                  
                  
                </tbody>
              </table>

                
                <!-- Fin du Contenu du premier EC -->
            </div>
            
          

            <div class="row">
                <a href="#modal_enseignants" class="btn  left btn-large btn-flat orange-text">Gérer les enseignants</a>
                <a href="#modal_horaires" class="btn  right btn-large btn-flat blue-text">Gérer les horaires</a>
            </div>
              
            
          

          
      
      </div>
    </li>
    <li>
      <div class="collapsible-header"><strong class="orange-text">Base de donnée </strong><span class="right">L3 Informatique</span></div>
      <div class="collapsible-body white"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
    <li>
      <div class="collapsible-header"><strong class="orange-text">Optimisation</strong><span class="right">L3 Informatique</span></div>
      <div class="collapsible-body white"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
  </ul>
        





    <!-- FIN CONTENT -->
  </div>

</div>
@include('includes.buttonImportExport')
  
  </main>

<!-- MODAL EXPORT -->
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
      <h4>Importation de données</h4>
      
      <div class="row">
        <div class="input-field col s12">
              <select>
                <option cvalue="1">Compilation</option>
                <option value="2">Base de données</option>
                <option value="3">Optimisation</option>
              </select>
              <label>UE concernée</label>
        </div>
      </div>

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
  <!-- END MODAL IMPORT -->

<!-- Modal modif -->
  <div id="modal_horaires" class="modal">
    <div class="modal-content">
      <h4>Modification de l'UE Compilation</h4>
      
      <h5>Alvin</h5>
      <h5 class="light">CM</h5>
      <div class="row">
        <div class="input-field col s6">
          <input type="number">
          <label for="">Nombre d'heures</label>
        </div>
      </div>
      <h5 class="light">TD</h5>
      <div class="row">
        <div class="input-field col s6">
          <input type="number">
          <label for="">Nombre de groupes</label>
        </div>
        <div class="input-field col s6">
          <input type="number">
          <label for="">Heures par groupe</label>
        </div>
      </div>
      <h5 class="light">TP</h5>
      <div class="row">
        <div class="input-field col s6">
          <input type="number">
          <label for="">Nombre de groupes</label>
        </div>
        <div class="input-field col s6">
          <input type="number">
          <label for="">Heures par groupe</label>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat green-text">Confirmer</a>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red-text">Annuler</a>
    </div>
  </div>

  <!-- End modal modif -->

  <!-- Modal prof -->
  <div id="modal_enseignants" class="modal">
    <div class="modal-content">
      <h4>Modification de l'UE Compilation</h4>
      <ul class="collection with-header">
        <li class="collection-header"><h4>Enseignants</h4></li>
        <li class="collection-item"><div>Alvin<a href="#!" class="secondary-content"><i class="material-icons red-text">clear</i></a></div></li>
        <li class="collection-item"><div>Chuck Norris<a href="#!" class="secondary-content"><i class="material-icons red-text">clear</i></a></div></li>
        <li class="collection-item"><div>Mickey<a href="#!" class="secondary-content"><i class="material-icons red-text">clear</i></a></div></li>
      </ul>
      <div class="row">
        <div class="input-field">
        <div class="col s3"><div class="green-text btn btn-flat left"><span>Ajouter</span></div></div>
        <div class="col s9"><input type="text"></div>
        </div>
      </div>
      
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat green-text">Confirmer</a>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red-text">Annuler</a>
    </div>
  </div>

@stop