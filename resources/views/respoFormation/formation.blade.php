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
    {{ $formation->nom }}
@stop
@section('content')

    <ul class="collapsible white" data-collapsible="expandable" style="padding-right: 10px;padding-left: 10px;">
        <li class="active collection-header">
            <div class="row">
                <h3 class="header s12 orange-text center">{{$formation->nom}}</h3>
            </div>

            <blockquote class="flow-text">
                <p><strong>Description :</strong> {{$formation->description}}</p>
            </blockquote>
        </li>
        @foreach($ues as $ue)
            <li>
                <div class="collapsible-header">
                    <strong class="orange-text">{{$ue->nom}}</strong></div>
                <div class="collapsible-body white">

                    <div class="row">
                        <blockquote class="flow-text">
                            <p><strong>Description :</strong> {{$ue->description}}</p>
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
                                    {!! redOrGreen($ue->cm_volume_attendu, $ue->getCMNbHeuresAffectees()) !!}
                                    {{$ue->getCMNbHeuresAffectees()}}
                                </td>
                                <td class="center">
                                    {!! redOrGreen($ue->td_volume_attendu, $ue->getTDNbHeuresAffectees()) !!}
                                    {{$ue->getTDNbHeuresAffectees()}}
                                </td>
                                <td class="center">
                                    {!! redOrGreen($ue->tp_volume_attendu, $ue->getTPNbHeuresAffectees()) !!}
                                    {{$ue->getTPNbHeuresAffectees()}}
                                </td>
                                <td class="center">
                                    {!! redOrGreen($ue->ei_volume_attendu, $ue->getEINbHeuresAffectees()) !!}
                                    {{$ue->getEINbHeuresAffectees()}}
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
                                    {!! redOrGreen($ue->td_nb_groupes_attendus, $ue->getTDNbGroupesAffectes()) !!}
                                    {{$ue->getTDNbGroupesAffectes()}}
                                </td>
                                <td class="center">
                                    {!! redOrGreen($ue->tp_nb_groupes_attendus, $ue->getTPNbGroupesAffectes()) !!}
                                    {{$ue->getTPNbGroupesAffectes()}}
                                </td>
                                <td class="center">
                                    {!! redOrGreen($ue->ei_nb_groupes_attendus, $ue->getEINbGroupesAffectes()) !!}
                                    {{$ue->getEINbGroupesAffectes()}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="row">
                        <blockquote class="hide-on-med-and-down">
                            <h4 class="light">Détails par enseignant</h4>
                        </blockquote>

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
                            @foreach($ue->enseignants as $enseignant)
                                <tr>
                                    <td class="center">{{$enseignant->user->nom . " " . $enseignant->user->prenom}}</td>
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
                    <div class="row">
                        <a href="#modal-gerer-enseignants-{{$ue->id}}"
                           class="btn btn-flat green-text waves-effect waves-light">Gérer les enseignants</a>
                        <a href="#modal-modifier-responsable-{{$ue->id}}"
                           class="right btn btn-flat red-text waves-effect waves-light">Modifier le responsable</a>
                    </div>
                    <div class="row">
                        <a href="#modal-gerer-horaires-{{$ue->id}}"
                           class=" btn btn-flat blue-text waves-effect waves-light">Gérer les horaires</a>
                        <a href="#modal-suppression-{{$ue->id}}"
                           class="right btn btn-flat red-text waves-effect waves-light">Supprimer</a>
                    </div>

                </div>
            </li>

        @endforeach
    </ul>

    <!-- Gen modals -->

    @foreach($ues as $ue)

        <div class="modal" id="modal-gerer-enseignants-{{$ue->id}}">
            <div class="modal-content">
                <h4>Gestion des enseignants de l'UE {{$ue->nom}}</h4>

                <blockquote><h4>Suppression d'enseignants</h4></blockquote>

                <div class="row">
                    <form class="col s12" action="#!">
                        @foreach($ue->enseignants as $enseignant)
                            <p>
                                <input name="enseignants_a_supprimer[]" type="checkbox"
                                       value="{{$enseignant->user->id}}" id="{{$enseignant->user->id}}"/>
                                <label for="{{$enseignant->user->id}}">{{ $enseignant->user->prenom . " " . $enseignant->user->nom }}</label>
                            </p>
                        @endforeach
                        <button onclick="event.preventDefault();makeToast('TODO : suppression enseignant')"
                                class="right btn btn-flat red-text" type="submit">Supprimer
                        </button>
                    </form>
                </div>

                <blockquote><h4>Ajout d'un enseignant</h4></blockquote>

                <div class="row">
                    <form class="col s12" action="#!">
                        <select name="ajout_enseignant" id="">
                            @foreach(App\User::all() as $user)
                                <option value="{{$user->id}}">{{$user->prenom . " " . $user->nom}}</option>
                            @endforeach
                        </select>
                        <button onclick="event.preventDefault();makeToast('TODO : ajout enseignant')"
                                class="right btn btn-flat green-text" type="submit">Ajouter
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal" id="modal-gerer-horaires-{{$ue->id}}">
            <div class="modal-content">
                <h4>Gestion des horaires de l'UE {{$ue->nom}}</h4>
                <blockquote><h4>Modification des horaires globaux</h4></blockquote>
                {!! Form::open(['url' => '#!'], $attributes = ['class' => 'col s12']) !!}
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
                    <button onclick="event.preventDefault();makeToast('TODO : Backend modif horaires globaux')"
                            class="btn btn-flat green-text right" type="submit">Valider
                    </button>
                </div>

                {!! Form::close() !!}

                @foreach($ue->enseignants as $enseignant)

                    <blockquote><h4>Modification des horaires
                            de {{$enseignant->user->civilite . " " . $enseignant->user->prenom . " " . $enseignant->user->nom}}</h4>
                    </blockquote>
                    {!! Form::open(['url' => '#!']) !!}
                    <div class="row">
                        {!! Form::hidden('id_utilisateur', $enseignant->user->id) !!}
                        <div class="col s6">
                            {!! Form::label('cm_volume_affecte', 'CM : Nombre d\'heures affectées') !!}
                            {!! Form::number('cm_volume_affecte', $value = $enseignant->cm_nb_heures) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            {!! Form::label('td_nb_groupes', 'TD : Nombre de groupes') !!}
                            {!! Form::number('td_nb_groupes', $value = $enseignant->td_nb_groupes) !!}
                        </div>
                        <div class="col s6">
                            {!! Form::label('td_heures_par_groupe', 'TD : Heures par groupe') !!}
                            {!! Form::number('td_heures_par_groupe', $value = $enseignant->td_heures_par_groupe) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            {!! Form::label('tp_nb_groupes', 'TP : Nombre de groupes') !!}
                            {!! Form::number('tp_nb_groupes', $value = $enseignant->tp_nb_groupes) !!}
                        </div>
                        <div class="col s6">
                            {!! Form::label('tp_heures_par_groupe', 'TP : Heures par groupe') !!}
                            {!! Form::number('tp_heures_par_groupe', $value = $enseignant->tp_heures_par_groupe) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            {!! Form::label('ei_nb_groupes', 'EI : Nombre de groupes') !!}
                            {!! Form::number('ei_nb_groupes', $value = $enseignant->td_nb_groupes) !!}
                        </div>
                        <div class="col s6">
                            {!! Form::label('ei_heures_par_groupe', 'EI : Heures par groupe') !!}
                            {!! Form::number('ei_heures_par_groupe', $value = $enseignant->td_heures_par_groupe) !!}
                        </div>
                        <button onclick="event.preventDefault();makeToast('TODO : Backend modif horaires enseignants')"
                                class="btn btn-flat green-text right" type="submit">Valider
                        </button>
                    </div>
                    {!! Form::close() !!}

                @endforeach
            </div>
        </div>

        <div id="modal-modifier-responsable-{{$ue->id}}" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <h4>Modification du responsable</h4>
                    <p>
                        Attention, vous allez modifier le responsable de {{$ue->nom}}
                    </p>
                    <ul class="collection collection-with-header">
                        <li class="collection-header"><h4>Liste des utilisateurs</h4></li>
                        <li v-for="(user, index) in users" class="collection-item">
                            {{ $user->prenom . " " . $user->nom }}
                            <a href="#!" @click.prevent="modifierresponsable(formationarg.id, user.id)"
                               class="secondary-content"><i class="material-icons">send</i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="modal-suppression-{{$ue->id}}" class="modal"> 
            <div class="modal-content">
                <div class="row">
                    <h4>Suppression de l'UE</h4>
                    <p>
                        Attention, vous allez supprimer la formation {{$ue->nom}}
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" @click.prevent="deleteformation(formationarg.id)" class="modal-action modal-close waves-effect waves-light btn-flat red-text" >Confirmer</a>
            </div>
        </div>

    @endforeach

    <div class="modal" id="modal_add">
        <div class="modal-content">
            <div class="row">
                <h4>Ajout d'une UE</h4>
            </div>
            <form method="post" action="/di/formations/add" id="form-add" class="row">
                <input type="hidden" name="_token" :value="token" >
                <div class="input-field col s12">
                    <input name="nom" id="add-nom" type="text">
                    <label for="">Nom</label>
                </div>
                <div class="input-field col s12">
                    <input name="description" id="add-description" type="text">
                    <label for="">Description</label>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" @click="submitformadd" class="modal-action  waves-effect waves-light btn-flat green-text" >Confirmer</a>
        </div>
    </div>

    <div id="modal_export" class="modal">
        <div class="modal-content">
            <h4>Exportation des données</h4>
            <p>Les données concernant les utilisateur seront exportées au format CSV</p>
        </div>


        <div class="modal-footer">
            <a href="/di/formations.csv" onclick="makeToast('Exportation réussie')"
               class="modal-action modal-close waves-effect waves-green btn-flat blue-text">Exporter</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red-text">Annuler</a>
        </div>
    </div>

    <div id="modal_import" class="modal">
        <div class="modal-content">
            <div class="row">
                <h4>Importation des données</h4>
                <p>Les données importées doivent être au format CSV. Un header doit être présent et le
                    séparateur doit
                    être ;</p>
                <p>Le format à respecter est le suivant : <br><strong>nom ; description ; email du responsable</strong></p>
            </div>
            <div class="row">
                <form id="form-import" method="post" action="/di/formations/importCSV" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="file-field input-field">
                        <div class="btn purple">
                            <span>Choisir un fichier</span>
                            <input type="file" name="file_csv">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </form>
            </div>

        </div>


        <div class="modal-footer">
            <a onclick="submitImport(event) " href="#!" class="btn-large modal-action modal-close waves-effect waves-light btn-flat
               purple-text">Importer</a>
            <a href="#!"
               class="modal-action modal-close waves-effect waves-light btn-flat btn-large red-text">Annuler</a>
        </div>
    </div>

    <!-- End modal -->










    <div class="card">
        <div class="card-content">
            <table border="1" id="tableau_ues">

                @foreach($ues as $ue)
                    <tr id="{{$ue->id}}">
                        <td><a href="/ue/{{$ue->nom}}">{{$ue->nom}}</a></td>
                        <td>{{$ue->description}}</td>
                        <td>
                            <select id="responsable">
                                <option value="0" class="option-responsable"></option>
                                @foreach($users as $user)
                                    <option class="option-responsable"


                                            @if(isset($ue->responsable))

                                            @if ($ue->responsable->user->id === $user->id)
                                            selected="selected"
                                            @endif

                                            @endif

                                            value="{{$user->id}}">{{$user->prenom . " " . $user->nom }}</option>
                                @endforeach
                            </select>
                            <button class="btn-modifier-ue">Modifier</button>
                        </td>

                        <td>
                            <button id="{{$ue->id}}" class="btn-delete-ue" type="submit">Supprimer</button>
                        </td>
                    </tr>

                @endforeach

            </table>


            <hr>


            <h2>Ajouter une UE</h2>
            <p>
                AJAX :
            <ul>
                <li>Renvoie en json {message: success, ue: lesinfosdelue}</li>
            </ul>
            </p>
            <div>
                <label for="nom">Nom : </label>
                <input id="nom-ue-add" type="text" name="nom">
                <label for="description">Description : </label>
                <input id="description-ue-add" type="text" name="description">
                <button id="btn-add-ue" type="submit">Ajouter</button>
            </div>

            <hr>
            <h2>Importer un CSV</h2>
            <form method="post" action="/respoFormation/formation/{{$formation->nom}}/import"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="file_csv"/>
                <button type="submit">Envoyer</button>
            </form>
            <hr>
            <h2>Exportation en CSV</h2>
            <a href="/respoFormation/formation/{{$formation->nom}}/export">Exporter</a>
        </div>
    </div>


    @include('includes.buttonImportExportAdd')


    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/materialize.js"></script>

    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="token"]').attr('content')
                }
            });

            $('#btn-add-ue').click(function (event) {
                var nom = $('#nom-ue-add').val();
                var desc = $('#description-ue-add').val();

                console.log('nom : ' + nom);
                console.log('desc : ' + desc);
                $.ajax({
                    url: "/respoFormation/formation/{{$formation->nom}}/add",
                    method: "POST",
                    data: "nom=" + nom + "&description=" + desc
                })
                    .done(function (msg) {
                        console.log(msg);
                        if (msg['message'] === 'success') {
                            var tab = $('#tableau_ues');
                            var str = '<tr id="' + msg['ue']['id'] + '">';
                            str = str + '<td><a href="/formation/{{$formation->nom}}/' + msg['ue']['nom'] + '">' + msg['ue']['nom'] + '</a></td>';
                            str = str + '<td>' + msg['ue']['description'] + '</td>';
                            str = str + '<td></td>';
                            str = str + '<td><button type="submit" class="btn-delete-ue" id=">' + msg['ue']['id'] + '">Supprimer</button></td>';
                            tab.append(str);
                        } else {
                            alert('ECHEC :/')
                        }
                    })

                    .fail(function (xhr, msg) {
                        console.log(xhr);
                        console.log(msg);
                        alert('ERREUR voir console <3');
                    });
            });

            $('.btn-delete-ue').click(function () {
                var id_ue = $(this).attr('id');
                $.ajax({
                    url: "/respoFormation/formation/{{$formation->nom}}/delete",
                    method: "POST",
                    data: "id_ue=" + id_ue
                })
                    .done(function (msg) {
                        console.log(msg);
                        if (msg['message'] === 'success') {
                            $('tr#' + id_ue).remove();
                        } else {
                            alert('ECHEC :/')
                        }
                    })

                    .fail(function (xhr, msg) {
                        console.log(msg);
                        console.log(xhr);
                        alert('ERREUR voir console <3');
                    });
            });

            $('.btn-modifier-ue').click(function () {
                var id_utilisateur = $(this).parent().find("#responsable").find(':selected').attr('value');
                var id_ue = $(this).parent().parent().attr('id');
                console.log('User  : ' + id_utilisateur);
                console.log('ue  : ' + id_ue);
                $.ajax({
                    url: "/respoFormation/formation/{{$formation->nom}}/updateResponsable",
                    method: "POST",
                    data: "id_utilisateur=" + id_utilisateur + "&id_ue=" + id_ue
                })
                    .done(function (msg) {
                        console.log(msg);
                        if (msg['message'] === 'success') {
                            //
                        } else {
                            alert('ECHEC :/')
                        }
                    })
                    .fail(function (xhr, msg) {
                        console.log(msg);
                        console.log(xhr);
                        alert('ERREUR voir console <3');
                    });
            });
        });
    </script>
@stop
