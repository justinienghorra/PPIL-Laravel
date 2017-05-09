@extends('layouts.connexion')
@section('title')
Connexion
@stop
@section('content')
<div class="card">
    <div class="card-content">

    <h2 class="header center orange-text">Connexion</h2>
      

      <!-- FORMULAIRE DE CONNEXION -->
      <div class="row">
        <form class="col s12">
      
      <div class="row">
        <div class="input-field col s10 offset-s1">
          <input id="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s10 offset-s1">
          <input id="password" type="password" class="validate">
          <label for="password">Mot de passe</label>
        </div>
      </div>

      <div class="row center">
        <a href="listeUE.html" id="button" class="btn-large waves-effect waves-light orange">Se connecter</a>
      </div>

      <div class="row center">
        <a href="resetPassword.html" id="download-button" class="btn-flat orange-text">Mot de passe oublié</a>
      </div>
      
    </form>
  </div>

  </div>
  </div>
@stop