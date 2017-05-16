@extends('layouts.main')
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
        



  @include('includes.buttonExport')

    <!-- FIN CONTENT -->
  </div>

</div>
  
</main>


@stop