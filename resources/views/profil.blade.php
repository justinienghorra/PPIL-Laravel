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

                    {!! Form::open(['url' => 'profil/email'], $attributes = ['class' => 'col s12']) !!}
                    

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
                            {!!Form::select('statut', $statuts->pluck('statut'), $statuts->pluck('id'), ['class' => 'form-control'])!!}
                            {!! Form::label('statut', 'Votre Statut') !!}
                        </div>

                        <div class="input-field col s1">
                        <select>
                            <option value="1">M.</option>
                            <option value="2">Mme</option>
                        </select>
                        <label>Civilité</label>
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
                        <div class="col s12">
                            <img src="images/groot.png" alt="Votre photo" class="circle responsive-img">
                        </div>
                    </div>
                    <div class="row">
                        <a href="#" class="btn btn-flat blue-text">Importer</a>
                        <a href="#" class=" right btn btn-flat green-text">Valider</a>
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

@stop