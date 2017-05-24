<?php
function redOrGreen($attendu, $affecte)
{
    if ($attendu == $affecte) {
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
    table {
        border: none;
        border-collapse: collapse;
    }

    table td {
        border-left: 1px solid #ccc;
    }

    table th {
        border-left: 1px solid #ccc;
    }
</style> 

  <ul class="collapsible white" data-collapsible="expandable">
    <li class="collection-header orange-text">
    	<h4 class="center">Liste de vos UE</h4>
    </li>
    @foreach($ues as $ue)

	<?php
		$nbEnseignants = 0;
    $idEnseignants = array();
		$volumeCMAffecte = 0; 
		$volumeTDAffecte = 0;
		$volumeTPAffecte = 0;
		$volumeEIAffecte = 0;
		$nbGroupesTDAffectes = 0;
		$nbGroupesTPAffectes = 0;
		$nbGroupesEIAffectes = 0;
		foreach($enseignants[$ue->id] as $enseignant) {
      $idEnseignants[$nbEnseignants] = $enseignant->id_utilisateur;
			$nbEnseignants++;
			$volumeCMAffecte += $enseignant->cm_nb_heures;
			$volumeTDAffecte += $enseignant->td_heures_par_groupe*$enseignant->td_nb_groupes;
			$volumeTPAffecte += $enseignant->tp_heures_par_groupe*$enseignant->tp_nb_groupes;
			$volumeEIAffecte += $enseignant->ei_heures_par_groupe*$enseignant->ei_nb_groupes;
			$nbGroupesTDAffectes += $enseignant->td_nb_groupes;
			$nbGroupesTPAffectes += $enseignant->tp_nb_groupes;
			$nbGroupesEIAffectes += $enseignant->ei_nb_groupes;
		}
	?>

    <li>
	  	<div class="collapsible-header">
        <strong class="orange-text">{{$ue['nom']}}</strong>
      </div>
	  	<div class="collapsible-body white">
        <div class="row">
				  <h4 class="active">
            <strong class="orange-text">{{$ue['description']}}</strong>
          </h4>
				  <blockquote>
            <h4 class="light">Synthèse</h4>
          </blockquote>
        </div>
        <div>
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
          <div class="row">
            <blockquote>
              <h4 class="light">Détails par enseignant</h4>
            </blockquote>
            <table class="bordered">
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
  	            @endforeach
  	          </tbody>
  	        </table>
            <br/>
            <!-- end collapsible body -->
            <a href="#modal-gerer-enseignants-{{$ue->id}}"
               class="btn btn-flat green-text waves-effect waves-light">Gérer les enseignants</a>
            <a href="#modal-gerer-horaires-{{$ue->id}}"
               class="right btn btn-flat blue-text waves-effect waves-light">Gérer les horaires</a>
            <!-------------------------->
  		    </div>
          <!-- Génération modals -->
          <div class="modal" id="modal-gerer-enseignants-{{$ue->id}}">
            <div class="modal-content">
              <h4>Gestion des enseignants de l'UE {{$ue->nom}}</h4>
              <blockquote><h4>Suppression d'enseignants</h4></blockquote>
              <div class="row">
                <form class="col s12" method="post" action="/respoUE/deleteEnseignant">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                  <input type="hidden" name="id_ue" value="{{ $ue->id }}" />
                  @foreach($ue->enseignants as $enseignant)
                  <p>
                    <input name="enseignants_a_supprimer[]" type="checkbox"
                           value="{{$enseignant->user->id}}" id="{{$enseignant->user->id}}"/>
                    <label for="{{$enseignant->user->id}}">{{ $enseignant->user->prenom . " " . $enseignant->user->nom }}</label>
                  </p>
                  @endforeach
                  <button class="right btn btn-flat red-text" type="submit">Supprimer</button>
                </form>
              </div>
              <blockquote>
                <h4>Ajout d'un enseignant</h4>
              </blockquote>
              <div class="row">
                <form class="col s12" method="post" action="/respoUE/addEnseignant">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                  <input type="hidden" name="id_ue" value="{{ $ue->id }}" />
                  <select name="id_enseignant" id="id_enseignant">
                  @foreach(App\User::allValidate() as $user)
                    @if(!in_array($user->id, $idEnseignants))
                        <option value="{{$user->id}}">{{$user->prenom . " " . $user->nom}}</option>
                    @endif
                  @endforeach
                  </select>
                  <button class="right btn btn-flat green-text" type="submit">Ajouter</button>
                </form>
              </div>
            </div>
          </div>
          <div class="modal" id="modal-gerer-horaires-{{$ue->id}}">
            <div class="modal-content">
              <h4>Gestion des horaires de l'UE {{$ue->nom}}</h4>
              <blockquote><h4>Modification des horaires globaux</h4></blockquote>
              {!! Form::open(['url' => '/respoUE/modifUE'], $attributes = ['class' => 'col s12']) !!}
              <input type="hidden" name="id_ue" value="{{ $ue->id }}" />
                <div class="row">
                  <div class="col s6">
                    {!! Form::label('cm_volume_attendu', 'CM : Nombre d\'heures attendues') !!}
                    {!! Form::number('cm_volume_attendu', $value = $ue->cm_volume_attendu) !!}
                  </div>
                </div>
                <div class="row">
                  <div class="col s6">
                    {!! Form::label('td_volume_attendu', 'TD : Nombre d\'heures attendues') !!}
                    {!! Form::number('td_volume_attendu', $value = $ue->td_volume_attendu) !!}
                  </div>
                  <div class="col s6">
                    {!! Form::label('td_nb_groupes', 'TD : Nombre de groupes attendus') !!}
                    {!! Form::number('td_nb_groupes', $value = $ue->td_nb_groupes_attendus) !!}
                  </div>
                </div>
                <div class="row">
                  <div class="col s6">
                    {!! Form::label('tp_volume_attendu', 'TP : Nombre d\'heures attendues') !!}
                    {!! Form::number('tp_volume_attendu', $ue->tp_volume_attendu) !!}
                  </div>
                  <div class="col s6">
                    {!! Form::label('tp_nb_groupes', 'TP : Nombre de groupes attendus') !!}
                    {!! Form::number('tp_nb_groupes', $ue->tp_nb_groupes_attendus) !!}
                  </div>
                </div>
                <div class="row">
                  <div class="col s6">
                    {!! Form::label('ei_volume_attendu', 'EI : Nombre d\'heures attendues') !!}
                    {!! Form::number('ei_volume_attendu', $ue->ei_volume_attendu) !!}
                  </div>
                  <div class="col s6">
                    {!! Form::label('ei_nb_groupes', 'EI : Nombre de groupes attendus') !!}
                    {!! Form::number('ei_nb_groupes', $ue->ei_nb_groupes_attendus) !!}
                  </div>
                </div>
                <div class="row">
                  <button class="btn btn-flat green-text right" type="submit">Valider</button>
                </div>
              {!! Form::close() !!}
              @foreach($ue->enseignants as $enseignant)
                <blockquote>
                  <h4>Modification des horaires de {{$enseignant->user->civilite . " " . $enseignant->user->prenom . " " . $enseignant->user->nom}}</h4>
                </blockquote>
                {!! Form::open(['url' => '/respoUE/modifEnseignant']) !!}
                  <div class="row">
                    {!! Form::hidden('id_ue', $ue->id) !!}
                    {!! Form::hidden('id_utilisateur', $enseignant->user->id) !!}
                    <div class="col s6">
                      {!! Form::label('cm_nb_heures', 'CM : Nombre d\'heures affectées') !!}
                      {!! Form::number('cm_nb_heures', $value = $enseignant->cm_nb_heures) !!}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s6">
                      {!! Form::label('td_heures_par_groupe', 'TD : Heures par groupe') !!}
                      {!! Form::number('td_heures_par_groupe', $value = $enseignant->td_heures_par_groupe) !!}
                    </div>
                    <div class="col s6">
                      {!! Form::label('td_nb_groupes', 'TD : Nombre de groupes') !!}
                      {!! Form::number('td_nb_groupes', $value = $enseignant->td_nb_groupes) !!}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s6">
                      {!! Form::label('tp_heures_par_groupe', 'TP : Heures par groupe') !!}
                      {!! Form::number('tp_heures_par_groupe', $value = $enseignant->tp_heures_par_groupe) !!}
                    </div>
                    <div class="col s6">
                      {!! Form::label('tp_nb_groupes', 'TP : Nombre de groupes') !!}
                      {!! Form::number('tp_nb_groupes', $value = $enseignant->tp_nb_groupes) !!}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s6">
                      {!! Form::label('ei_heures_par_groupe', 'EI : Heures par groupe') !!}
                      {!! Form::number('ei_heures_par_groupe', $value = $enseignant->ei_heures_par_groupe) !!}
                    </div>
                    <div class="col s6">
                      {!! Form::label('ei_nb_groupes', 'EI : Nombre de groupes') !!}
                      {!! Form::number('ei_nb_groupes', $value = $enseignant->ei_nb_groupes) !!}
                    </div>
                    <button class="btn btn-flat green-text right" type="submit">Valider</button>
                  </div>
                {!! Form::close() !!}
              @endforeach
            </div>
    		  </div>
        </div>
      </li>
    @endforeach
  </ul>
  @include('includes.buttonExport')
  <div id="modal_export" class="modal">
    <div class="modal-content">
        <h4>Exportation des données</h4>
        <p>Les données concernant les utilisateur seront exportées au format CSV</p>
    </div>


    <div class="modal-footer">
        <a href="/respoUE/mesUE.csv" onclick="makeToast('Exportation réussie')"
           class="modal-action modal-close waves-effect waves-green btn-flat blue-text">Exporter</a>
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red-text">Annuler</a>
    </div>
  </div>

@stop