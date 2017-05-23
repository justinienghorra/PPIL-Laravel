@extends('layouts.main')
@section('title')
    Annuaire
@stop
@section('content')

    <div class="card">

        <div class="card-content">

            <div class="row">
                <h3 class="header s12 orange-text center">Annuaire</h3>
            </div>

            @if($users->count() > 0)

                <ul class="collection">
                    @foreach($users as $user)
                        <li id="li-user-{{$user->id}}" class="collection-item avatar">
                            @if(isset($user->photo))
                                <img src="{{$user->photo->pathForClient()}}" alt="" class="circle">
                            @else
                                <img src="/images/default.jpg" alt="" class="circle">
                            @endif
                            <span class="title">{{$user->civilite . " " . $user->prenom . " " . $user->nom}}</span>
                            <p>
                                @if($user->statut() == 'Aucun')
                                    Aucun statut
                                @else
                                    {{$user->statut()}}
                                @endif
                                <br>
                            {{$user->email}}
                            <!--<a onclick="deleteUser(event, {{$user->id}})" class="secondary-content" href="#!"><i
                                            class="red-text material-icons">clear</i></a>-->
                                <a class="secondary-content" href="#modal-suppression-{{$user->id}}"><i
                                            class="red-text material-icons">clear</i></a>
                            </p>
                        </li>
                    @endforeach
                </ul>

            @endif

            @foreach($users as $user)
                <div id="modal-suppression-{{$user->id}}" class="modal">
                    <div class="modal-content">
                        <h3>Suppresion d'un utilisateur</h3>
                        <p>Vous allez supprimer {{$user->civilite . " " .  $user->prenom . " " . $user->nom}}</p>
                    </div>
                    <div class="modal-footer">
                        <a onclick="deleteUser(event, {{$user->id}})"
                           class="modal-action modal-close waves-effect waves-light btn-flat red-text" href="#!">Confirmer</a>
                    </div>
                </div>
            @endforeach

            @include('includes.buttonImportExport')
        </div>
    </div>

    <!-- MODALS -->
    <div id="modal_export" class="modal">
        <div class="modal-content">
            <h4>Exportation des données</h4>
            <p>Les données concernant les utilisateur seront exportées au format CSV</p>
        </div>


        <div class="modal-footer">
            <a href="/di/annuaire.csv" onclick="makeToast('Exportation réussie')"
               class="modal-action modal-close waves-effect waves-light btn-flat blue-text">Exporter</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-light btn-flat red-text">Annuler</a>
        </div>
    </div>

    <div id="modal_import" class="modal">
        <div class="modal-content">
            <div class="row">
                <h4>Importation des données</h4>
                <p>Les données importées doivent être au format CSV. Un header doit être présent et le
                    séparateur doit
                    être ;</p>
                <p>Le format à respecter est le suivant : <br><strong>civilite ; prenom ; nom ; email
                        ; adresse ; statut</strong></p>
            </div>
            <div class="row">
                <form id="form-import" method="post" action="/di/annuaire/importCSV" enctype="multipart/form-data">
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
            <a onclick="event.preventDefault();document.getElementById('form-import').submit();" href="#!" class="btn-large modal-action modal-close waves-effect waves-light btn-flat
               purple-text">Importer</a>
            <a href="#!"
               class="modal-action modal-close waves-effect waves-light btn-flat btn-large red-text">Annuler</a>
        </div>
    </div>



    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/materialize.js"></script>
    <script src="/js/utils.js"></script>

    <script>

        function deleteUser(event, id_utilisateur) {
            event.preventDefault();
            $.ajax({
                url: "/di/annuaire/delete",
                method: "POST",
                data: "id_utilisateur=" + id_utilisateur
            })
                .done(function (msg) {
                    console.log(msg);
                    if (msg['message'] === 'success') {
                        makeToast('Utilisateur supprimé');
                        $('#li-user-' + id_utilisateur).remove();
                    } else {
                        $.each(msg['errors'], function (key, value) {
                            makeToast('Echec : ' + value);
                        })

                    }
                })
                .fail(function (xhr, msg) {
                    console.log(msg);
                    console.log(xhr);
                    makeToast('Erreur serveur : ' + xhr.status)
                });
        }


        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });


            // Toast pour action réussie

            @if (Session::get('messages') !== null && isset(Session::get('messages')['succes']))
                makeToast('{{Session::get('messages')["succes"]}}');
            @endif


            // Toast pour les erreurs

            @foreach($errors->all() as $error)
                @if (Session::get('messages') !== null)
                    makeToast('{{$error}} (ligne {{Session::get('messages')["ligne"]}})');
                @else
                    makeToast('{{$error}}');
                @endif
            @endforeach


            // Suppression des utilisateurs

            $('.btn-delete-utilisateur').click(function (event) {
                event.preventDefault();
                var btn = $(this);
                btn.blur();

                var id_utilisateur = btn.attr('id');
                console.log('id_utilisateur : ' + id_utilisateur);
                $.ajax({
                    url: "/di/annuaire/delete",
                    method: "POST",
                    data: "id_utilisateur=" + id_utilisateur
                })
                    .done(function (msg) {
                        console.log(msg);
                        if (msg['message'] === 'success') {
                            makeToast('Utilisateur supprimé');
                            btn.parent().parent().parent().remove();
                        } else {
                            $.each(msg['errors'], function (key, value) {
                                makeToast('Echec : ' + value);
                            })

                        }
                    })
                    .fail(function (xhr, msg) {
                        console.log(msg);
                        console.log(xhr);
                        alert('ERREUR voir console <3');
                    });
            })
        });
    </script>
@stop
