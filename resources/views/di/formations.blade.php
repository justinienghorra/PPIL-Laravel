@extends('layouts.admin')
@section('title')
    Formations
@stop
@section('content')


    <div class="card">
        <div class="card-content">


            <h4>Objet error (pour le frontend)</h4>
            <p>
                {{ var_dump($errors) }}
                <br>
                @if(isset($errors_custom))
                    {{var_dump($errors_custom)}}
                @endif
            </p>

            <h1>Formations</h1>

            @if(isset($formations))

                <table class="bordered" id="tableau_formations">

                    @foreach($formations as $formation)

                        <tr id="{{$formation->id}}">
                            <td><a href="/formations/{{$formation->nom}}">{{$formation->nom}}</a></td>
                            <td>{{$formation->description}}</td>
                            <td>
                                <select id="responsable">
                                    <option value="0" class="option-responsable"></option>
                                    @foreach($users as $user)
                                        <option class="option-responsable"

                                                @if(isset($formation->responsable))

                                                @if ($formation->responsable->user->id === $user->id)
                                                selected="selected"
                                                @endif

                                                @endif

                                                value="{{$user->id}}">{{$user->prenom . " " . $user->nom }}</option>
                                    @endforeach
                                </select>
                                <button class="btn-modifier-formation">Modifier</button>
                            </td>

                            <td>
                                <button id="{{$formation->id}}" class="btn-delete-formation" type="submit">Supprimer
                                </button>
                            </td>
                        </tr>

                    @endforeach

                </table>

            @endif

            <hr>


            <h2>Ajouter une formation</h2>
            <p>
                AJAX :
            <ul>
                <li>Renvoie en json {message: success, formation: lesinfosdelaformation}</li>
            </ul>
            </p>
            <div>
                <label for="nom">Nom : </label>
                <input id="nom-formation-add" type="text" name="nom">
                <label for="description">Description : </label>
                <input id="description-formation-add" type="text" name="description">
                <button id="btn-add-formation" type="submit">Ajouter</button>
            </div>


            <hr>
            <h2>Importer un CSV</h2>
            <form method="post" action="/di/formations/import" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="file_csv"/>
                <button type="submit">Envoyer</button>
            </form>
            <hr>
            <h2>Exportation en CSV</h2>
            <a href="/di/formations.csv">Exporter</a>


        </div>
    </div>
    <script src="/js/jquery-2.1.1.min.js"></script>
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="token"]').attr('content')
                }
            });

            $('#btn-add-formation').click(function (event) {
                var nom = $('#nom-formation-add').val();
                var desc = $('#description-formation-add').val();
                $.ajax({
                    url: "/di/formations/add",
                    method: "POST",
                    data: "nom=" + nom + "&description=" + desc
                })
                    .done(function (msg) {
                        console.log(msg);
                        if (msg['message'] === 'success') {
                            var tab = $('#tableau_formations');
                            var str = '<tr id="' + msg['formation']['id'] + '">';
                            str = str + '<td><a href="/formations/' + msg['formation']['nom'] + '">' + msg['formation']['nom'] + '</a></td>';
                            str = str + '<td>' + msg['formation']['description'] + '</td>';
                            str = str + '<td></td>';
                            str = str + '<td><button type="submit" class="btn-delete-formation" id=">' + msg['formation']['id'] + '">Supprimer</button></td>';
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

            $('.btn-delete-formation').click(function () {
                var id_formation = $(this).attr('id');
                $.ajax({
                    url: "/di/formations/delete",
                    method: "POST",
                    data: "id_formation=" + id_formation
                })
                    .done(function (msg) {
                        console.log(msg);
                        if (msg['message'] === 'success') {
                            $('tr#' + id_formation).remove();
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

            $('.btn-modifier-formation').click(function () {
                var id_utilisateur = $(this).parent().find("#responsable").find(':selected').attr('value');
                var id_formation = $(this).parent().parent().attr('id');
                console.log('User  : ' + id_utilisateur);
                console.log('Formation  : ' + id_formation);
                $.ajax({
                    url: "/di/formations/updateResponsable",
                    method: "POST",
                    data: "id_utilisateur=" + id_utilisateur + "&id_formation=" + id_formation
                }).done(function (msg) {
                    console.log(msg);
                    if (msg['message'] === 'success') {
                        //
                    } else {
                        alert('ECHEC :/')
                    }
                }).fail(function (xhr, msg) {
                    console.log(msg);
                    console.log(xhr);
                    alert('ERREUR voir console <3');
                });
            });
        });
    </script>
@stop

