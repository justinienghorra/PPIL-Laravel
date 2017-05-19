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
