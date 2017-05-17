@extends('layouts.admin')
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

                <table border="1" class="bordered">
                    <thead>
                    <th>Enseignant</th>
                    <th>Statut</th>
                    <th>Adresse mail</th>
                    </thead>

                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->prenom . " " . $user->nom }}</td>
                            <td>{{ $user->statut() }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button id="{{$user->id}}"
                                        class="btn btn-flat red-text waves-light btn-delete-utilisateur">Supprimer
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </table>

            @endif


            @include('includes.buttonImportExport')
        </div>
    </div>

    <!-- MODALS -->
    <div id="modal_export" class="modal">
        <div class="modal-content">
            <h4>Exportation des données</h4>
            <p >Les données concernant les utilisateur seront exportées au format CSV</p>
        </div>


        <div class="modal-footer">
            <a href="/di/annuaire.csv" onclick="makeToast('Exportation réussie')" class="modal-action modal-close waves-effect waves-green btn-flat blue-text">Exporter</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red-text">Annuler</a>
        </div>
    </div>

    <div id="modal_import" class="modal">
        <div class="modal-content">
            <div class="row">
                <h4>Importation des données</h4>
                <p >Les données importées doivent être au format CSV. Un header doit être présent et le
                    séparateur doit
                    être ;</p>
                <p >Le format à respecter est le suivant : <br><strong>civilite ; prenom ; nom ; email
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
            <a onclick="submitImport(event) " href="#!" class="btn-large modal-action modal-close waves-effect waves-green btn-flat
               purple-text">Importer</a>
            <a href="#!"
               class="modal-action modal-close waves-effect waves-green btn-flat btn-large red-text">Annuler</a>
        </div>
    </div>



    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/materialize.js"></script>

    <script>
        function submitImport(event) {
            event.preventDefault();
            $('#form-import').submit();
        }
    </script>

    <script>

        function makeToast(str) {
            var toastContent = '<span>' + str + '</span>';
            Materialize.toast(toastContent, 5000);
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
                            makeToast('Utilisateur supprimé')
                        } else {
                            makeToast('Echec : ' + msg['errors']);
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
