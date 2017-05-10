@extends('layouts.inscription')
@section('title')
Inscription
@stop
@section('content')
<div class="card">
    <div class="card-content">

         <h2 class="header center orange-text">Inscription</h2>
      <div class="row center">
        <h5 class="header col s12 light">Ce formulaire sera communiqué au responsable du département informatique</h5>
      </div>
      

      <!-- FORMULAIRE D'INSCRIPTION -->
      <div class="row">
    <form class="col s12">

      <div class="row">

        <div class="input-field col s3 offset-s1">
          <input id="email" type="email" class="validate" >
          <label for="email">Nom</label>
        </div>

      
        <div class="input-field col s3">
          <input id="email" type="email" class="validate" >
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
          <label>Votre statut</label>
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
          <input id="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s10 offset-s1">
          <input id="email" type="email" class="validate">
          <label for="email">Votre adresse</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s10 offset-s1">
          <input id="password" type="password" class="validate">
          <label for="password">Mot de passe</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s10 offset-s1">
          <input id="password" type="password" class="validate">
          <label for="password">Confirmation du mot de passe</label>
        </div>
      </div>

      <div class="row center">
        <a href="#" id="download-button" class="btn-large waves-effect waves-light orange">Envoyer le formulaire</a>
      </div>
      
    </form>
  </div>

    </div>

</div>
@stop