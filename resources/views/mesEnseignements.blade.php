@extends('layouts.main')
@section('title')
Liste des enseignements auxquels vous participez
@stop
@section('content')


 <ul class="collapsible white" data-collapsible="expandable">
        <li class="collection-header orange-text"><h4 class="center">Liste des enseignements auxquels vous participez</h4></li>
 @foreach($enseignements as $enseignement)
    <li>

      <div class="collapsible-header "><strong class="orange-text"> {!! $enseignement->nomUE !!}</strong><span class="right">{!! $enseignement->nomFormation !!}</span></div>
      <div class="collapsible-body white">
        <div class="row">
          
            
                <blockquote>
                <h4 class="header light">Description</h4>
                
                <!-- Contenu du premier EC -->

                <p class="flow-text">{!! $enseignement->descriptionUE !!} </p>
                

                <h4 class="light">Synthèse</h4>
                </blockquote>

                <div class="row">

                  <table class="bordered">
                    <thead>
                        <tr>
                          <th></th>
                          <th>EI</th>
                          <th>CM</th>
                          <th>TD</th>
                          <th>TP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <th>Volume attendu</th>
                          <td>{!! $enseignement->ei_volume_attendu !!}</td>
                          <td>{!! $enseignement->cm_volume_attendu !!}</td>
                          <td>{!! $enseignement->td_volume_attendu !!}</td>
                          <td>{!! $enseignement->tp_volume_attendu !!}</td>
                        </tr>
                        <tr>
                          <th>Volume affecté</th>
                          <td>{!! $enseignement->ei_volume_affecte !!}</td>
                          <td><span class=" green-text">{!! $enseignement->cm_volume_affecte !!}</span></td>
                          <td><span class=" green-text">{!! $enseignement->td_volume_affecte !!}</span></td>
                          <td><span class=" green-text">{!! $enseignement->tp_volume_affecte !!}</span></td>
                        </tr>
                        <tr>
                          <th>Nombre de groupes attendus</th>
                          <td>{!! $enseignement->ei_nb_groupes_attendus !!}</td>
                          <td>{!! $enseignement->cm_nb_groupes_attendus !!}</td>
                          <td>{!! $enseignement->td_nb_groupes_attendus !!}</td>
                          <td>{!! $enseignement->tp_nb_groupes_attendus !!}</td>
                        </tr>
                        <tr>
                          <th>Nombre de groupes affecté</th>
                          <td>{!! $enseignement->ei_nb_groupes_affectes !!}</td>
                          <td>{!! $enseignement->cm_nb_groupes_affectes !!}</td>
                          <td><span class=" green-text">{!! $enseignement->td_nb_groupes_affectes !!}</span></td>
                          <td><span class=" red-text">{!! $enseignement->tp_nb_groupes_affectes !!}</span></td>
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
                      <th class="center" colspan="2">EI</th>
                      <th class="center" colspan="2">TD</th>
                      <th  class="center"colspan="2">TP</th>
                  </tr>
                </thead>

                <thead>
                  <tr>
                      <th></th>

                      <th class="center">Heure</th>
                      <th class="center">Nombre de groupes</th>
                      <th class="center">Heures par groupes</th>
                      <th class="center">Nombre de groupes</th>
                      <th class="center">Heures par groupes</th>
                      <th class="center">Nombre de groupes</th>
                      <th class="center">Heures par groupes</th>

                  </tr>
                </thead>

                <tbody>

                @foreach($enseignantsArray as $key => $enseignants)

                    @foreach($enseignants as $enseignant)
                        @if($enseignant->id_ue == $enseignement->id_unit_ens)

                            <tr>

                                <td>{!! $enseignant->nom . ' ' . $enseignant->prenom !!} </td>
                                <td class="center">{!! $enseignant->cm_volume_affecte !!}</td>
                                <td class="center">{!! $enseignant->ei_nb_groupes_affectes !!}</td>
                                <td class="center">{!! $enseignant->ei_volume_affecte !!}</td>
                                <td class="center">{!! $enseignant->td_nb_groupes_affectes !!}</td>
                                <td class="center">{!! $enseignant->td_volume_affecte !!}</td>
                                <td class="center">{!! $enseignant->tp_nb_groupes_affectes !!}</td>
                                <td class="center">{!! $enseignant->tp_volume_affecte !!}</td>
                            </tr>

                        @endif
                    @endforeach
                @endforeach



                </tbody>
              </table>


                <!-- Fin du Contenu du premier EC -->
            </div>

      </div>
    </li>




     @endforeach

  </ul>
        



  @include('includes.buttonExport')

    <!-- FIN CONTENT -->
  </div>

</div>
  
</main>


@stop