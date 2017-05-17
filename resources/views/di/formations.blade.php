@extends('layouts.main')
@section('title')
    Formations
@stop
@section('content')


    <div class="card">
        <div class="card-content">


            <div class="row">
                <h3 class="header s12 orange-text center">Formations</h3>
            </div>
            @if(isset($formations))

                @foreach($formations as $formation)

                    <ul class="collection with-header">
                        <li class="collection-header">
                            <h4>{{$formation->nom}}
                                <a href="#!" class="red-text secondary-content"><i class="material-icons">clear</i></a>
                            </h4>

                        </li>

                        <li class="collection-item">
                            {{$formation->description}}
                        </li>

                        <li class="collection-item">
                            <span id="resp-{{$formation->id}}">
                            @if(isset($formation->responsable))
                                    {{$formation->responsable->user->prenom . " " .  $formation->responsable->user->nom}}
                                @else
                                    Aucun responsable
                                @endif
                            </span>
                            <a href="#modal-{{$formation->id}}"
                               class="btn-modif-responsable secondary-content btn btn-flat green-text">Modifier
                                le responsable</a>
                        </li>


                    </ul>

                @endforeach



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

    @foreach($formations as $formation)
        <div id="modal-{{$formation->id}}" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <h4>Modification du responsable</h4>
                    <p>
                        Attention, vous allez modifier le responsable de {{$formation->nom}}
                    </p>

                    <ul class="collection collection-with-header">
                        <li class="collection-header"><h4>Liste des utilisateurs</h4></li>
                        @foreach($users as $user)
                            <li class="collection-item collection-utilisateurs">{{$user->prenom . " " . $user->nom }}

                                <a href="#!" onclick="modifResp(event, {{ $formation->id }} , {{ $user->id }})"
                                   class="secondary-content"><i class="material-icons">send</i></a>
                            </li>
                        @endforeach
                    </ul>


                </div>
            </div>
        </div>
    @endforeach


    <script src="/js/jquery-2.1.1.min.js"></script>
    <script>

        function makeToast(str) {
            var toastContent = '<span>' + str + '</span>';
            Materialize.toast(toastContent, 5000);
        }

        function modifResp(event, id_formation, id_utilisateur) {
            console.log('Formation : ' + id_formation)
            console.log('User : ' + id_utilisateur)
            $.ajax({
                url: "/di/formations/updateResponsable",
                method: "post",
                data: "id_utilisateur=" + id_utilisateur + "&id_formation=" + id_formation
            }).done(function (msg) {
                console.log(msg);
                if (msg['message'] === 'success') {
                    var user = msg['user'];
                    $('#resp-' + id_formation).text(user['prenom'] + ' ' + user['nom']);
                    makeToast("Modification du responsable réussie");
                    $('#modal-' + id_formation).modal('close');
                }
            }).fail(function (xhr, msg) {
                console.log(msg);
                alert('Erreur, voir console :/')
            })

        }

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
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

