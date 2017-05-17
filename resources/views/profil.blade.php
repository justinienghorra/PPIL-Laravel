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
                    <h5 class="header col s12 light">{{$user->civilite}}. {{$user->nom}} {{$user->prenom}}, vous êtes <span class="green-text light">{{ProfilController::getStatut()}}</span>.</h5>
                    <h5 class="header col s12 light">Vous avez été affecté à <span class="blue-text">148 / 192</span> heures équivalent TD</h5>
                    <div class="progress col s6 offset-s3">
                        <div class="determinate" style="width: 70%"></div>
                    </div>
                </div>


                <div class="divider"></div>
                <br>
                <div class="row center">
                    <h5 class="header col s12 light">Modification de l'adresse email</h5>
                </div>

                <div class="row">

                    {!! Form::open(['url' => 'profil/updateInformations'], $attributes = ['class' => 'col s12']) !!}

                    <div class="row">

                        <div class="input-field col s3 offset-s1">

                            {!! Form::text('nom', $value = $user->nom, $attributes = ['class' => 'validate', 'id' => 'nom']) !!}
                            {!! Form::label('nom', 'Votre Nom') !!}

                        </div>


                        <div class="input-field col s3">

                            {!! Form::text('prenom', $value = $user->prenom, $attributes = ['class' => 'validate', 'id' => 'prenom']) !!}
                            {!! Form::label('prenom', 'Votre Prenom') !!}

                        </div>

                        <div class="input-field col s3">

                            {!! Form::select('statut', $statuts->pluck('statut'), $statuts->pluck('id'), ['class' => 'form-control']) !!}
                            {!! Form::label('statut', 'Votre Statut') !!}

                        </div>

                        <div class="input-field col s1">

                            {!! Form::select('civilite', $attributes = $civilites, ['class' => 'form-control']) !!}
                            {!! Form::label('civilite', 'Civilité') !!}

                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s10 offset-s1">
                            {!! Form::text('adresse', $value = $user->adresse, $attributes = ['class' => 'validate', 'id' => 'adresse']) !!}
                            {!! Form::label('adresse', 'Votre Adresse') !!}
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s10 offset-s1">
                        {!! Form::email('email', $value = $user->email, $attributes = ['class' => 'validate', 'id' => 'email']) !!}
                            {!! Form::label('email', 'Votre Email') !!}
                        </div>
                    </div>
                    

                    <div class="row center">

                        {!! Form::submit('Enregistrer les modifications', $attributes = ['class' => 'center btn btn-flat orange-text', 'href' => '#', 'id' => '']) !!}
                        {!! Form::close() !!}
                    </div>

                </div>

                     <div class="divider"></div>
                    <br> 






                    <div class="row center">
                        <h5 class="header col s12 light">Modifier votre photo</h5>
                    </div>
                    <div class="row center">
                        {!! Form::open(['url' => 'profil/image', 'files' => true], $attributes = ['class' => 'col s12']) !!}
                            <!--<img src="images/groot.png" alt="Votre photo" class="circle responsive-img">-->
                            @if (Session::get('photoUrl') == null && $photoUrl == null)
                                <img src="{!! url('images/groot.png') !!}" alt="Votre photo" class="circle responsive-img" height="256" width="256">
                            @elseif (Session::get('photoUrl') == null)
                                <img src="{!! url('images'. $photoUrl) !!}" alt="Votre photo" class="circle responsive-img" height="256" width="256">
                            @else
                                <img src="{!! url('images'. Session::get('photoUrl')) !!}" alt="Votre photo" class="circle responsive-img" height="256" width="256">
                            @endif
                    </div>
                    <div class="row">
                        <!--<a href="#" class="btn btn-flat blue-text">Importer</a>    ['url' => 'profil/image'], $attributes = ['class' => 'col s12']-->
                        {!! Form::file('image', $attributes = ['class' => 'btn btn-flat blue-text']) !!}
                        <!--<a href="#" class=" right btn btn-flat green-text">Valider</a>-->
                        {!! Form::submit('Valider', $attributes = ['class' => 'right btn btn-flat green-text']) !!}
                        {!! Form::close() !!}

                        {{ Session::get('image_message') }}
                    </div>

                    <div class="divider"></div>
                    <br>
                    <div class="row center">
                        <h5 class="header col s12 light">Modification du mot de passe</h5>
                    </div>

                    <div class="row">

                            {!! Form::open(['url' => 'profil/password'], $attributes = ['class' => 'col s12']) !!}

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

                            {{ Session::get('password_message') }}

                            </div>
                        </div>



            </div>
        </div>

          

          
    
  

  <!-- FIN DU FORMULAIRE DE MODIFICATION -->

  

  <!-- MODIFICATION DU MDP -->  
  
    
    </div>

    </div>

    </div>


        <script src="/js/jquery-2.1.1.min.js"></script>
        <script src="/js/materialize.js"></script>

        <script>

            function makeToast(str) {
                var toastContent = '<span>' + str + '</span>';
                Materialize.toast(toastContent, 4000, 'rounded');
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