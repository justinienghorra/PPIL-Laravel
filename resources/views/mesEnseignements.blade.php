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
        @foreach($enseignements as $enseignement)
            <li>
                <div class="collapsible-header "><strong class="orange-text"> {!! $enseignement->nomUE !!}</strong><span
                            class="right">{!! $enseignement->nomFormation !!}</span>
                </div>
                <div class="collapsible-body white">
                    <div class="row">


                        <blockquote>
                            <h4 class="header light">Description</h4>

                            <!-- Contenu du premier EC -->

                            <p class="flow-text">{!! $enseignement->descriptionUE !!} </p>


                            <h4 class="light">Synthèse</h4>
                        </blockquote>
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
                                <td><span class=" green-text">{!! $enseignement->td_nb_groupes_affectes !!}</span>
                                </td>
                                <td><span class=" red-text">{!! $enseignement->tp_nb_groupes_affectes !!}</span>
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
                                <th class="center" colspan="2">TD</th>
                                <th class="center" colspan="2">TP</th>
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

                        <br>
                        <a href="#gerer-mes-horaires-{{$enseignement->id}}" class="right btn btn-flat green-text">Gérer
                            mes horaires</a>
                        <!-- Fin du Contenu du premier EC -->
                    </div>

                </div>
            </li>
        @endforeach






    <!-- Génération des modals -->
    </ul>

        @foreach($enseignantDansUEs as $enseignantDansUE)
            <div class="modal" id="gerer-mes-horaires-{{$enseignantDansUE->id}}">
                <div class="modal-content">
                    <h4>Modification de vos horaires pour l'UE {{$enseignantDansUE->enseignement->nom}}</h4>
                    {!! Form::open(['url' => '#!']) !!}
                    <div class="row">
                        {!! Form::hidden('id_utilisateur', $enseignantDansUE->user->id) !!}
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
                            {!! Form::number('ei_nb_groupes', $value = $enseignantDansUE->td_nb_groupes) !!}
                        </div>
                        <div class="col s6">
                            {!! Form::label('ei_heures_par_groupe', 'EI : Heures par groupe') !!}
                            {!! Form::number('ei_heures_par_groupe', $value = $enseignantDansUE->td_heures_par_groupe) !!}
                        </div>
                        <button onclick="event.preventDefault();makeToast('TODO : Backend modif horaires')"
                                class="btn btn-flat green-text right" type="submit">Valider - TODO : Backend
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        @endforeach

    <!-- Fin de la génération des modals -->


    @include('includes.buttonExport')

    <!-- FIN CONTENT -->
        </div>

        </div>

        </main>


@stop