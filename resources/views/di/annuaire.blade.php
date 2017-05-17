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

                <table border="1" class="responsive-table bordered">
                    <thead>
                    <th>Enseignant</th>
                    <th>Statut</th>
                    <th>Adresse mail</th>
                    <th>Supprimer l'utilisateur</th>
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
            <p class="flow-text">Les données concernant les utilisateur seront exportées au format CSV</p>
        </div>


        <div class="modal-footer">
            <a href="/di/annuaire.csv" class="modal-action modal-close waves-effect waves-green btn-flat blue-text">Exporter</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red-text">Annuler</a>
        </div>
    </div>

    <div id="modal_import" class="modal">
        <div class="modal-content">
            <div class="row">
                <h4>Importation des données</h4>
                <p class="flow-text">Les données importées doivent être au format CSV. Un header doit être présent et le
                    séparateur doit
                    être ;</p>
                <p class="flow-text">Le format à respecter est le suivant : <br><strong>civilite ; prenom ; nom ; email
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
            <a onclick="submitImport() " href="#!" class="btn-large modal-action modal-close waves-effect waves-green btn-flat
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

        // Génération des toast d'erreur
        $(document).ready(function () {
            @if (Session::get('messages') !== null && Session::get('messages')['succes'] !== null)
                var toastContent = '<span>{{Session::get('messages')["succes"]}}</span>';
                Materialize.toast(toastContent, 5000);
            @endif
            @foreach($errors->all() as $error)
                var toastContent = '';
                @if (Session::get('messages') !== null)
                    toastContent = '<span>{{$error}} (ligne {{Session::get('messages')["ligne"]}})</span>';
                @else
                    toastContent = '<span>{{$error}}</span>';
                @endif

                Materialize.toast(toastContent, 5000);
            @endforeach
        });
    </script>
@stop
