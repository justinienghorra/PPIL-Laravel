@extends('layouts.main')
@section('title')
Liste de vos UE
@stop
@section('content')
  
<!----------------------------------- 

				TODO

Back-end : Détail du volume horaire enseignant
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
				<blockquote>
					<h4 class="header light">{{$ue['description']}}</h4>
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
	                          <th>EI</th>
	                        </tr>
	                    </thead>
	                    <tbody>
		                    <tr>
	                          <th>Volume attendu</th>
	                          <td>{{$ue['cm_volume_attendu']}}</td>
	                          <td>{{$ue['td_volume_attendu']}}</td>
	                          <td>{{$ue['tp_volume_attendu']}}</td>
	                          <td>{{$ue['ei_volume_attendu']}}</td>
	                        </tr>
	                    	<tr>
	                          <th>Volume affecté</th>
	                          <td>{{$ue['cm_volume_affecte']}}</td>
	                          <td>{{$ue['td_volume_affecte']}}</td>
	                          <td>{{$ue['tp_volume_affecte']}}</td>
	                          <td>{{$ue['ei_volume_affecte']}}</td>
	                        </tr>
	                        <tr>
	                          <th>Nombre de groupes attendus</th>
	                          <td></td>
	                          <td>{{$ue['td_nb_groupes_attendus']}}</td>
	                          <td>{{$ue['tp_nb_groupes_attendus']}}</td>
	                          <td>{{$ue['ei_nb_groupes_attendus']}}</td>
	                        </tr>
	                        <tr>
	                          <th>Nombre de groupes affectés</th>
	                          <td></td>
	                          <td>{{$ue['td_nb_groupes_affectes']}}</td>
	                          <td>{{$ue['tp_nb_groupes_affectes']}}</td>
	                          <td>{{$ue['ei_nb_groupes_affectes']}}</td>
	                        </tr>
	                    </tbody>
	            	</table>

  	</li>
@endforeach
      
  </ul>


@stop


