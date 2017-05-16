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

            @if($users->count() > 0)

                <table border="1" class="bordered">
                    <thead>
                    <th>Enseignant</th>
                    <th>Statut</th>
                    <th>email</th>
                    </thead>

                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->prenom . " " . $user->nom }}</td>
                            <td>{{ $user->statut() }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach

                </table>

            @endif

            <br>
            <br>
            <br>
            <h4>Exportation</h4>
            <a href="/di/annuaire.csv">Export to csv</a>

            <hr>
            <h4>Importation</h4>
            <form method="post" action="/di/annuaire/importCSV" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="file_csv"/>
                <button type="submit">Envoyer</button>
            </form>

            @if(isset ($data))
                {{  $data }}
            @endif
            <h4>Format requis</h4>
            civilite;prenom;nom;email;adresse;statut

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
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat btn-large red-text">Annuler</a>
        </div>
    </div>

    <script>
        function submitImport(event) {
            event.preventDefault();
            $('#form-import').submit();
        }
    </script>
@stop
