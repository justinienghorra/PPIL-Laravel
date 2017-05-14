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
                <h5 class="header col s12 light">M. Groot JeZapel, vous êtes <span class="green-text light">Enseignant chercheur</span>.</h5>
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
                    <form class="col s12">
                    

                    <div class="row">

                        
                        
                        <div class="input-field col s3 offset-s1">
                        <input id="email" type="email" class="validate" value="Jezapel">
                        <label for="email">Nom</label>
                        </div>

                    
                        <div class="input-field col s3">
                        <input id="email" type="email" class="validate" value="Groot">
                        <label for="email">Prénom</label>
                        </div>

                        <div class="input-field col s3">
                        <select>
                            <option value="1">Enseignant chercheur</option>
                            <option value="2">Vacataire</option>
                            <option value="3">Doctorant</option>
                            <option value="4">ATER</option>
                            <option value="5">PRAG</option>
                        </select>
                        <label>Votre status</label>
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
                        <input id="email" type="email" class="validate" value="23 rue de la Liberté, 54000 Nancy">
                        <label for="email">Votre adresse</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s10 offset-s1">
                        <!--<input id="email" type="email" class="validate" value={!! $user->email !!}>
                        <label for="email">Votre Email</label>-->

                        {!! Form::open(['url' => 'profil/email']) !!}
                            {!! Form::email('email', $value = $user->email, $attributes = ['class' => 'validate', 'id' => 'email']) !!}
                            {!! Form::label('email', 'Votre Email') !!}


                        </div>
                    </div>
                    

                    <div class="row center">

                    <!--<button type="submit" class="center btn btn-flat orange-text" href="#" id="" >Enregistrer les modifications</a>-->
                            {!! Form::submit('Enregistrer les modifications', $attributes = ['class' => 'center btn btn-flat orange-text', 'href' => '#', 'id' => '']) !!}
                        {!! Form::close() !!}
                    </div>
                    
                    </form>
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
                        <!--<form class="col s12">
                       

                        <div class="row">

                            <div class="input-field col s10 offset-s1">
                            <input id="password" type="password" class="validate">
                            <label for="password">Nouveau mot de passe</label>
                            </div>

                        </div>
                        
                        <div class="row">
                            <div class="input-field col s10 offset-s1">
                            <input id="password" type="password" class="validate">
                            <label for="password">Confirmation du nouveau mot de passe</label>
                            </div>
                        </div>
                        

                        

                        <div class="row center">
                            <a href="#" class="btn btn-flat blue-text" id="download-button" >Enregistrer les modifications</a>
                        </div>
                        
                        </form>-->



                        <div class="col s12">

                            {!! Form::open(['url' => 'profil/mdp']) !!}

                            <div class="row">
                                <div class="input-field col s10 offset-s1">

                                {!! Form::password('password', $attributes = ['class' => 'validate', 'id' => 'password']) !!}
                                {!! Form::label('password', 'Nouveau mot de passe') !!}

                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s10 offset-s1">

                                    {!! Form::password('password', $attributes = ['class' => 'validate', 'id' => 'password']) !!}
                                    {!! Form::label('password', 'Confirmation du nouveau mot de passe') !!}

                                </div>
                            </div>

                            <div class="row center">
                                {!! Form::submit('Enregistrer les modifications', $attributes = ['class' => 'center btn btn-flat blue-text', 'href' => '#', 'id' => '']) !!}
                            </div>

                            {!! Form::close() !!}

                            </div>
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