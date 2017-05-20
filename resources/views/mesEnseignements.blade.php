@extends('layouts.main')
@section('title')
    Liste des enseignements auxquels vous participez
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
        <li class="collection-header orange-text"><h4 class="center">Liste des enseignements auxquels vous
                participez</h4>
        </li>

        @foreach($enseignantDansUEs as $enseignant)
            <li>
                <div class="active collapsible-header "><strong
                            class="orange-text"> {!! $enseignant->enseignement->nom !!}</strong><span
                            class="right">{!! $enseignant->enseignement->formation->nom !!}</span>
                </div>
                <div class="collapsible-body white">
                    <div class="row">


                        <blockquote>
                            <h4 class="header light">Description</h4>

                            <!-- Contenu du premier EC -->

                            <p class="flow-text">{!! $enseignant->enseignement->description !!} </p>


                            <h4 class="light">Synthèse</h4>
                        </blockquote>
                        <table class="bordered">
                            <thead>
                            <tr>
                                <th></th>
                                <th>CM</th>
                                <th>EI</th>
                                <th>TD</th>
                                <th>TP</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Volume attendu</th>
                                <td>{!! $enseignant->enseignement->cm_volume_attendu !!}</td>
                                <td>{!! $enseignant->enseignement->ei_volume_attendu !!}</td>
                                <td>{!! $enseignant->enseignement->td_volume_attendu !!}</td>
                                <td>{!! $enseignant->enseignement->tp_volume_attendu !!}</td>
                            </tr>
                            <tr>
                                <th>Volume affecté</th>
                                <td><span class=" green-text">{!! $enseignant->enseignement->getCMNbHeuresAffectees() !!}</span></td>
                                <td>{!! $enseignant->enseignement->getEINbHeuresAffectees() !!}</td>
                                <td><span class=" green-text">{!! $enseignant->enseignement->getTDNbHeuresAffectees() !!}</span></td>
                                <td><span class=" green-text">{!! $enseignant->enseignement->getTPNbHeuresAffectees() !!}</span></td>
                            </tr>
                            <tr>
                                <th>Nombre de groupes attendus</th>
                                <td>{!! $enseignant->enseignement->cm_nb_groupes_attendus !!}</td>
                                <td>{!! $enseignant->enseignement->ei_nb_groupes_attendus !!}</td>
                                <td>{!! $enseignant->enseignement->td_nb_groupes_attendus !!}</td>
                                <td>{!! $enseignant->enseignement->tp_nb_groupes_attendus !!}</td>
                            </tr>
                            <tr>
                                <th>Nombre de groupes affecté</th>
                                <td></td>
                                <td>{!! $enseignant->enseignement->getEINbGroupesAffectes() !!}</td>
                                <td><span class=" green-text">{!! $enseignant->enseignement->getTDNbGroupesAffectes() !!}</span></td>
                                <td><span class=" red-text">{!! $enseignant->enseignement->getTPNbGroupesAffectes() !!}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="row">
                        <br>
                        <blockquote>
                            <h4 class="light">Détails par enseignant</h4>
                        </blockquote>

                        <table class="responsive-table bordered">
                            <thead>
                            <tr>

                                <th class="center">Nom</th>
                                <th class="center">CM</th>
                                <th class="center" colspan="2">EI</th>
                                <th class="center" colspan="2">TD</th>
                                <th class="center" colspan="2">TP</th>
                            </tr>
                            </thead>

                            <thead>
                            <tr>
                                <th></th>

                                <th class="center">Heures</th>
                                <th class="center">Nombre de groupes</th>
                                <th class="center">Heures par groupes</th>
                                <th class="center">Nombre de groupes</th>
                                <th class="center">Heures par groupes</th>
                                <th class="center">Nombre de groupes</th>
                                <th class="center">Heures par groupes</th>

                            </tr>
                            </thead>

                            <tbody>

                            @foreach($enseignant->enseignement->enseignants as $enseignantParticipeUE)

                                <tr>
                                    <td>{!! $enseignantParticipeUE->user->nom . ' ' . $enseignantParticipeUE->user->prenom !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->cm_nb_heures !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->ei_nb_groupes !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->ei_heures_par_groupe !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->td_nb_groupes !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->td_heures_par_groupe !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->tp_nb_groupes !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->tp_heures_par_groupe !!}</td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>

                        <br>
                        <a href="#gerer-mes-horaires-{{$enseignant->id}}" class="right btn btn-flat green-text">Gérer
                            mes horaires</a>
                        <!-- Fin du Contenu du premier EC -->
                    </div>

                </div>
            </li>

        @endforeach






    </ul>

    <ul class="collapsible white" data-collapsible="expandable">
        <li class="collection-header blue-text"><h4 class="center">Liste des enseignements externe auxquels vous
                participez</h4>
        </li>
        @foreach($enseignantDansUEsExterne as $enseignantExterne)
            <li>
                <div class="active collapsible-header "><strong
                            class="blue-text"> {!! $enseignantExterne->nom !!}</strong><span
                            class="right">{!! $enseignantExterne->nom_formation !!}</span>
                </div>
                <div class="collapsible-body white">
                    <div class="row">


                        <blockquote>
                            <h4 class="header light">Description</h4>

                            <!-- Contenu du premier EC -->

                            <p class="flow-text">{!! $enseignantExterne->description !!} </p>


                            <h4 class="light">Synthèse</h4>
                        </blockquote>
                        <table class="bordered">
                            <thead>
                            <tr>
                                <th></th>
                                <th>CM</th>
                                <th>EI</th>
                                <th>TD</th>
                                <th>TP</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Volume affecté</th>
                                <td><span class=" green-text">{!! $enseignantExterne->cm_nb_heures !!}</span></td>
                                <td>{!! $enseignantExterne->getEINbHeuresAffectees() !!}</td>
                                <td><span class=" green-text">{!! $enseignantExterne->getTDNbHeuresAffectees() !!}</span></td>
                                <td><span class=" green-text">{!! $enseignantExterne->getTPNbHeuresAffectees() !!}</span></td>
                            </tr>
                            <tr>
                                <th>Nombre de groupes affecté</th>
                                <td></td>
                                <td>{!! $enseignantExterne->ei_nb_groupes !!}</td>
                                <td><span class=" green-text">{!! $enseignantExterne->td_nb_groupes !!}</span></td>
                                <td><span class=" red-text">{!! $enseignantExterne->tp_nb_groupes !!}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>


                    {{--<div class="row">
                        <br>
                        <blockquote>
                            <h4 class="light">Détails par enseignant</h4>
                        </blockquote>

                        <table class="responsive-table bordered">
                            <thead>
                            <tr>

                                <th class="center">Nom</th>
                                <th class="center">CM</th>
                                <th class="center" colspan="2">EI</th>
                                <th class="center" colspan="2">TD</th>
                                <th class="center" colspan="2">TP</th>
                            </tr>
                            </thead>

                            <thead>
                            <tr>
                                <th></th>

                                <th class="center">Heures</th>
                                <th class="center">Nombre de groupes</th>
                                <th class="center">Heures par groupes</th>
                                <th class="center">Nombre de groupes</th>
                                <th class="center">Heures par groupes</th>
                                <th class="center">Nombre de groupes</th>
                                <th class="center">Heures par groupes</th>

                            </tr>
                            </thead>

                            <tbody>

                            @foreach($enseignant->enseignement->enseignants as $enseignantParticipeUE)

                                <tr>
                                    <td>{!! $enseignantParticipeUE->user->nom . ' ' . $enseignantParticipeUE->user->prenom !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->cm_nb_heures !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->ei_nb_groupes !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->ei_heures_par_groupe !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->td_nb_groupes !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->td_heures_par_groupe !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->tp_nb_groupes !!}</td>
                                    <td class="center">{!! $enseignantParticipeUE->tp_heures_par_groupe !!}</td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>

                        <br>
                        <a href="#gerer-mes-horaires-{{$enseignant->id}}" class="right btn btn-flat green-text">Gérer
                            mes horaires</a>
                    </div>--}}
                    <br>
                    <a href="#gerer-mes-horaires-externe-{{$enseignantExterne->id}}" class="right btn btn-flat green-text">Gérer
                        mon UE externe</a><br><br>
                </div>
            </li>

        @endforeach

    </ul>

    <!-- Génération des modals -->

    <!-- Génération des modals horaire -->

    @foreach($enseignantDansUEs as $enseignantDansUE)
        <div class="modal" id="gerer-mes-horaires-{{$enseignantDansUE->id}}">
            <div class="modal-content">
                <h4>Modification de vos horaires pour l'UE {{$enseignantDansUE->enseignement->nom}}</h4>
                {!! Form::open(['url' => '/mesEnseignements/modificationUE']) !!}
                <div class="row">
                    {!! Form::hidden('id_utilisateur', $enseignantDansUE->user->id) !!}
                    {!! Form::hidden('id_ue', $enseignantDansUE->enseignement->id) !!}
                    <div class="col s6">
                        {!! Form::label('cm_volume_affecte', 'CM : Nombre d\'heures affectées') !!}
                        {!! Form::number('cm_volume_affecte', $value = $enseignantDansUE->cm_nb_heures) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                        {!! Form::label('td_nb_groupes', 'TD : Nombre de groupes') !!}
                        {!! Form::number('td_nb_groupes', $value = $enseignantDansUE->td_nb_groupes) !!}
                    </div>
                    <div class="col s6">
                        {!! Form::label('td_heures_par_groupe', 'TD : Heures par groupe') !!}
                        {!! Form::number('td_heures_par_groupe', $value = $enseignantDansUE->td_heures_par_groupe) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                        {!! Form::label('tp_nb_groupes', 'TP : Nombre de groupes') !!}
                        {!! Form::number('tp_nb_groupes', $value = $enseignantDansUE->tp_nb_groupes) !!}
                    </div>
                    <div class="col s6">
                        {!! Form::label('tp_heures_par_groupe', 'TP : Heures par groupe') !!}
                        {!! Form::number('tp_heures_par_groupe', $value = $enseignantDansUE->tp_heures_par_groupe) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                        {!! Form::label('ei_nb_groupes', 'EI : Nombre de groupes') !!}
                        {!! Form::number('ei_nb_groupes', $value = $enseignantDansUE->ei_nb_groupes) !!}
                    </div>
                    <div class="col s6">
                        {!! Form::label('ei_heures_par_groupe', 'EI : Heures par groupe') !!}
                        {!! Form::number('ei_heures_par_groupe', $value = $enseignantDansUE->ei_heures_par_groupe) !!}
                    </div>
                    {{--<button onclick="event.preventDefault();makeToast('TODO : Backend modif horaires')"
                            class="btn btn-flat green-text right" type="submit">Valider - TODO : Backend
                    </button>--}}
                        {!! Form::submit('Valider', $attributes = [ 'class' => 'btn btn-flat green-text right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach




    <!-- Génération des modals horaire externe -->

    @foreach($enseignantDansUEsExterne as $enseignantExterne)
        <div class="modal" id="gerer-mes-horaires-externe-{{$enseignantExterne->id}}">
            <div class="modal-content">
                <h4>Modification de vos informations pour l'UE externe {{$enseignantExterne->nom}}</h4>
                {!! Form::open(['url' => '/mesEnseignements/modificationUEExterne']) !!}
                <div class="row">
                    {!! Form::hidden('id_utilisateur', $enseignantExterne->user->id) !!}
                    {!! Form::hidden('id_ue_externe', $enseignantExterne->id) !!}
                    <div class="col s6">
                        {!! Form::label('nom', 'Nom de l\'UE') !!}
                        {!! Form::text('nom', $value = $enseignantExterne->nom) !!}
                    </div>
                    <div class="col s6">
                        {!! Form::label('description', 'Description de l\'UE') !!}
                        {!! Form::text('description', $value = $enseignantExterne->description) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                        {!! Form::label('nom_formation', 'Formation : Nom') !!}
                        {!! Form::text('nom_formation', $value = $enseignantExterne->nom_formation) !!}
                    </div>
                    <div class="col s6">
                        {!! Form::label('cm_volume_affecte', 'CM : Nombre d\'heures affectées') !!}
                        {!! Form::number('cm_volume_affecte', $value = $enseignantExterne->cm_nb_heures) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                        {!! Form::label('td_nb_groupes', 'TD : Nombre de groupes') !!}
                        {!! Form::number('td_nb_groupes', $value = $enseignantExterne->td_nb_groupes) !!}
                    </div>
                    <div class="col s6">
                        {!! Form::label('td_heures_par_groupe', 'TD : Heures par groupe') !!}
                        {!! Form::number('td_heures_par_groupe', $value = $enseignantExterne->td_heures_par_groupe) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                        {!! Form::label('tp_nb_groupes', 'TP : Nombre de groupes') !!}
                        {!! Form::number('tp_nb_groupes', $value = $enseignantExterne->tp_nb_groupes) !!}
                    </div>
                    <div class="col s6">
                        {!! Form::label('tp_heures_par_groupe', 'TP : Heures par groupe') !!}
                        {!! Form::number('tp_heures_par_groupe', $value = $enseignantExterne->tp_heures_par_groupe) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                        {!! Form::label('ei_nb_groupes', 'EI : Nombre de groupes') !!}
                        {!! Form::number('ei_nb_groupes', $value = $enseignantExterne->ei_nb_groupes) !!}
                    </div>
                    <div class="col s6">
                        {!! Form::label('ei_heures_par_groupe', 'EI : Heures par groupe') !!}
                        {!! Form::number('ei_heures_par_groupe', $value = $enseignantExterne->ei_heures_par_groupe) !!}
                    </div>
                    {!! Form::submit('Valider', $attributes = [ 'class' => 'btn btn-flat green-text right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach

    <!-- Fin de la génération des modals horaires -->

    <!-- Autres modals -->

    <div id="modal_export" class="modal">
        <div class="modal-content">
            <h4>Exportation des données</h4>
            <p>Les données concernant les utilisateur seront exportées au format CSV</p>
        </div>


        <div class="modal-footer">
            <a href="#!" onclick="event.preventDefault();makeToast('TODO :  Exportation')"
               class="modal-action modal-close waves-effect waves-green btn-flat blue-text">Exporter</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red-text">Annuler</a>
        </div>
    </div>

    <div class="modal" id="modal_add">
        <div class="modal-content">
            <h4>Ajout d'une UE externe</h4>
            <p>
            {!! Form::open(['url' => '/mesEnseignements/ajoutUEExterne']) !!}
            <div class="row">
                {!! Form::hidden('id_utilisateur', $userA->id) !!}
                <div class="col s6">
                    {!! Form::label('nom', 'Nom de l\'UE') !!}
                    {!! Form::text('nom') !!}
                </div>
                <div class="col s6">
                    {!! Form::label('description', 'Description de l\'UE') !!}
                    {!! Form::text('description') !!}
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    {!! Form::label('nom_formation', 'Formation : Nom') !!}
                    {!! Form::text('nom_formation') !!}
                </div>
                <div class="col s6">
                    {!! Form::label('cm_volume_affecte', 'CM : Nombre d\'heures affectées') !!}
                    {!! Form::number('cm_volume_affecte') !!}
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    {!! Form::label('td_nb_groupes', 'TD : Nombre de groupes') !!}
                    {!! Form::number('td_nb_groupes') !!}
                </div>
                <div class="col s6">
                    {!! Form::label('td_heures_par_groupe', 'TD : Heures par groupe') !!}
                    {!! Form::number('td_heures_par_groupe') !!}
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    {!! Form::label('tp_nb_groupes', 'TP : Nombre de groupes') !!}
                    {!! Form::number('tp_nb_groupes') !!}
                </div>
                <div class="col s6">
                    {!! Form::label('tp_heures_par_groupe', 'TP : Heures par groupe') !!}
                    {!! Form::number('tp_heures_par_groupe') !!}
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    {!! Form::label('ei_nb_groupes', 'EI : Nombre de groupes') !!}
                    {!! Form::number('ei_nb_groupes') !!}
                </div>
                <div class="col s6">
                    {!! Form::label('ei_heures_par_groupe', 'EI : Heures par groupe') !!}
                    {!! Form::number('ei_heures_par_groupe') !!}
                </div>
                {!! Form::submit('Ajouter', $attributes = [ 'class' => 'btn btn-flat green-text right']) !!}
            </div>
            {!! Form::close() !!}
            </p>
            <p>
                {{--<button onclick="makeToast('Noop')" class="btn btn-flat green-text">Ajouter</button>--}}
            </p>
        </div>
    </div>

    <!-- Fin autres modals -->


    @include('includes.buttonExportAdd')



@stop