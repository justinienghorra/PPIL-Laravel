<?php
	function redOrGreen($attendu, $affecte){
		if($attendu == $affecte){
			return '<span class=" green-text">';
		}
		return '<span class=" red-text">';
	}
?>

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
Back-end : Calcul des volumes affectés
Front-end : Changement de couleurs en fonction du volume attendu/affecté, nb gp attendus/affectés, etc. 

------------------------------------>


 <ul class="collapsible white" data-collapsible="expandable">
    <li class="collection-header orange-text">
    	<h4 class="center">Liste de vos UE</h4>
    </li>
@foreach($ues as $ue)

	<?php
		$nbEnseignants = 0; 
		$volumeCMAffecte = 0; 
		$volumeTDAffecte = 0;
		$volumeTPAffecte = 0;
		$volumeEIAffecte = 0;
		$nbGroupesTDAffectes = 0;
		$nbGroupesTPAffectes = 0;
		$nbGroupesEIAffectes = 0;
		foreach($enseignants[$ue->id] as $enseignant) {
			$nbEnseignants++;
			$volumeCMAffecte += $enseignant->cm_nb_heures;
			$volumeTDAffecte += $enseignant->td_heures_par_groupe;
			$volumeTPAffecte += $enseignant->tp_heures_par_groupe;
			$volumeEIAffecte += $enseignant->ei_heures_par_groupe;
			$nbGroupesTDAffectes += $enseignant->td_nb_groupes;
			$nbGroupesTPAffectes += $enseignant->tp_nb_groupes;
			$nbGroupesEIAffectes += $enseignant->ei_nb_groupes;
		}
		$volumeTDAffecte = $volumeTDAffecte/$nbEnseignants;
		$volumeTPAffecte = $volumeTPAffecte/$nbEnseignants;
		$volumeEIAffecte = $volumeEIAffecte/$nbEnseignants;
	?>

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
                          <td class="center">
                          	{!! redOrGreen($ue->cm_volume_attendu, $volumeCMAffecte) !!}
                          	{{$volumeCMAffecte}}
                          </td>
                          <td class="center">
                          	{!! redOrGreen($ue->td_volume_attendu, $volumeTDAffecte) !!}
                          	{{$volumeTDAffecte}}
                          </td>
                          <td class="center">
							{!! redOrGreen($ue->tp_volume_attendu, $volumeTPAffecte) !!}
                          	{{$volumeTPAffecte}}
                          </td>
                          <td class="center">
                          	{!! redOrGreen($ue->ei_volume_attendu, $volumeEIAffecte) !!}
                          	{{$volumeEIAffecte}}
                          </td>
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
                          <td class="center">
                          	{!! redOrGreen($ue->td_nb_groupes_attendus, $nbGroupesTDAffectes) !!}
                          	{{$nbGroupesTDAffectes}}
                          </td>
                          <td class="center">
                          	{!! redOrGreen($ue->tp_nb_groupes_attendus, $nbGroupesTPAffectes) !!}
                          	{{$nbGroupesTPAffectes}}
                          </td>
                          <td class="center">
                          	{!! redOrGreen($ue->ei_nb_groupes_attendus, $nbGroupesEIAffectes) !!}
                          	{{$nbGroupesEIAffectes}}
                          </td>
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
		                		<td class="center">{{$enseignant->nom . " " . $enseignant->prenom}}</td>
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


