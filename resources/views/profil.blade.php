@extends('layouts.main')
@section('title')
    Profil
@stop
@section('content')



    <div class="card">
        <div class="card-content">
            <h2 class="header center orange-text">Votre profil</h2>
            <br>
            <br>
            <div class="row center">

                <h5 class="header col s12 light">Récapitulatif</h5>
                <h5 class="header col s12 light">{{$userA->civilite}} {{$userA->nom}} {{$userA->prenom}}
                    @if(ProfilController::getStatut() != 'Aucun')
                        , vous êtes <span class="green-text light">{{ProfilController::getStatut()}}</span>.
                    @endif
                </h5>
                <h5 class="header col s12 light">Vous avez été affecté à <span class="blue-text">{{$heuresTotals}}
                        / {{ProfilController::getStatutVolumeMin()}}</span> heures équivalent TD</h5>
                <div class="progress col s6 offset-s3">
                    <div class="determinate" style="width: {{$pourcentage}}%"></div>
                </div>

            </div>


            <div class="divider"></div>
            <br>
            <div class="row center">
                <h5 class="header col s12 light">Modification de vos informations</h5>
            </div>

            <div class="row">

                {!! Form::open(['url' => 'profil/updateInformations', 'class' => 'col s12', 'id' => 'informations-form']) !!}

                <div class="row">

                    <div class="input-field col s3 offset-s1">

                        {!! Form::text('nom', $value = $userA->nom, $attributes = ['class' => 'validate', 'id' => 'nom']) !!}
                        {!! Form::label('nom', 'Votre Nom') !!}

                    </div>


                    <div class="input-field col s3">

                        {!! Form::text('prenom', $value = $userA->prenom, $attributes = ['class' => 'validate', 'id' => 'prenom']) !!}
                        {!! Form::label('prenom', 'Votre Prenom') !!}

                    </div>

                    <div class="input-field col s3">

                        {!! Form::select('statut', $statuts->pluck('statut'), $userA->id_statut-1, ['class' => 'form-control']) !!}
                        {!! Form::label('statut', 'Votre Statut') !!}

                    </div>

                    <div class="input-field col s1">

                        {!! Form::select('civilite', $attributes = $civilites, ['class' => 'form-control']) !!}
                        {!! Form::label('civilite', 'Civilité') !!}

                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s10 offset-s1">
                        {!! Form::text('adresse', $value = $userA->adresse, $attributes = ['class' => 'validate', 'id' => 'adresse']) !!}
                        {!! Form::label('adresse', 'Votre Adresse') !!}
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s10 offset-s1">
                        {!! Form::email('email', $value = $userA->email, $attributes = ['class' => 'validate', 'id' => 'email']) !!}
                        {!! Form::label('email', 'Votre Email') !!}
                    </div>
                </div>


                <div class="row center">

                    {!! Form::submit('Enregistrer les modifications', $attributes = ['class' => 'center btn btn-flat orange-text', 'href' => '#', 'id' => '', 'onclick' => 'return openModalInformations();']) !!}
                    {!! Form::close() !!}
                </div>

            </div>

            <div class="divider"></div>
            <br>


            <div class="row center">
                <h5 class="header col s12 light">Modifier votre photo</h5>
            </div>

            {!! Form::open(['url' => 'profil/image', 'files' => true], $attributes = ['class' => 'col s12', 'id' => '']) !!}
            <div class="row center">
                <!--<img src="images/groot.png" alt="Votre photo" class="circle responsive-img">-->
                @if (Session::get('photoUrl') == null && $photoUrl == null)
                    <img src="{!! url('images/default.jpg') !!}" alt="Votre photo" class="circle responsive-img"
                         height="256" width="256">
                @elseif (Session::get('photoUrl') == null)
                    <img src="{!! url('images'. $photoUrl) !!}" alt="Votre photo" class="circle responsive-img"
                         height="256" width="256">
                @else
                    <img src="{!! url('images'. Session::get('photoUrl')) !!}" alt="Votre photo"
                         class="circle responsive-img" height="256" width="256">
                @endif
            </div>
            <div class="row">


                <div class="row center">
                    <div class="file-field input-field col s8 offset-s2">
                        <div class="btn">
                            <span>Fichier</span>
                            {!! Form::file('image') !!}
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </div>

                <div class="center row ">
                    {!! Form::submit('Valider', $attributes = ['class' => 'center btn btn-flat green-text']) !!}
                </div>


                {{ Session::get('image_message') }}
            </div>
            {!! Form::close() !!}

            <div class="divider"></div>
            <br>
            <div class="row center">
                <h5 class="header col s12 light">Modification du mot de passe</h5>
            </div>

            <div class="row">

                {!! Form::open(['url' => 'profil/password'], $attributes = ['class' => 'col s12']) !!}

                <div class="row">
                    <div class="input-field col s10 offset-s1">

                        {!! Form::password('old_password', $attributes = ['class' => 'validate', 'id' => 'password']) !!}
                        {!! Form::label('old_password', 'Ancien mot de passe') !!}

                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s10 offset-s1">

                        {!! Form::password('password', $attributes = ['class' => 'validate', 'id' => 'password']) !!}
                        {!! Form::label('password', 'Nouveau mot de passe') !!}

                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s10 offset-s1">

                        {!! Form::password('check_password', $attributes = ['class' => 'validate', 'id' => 'password']) !!}
                        {!! Form::label('check_password', 'Confirmation du nouveau mot de passe') !!}

                    </div>
                </div>

                <div class="row center">

                    {!! Form::submit('Enregistrer les modifications', $attributes = ['class' => 'center btn btn-flat blue-text', 'href' => '#', 'id' => '']) !!}

                </div>

                {!! Form::close() !!}

            </div>
        </div>


    </div>




    <!-- FIN DU FORMULAIRE DE MODIFICATION -->



    <!-- Modal Pop pour validation de changements des informations personnelles -->

    <div id="modal-informations" class="modal">
        <div class="modal-content">
            <h4>Validation des modifications</h4>
            <p>Voulez-vous vraiment modifier ces informations ?</p>
        </div>

        <div class="modal-footer">
            <a onclick='document.getElementById("informations-form").submit();' href="#!" class="btn-large modal-action modal-close waves-effect waves-light btn-flat purple-text">
                Valider
            </a>
            <a href="#!" onclick="window.location.reload()" class="modal-action modal-close waves-effect waves-light btn-flat btn-large red-text">
                Annuler
            </a>
        </div>
    </div>



    <script src="/js/jquery-2.1.1.min.js"></script>
    <script src="/js/materialize.js"></script>
    <script>

        /*
         * Affichage d'un toast
         */
        function makeToast(str) {
            var toastContent = '<span>' + str + '</span>';
            Materialize.toast(toastContent, 4000);
        }


        /*
         * Ouverture d'une fenetre personnalisee
         * lors d'un changement d'informations
         */
        function openModalInformations() {
            $('#modal-informations').modal('open');
            return false;
        }


        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });

            @if (Session::get('messages') !== null)
                makeToast('{{Session::get('messages')}}');
            @endif

        });
    </script>

@stop