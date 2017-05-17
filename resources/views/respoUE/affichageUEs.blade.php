@extends('layouts.main')
@section('title')
Liste de vos UE
@stop
@section('content')
<style>
	table { border: none; border-collapse: collapse; }
	table td { border-left: 1px solid #ccc; }
	table th { border-left: 1px solid #ccc; }

</style>  
<!----------------------------------- 

				TODO

Back-end : Nom enseignant
Front-end : Changement de couleurs en fonction du volume attendu/affecté, nb gp attendus/affectés, etc. 

------------------------------------>


 <ul class="collapsible white" data-collapsible="expandable">
    <li class="collection-header orange-text">
    	<h4 class="center">Liste de vos UE</h4>
    </li>
@foreach($ues as $ue) 
    <li>
	  	<div class="collapsible-header"><strong class="orange-text">{{$ue['nom']}}</strong></div>
	  	<div class="collapsible-body white">
			<div class="row">
				<h4 class="header light">{{$ue['description']}}</h4>
				<blockquote>
					<h4 class="light">Synthèse</h4>
	            </blockquote>	
	        </div>
            <div class="row">
            	<table class="bordered">
	            	<thead>
                        <tr>
                          <th class="center"></th>
                          <th class="center">CM</th>
                          <th class="center">TD</th>
                          <th class="center">TP</th>
                          <th class="center">EI</th>
                        </tr>
                    </thead>
                    <tbody>
	                    <tr>
                          <th class="center">Volume attendu</th>
                          <td class="center">{{$ue->cm_volume_attendu}}</td>
                          <td class="center">{{$ue->td_volume_attendu}}</td>
                          <td class="center">{{$ue->tp_volume_attendu}}</td>
                          <td class="center">{{$ue->ei_volume_attendu}}</td>
                        </tr>
                    	<tr>
                          <th class="center">Volume affecté</th>
                          <td class="center">{{$ue->cm_volume_affecte}}</td>
                          <td class="center">{{$ue->td_volume_affecte}}</td>
                          <td class="center">{{$ue->tp_volume_affecte}}</td>
                          <td class="center">{{$ue->ei_volume_affecte}}</td>
                        </tr>
                        <tr>
                          <th class="center">Nombre de groupes attendus</th>
                          <td></td>
                          <td class="center">{{$ue->td_nb_groupes_attendus}}</td>
                          <td class="center">{{$ue->tp_nb_groupes_attendus}}</td>
                          <td class="center">{{$ue->ei_nb_groupes_attendus}}</td>
                        </tr>
                        <tr>
                          <th class="center">Nombre de groupes affectés</th>
                          <td></td>
                          <td class="center">{{$ue->td_nb_groupes_affectes}}</td>
                          <td class="center">{{$ue->tp_nb_groupes_affectes}}</td>
                          <td class="center">{{$ue->ei_nb_groupes_affectes}}</td>
                        </tr>
                    </tbody>
            	</table>
            </div>
            <br>
            <div class="row">
                <blockquote class="hide-on-med-and-down"><h4 class="light">Détails par enseignant</h4></blockquote>

	                <table class="hide-on-med-and-down bordered">
		                <thead>
		                  <tr>
		                      
		                      <th class="center">Nom</th>
		                      <th class="center">CM</th>
		                      <th class="center" colspan="2">TD</th>
		                      <th class="center" colspan="2">TP</th>
		                      <th class="center" colspan="2">EI</th>
		                  </tr>
		                </thead>

		                <thead>
		                  <tr>
		                      <th></th>
		                      
		                      <th class="center">Heures</th>
		                      <th class="center">Nombre de groupes</th>
		                      <th class="center">Heures par groupe</th>
		                      <th class="center">Nombre de groupes</th>
		                      <th class="center">Heures par groupe</th>
		                      <th class="center">Nombre de groupes</th>
		                      <th class="center">Heures par groupe</th>
		                      
		                  </tr>
		                </thead>
		                <tbody>
		                	@foreach($enseignants[$ue->id] as $enseignant)
		                	<tr>
		                		<td class="center">{{$enseignant->prenom . " " . $enseignant->nom}}</td>
		                		<td class="center">{{$enseignant->cm_nb_heures}}</td>
		                		<td class="center">{{$enseignant->td_nb_groupes}}</td>
		                		<td class="center">{{$enseignant->td_heures_par_groupe}}</td>
		                		<td class="center">{{$enseignant->tp_nb_groupes}}</td>
		                		<td class="center">{{$enseignant->tp_heures_par_groupe}}</td>
		                		<td class="center">{{$enseignant->ei_nb_groupes}}</td>
		                		<td class="center">{{$enseignant->ei_heures_par_groupe}}</td>
		                	</tr>
		          		</tbody>
		                	@endforeach
		            </table>
		        </div>
		    </div>

  	</li>
@endforeach
      
  </ul>


@stop


