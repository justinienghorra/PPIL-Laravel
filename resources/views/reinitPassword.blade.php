@extends('layouts.inscription')
@section('title')
Inscription
@stop
@section('content')

<div class="card">
    <div class="card-content">
    <h3 class="header center orange-text">Réinitialiser le mot de passe</h3>
      <h5 class="light center">Un lien de réinitialisation va vous être envoyé</h5>
      

      <!-- FORMULAIRE DE CONNEXION -->
      <div class="row">
        <br>
      <br>
    <form class="col s12">
      
      <div class="row">
        <div class="input-field col s10 offset-s1">
          <input id="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
      </div>
      
      <div class="row center">
        <a href="#" id="button" class="btn-large waves-effect waves-light orange">Envoyer</a>
      </div>

      
    </form>
  </div>
</div>

</div>


@stop