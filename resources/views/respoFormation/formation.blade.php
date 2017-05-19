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
    <div class="card">
        <div class="card-content">

            <div class="row">
                <h3 class="header s12 orange-text center">{{$formation->nom}}</h3>
            </div>

            <blockquote class="flow-text">
                <p><strong>Description :</strong> {{$formation->description}}</p>
                <p><strong>Responsable :</strong> {{$formation->responsable->user->prenom . " " . $formation->responsable->user->nom }}</p>
            </blockquote>

            <ul class="collapsible white" data-collapsible="expandable">
                <li class="collection-header orange-text">
                    <h4 class="center">Liste des UE</h4>
                </li>
                @foreach($ues as $ue)
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
                        <blockquote class="hide-on-med-and-down"><h4 class="light">Détails par enseignant</h4>
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
                @endforeach
            </ul>






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
