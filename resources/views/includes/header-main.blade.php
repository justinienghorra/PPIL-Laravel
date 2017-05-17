<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>


<!-- Dropdown Structure -->
<ul id="dropdown_notifs" class="dropdown-content">
  <li><a class="black-text" href="#!"><strong>Inscription</strong> Chuck Norris <i class="material-icons tiny red-text">clear</i></a></li>
  <li><a class="black-text"  href="#!"><strong>Inscription</strong> Mickey <i class="material-icons tiny red-text">clear</i></a></li>
</ul>

<ul id="dropdown_enseignements" class="dropdown-content">
  @if($respoUE)
  <li><a class="black-text"  href="/mesUE">Vos UE</a></li>
  @endif
  <li><a class="black-text"  href="/mesEnseignements">Mes enseignements</a></li>
</ul>

<ul id="dropdown_formations" class="dropdown-content">
    <li><a class="black-text" href="/mesFormations/L1Informatique">L1 Informatique</a></li>
    <li><a class="black-text"  href="#!">L2 Informatique</a></li>
    <li><a class="black-text"  href="#!">L3 Informatique</a></li>
</ul>
<ul id="dropdown_administration" class="dropdown-content">
  <li><a href="/di/recapEnseignants">Récapitulatif des enseignants</a></li>
    <li><a href="/di/annuaire">Annuaire</a></li>
    <li><a href="/di/formations">Formations</a></li>
    <li><a href="/di/journal">Journal</a></li>
</ul>
<ul id="dropdown_user" class="dropdown-content">
    <li><a href="/profil">Profil</a></li>
    <li><a href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Déconnexion
                </a></li>
</ul>

  
  <nav class="light-blue lighten-1" role="navigation">
  <a id="logo-container" href="#" class="brand-logo">
	<img class="navbar-logo" src="/images/SGE.png" alt=""></a>
    <div class="nav-wrapper container">
	
      <ul class="right hide-on-med-and-down">
        <li><a class="dropdown-button" href="#!" data-activates="dropdown_notifs"><span class="badge badge-notifs orange white-text">2</span>Notifications<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a class="dropdown-button" href="#!" data-activates="dropdown_enseignements">Enseignement<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a class="dropdown-button" href="#!" data-activates="dropdown_formations">Vos formations<i class="material-icons right">arrow_drop_down</i></a></li>
      @if($respoDI)
        <li><a class="dropdown-button" href="#!" data-activates="dropdown_administration">Administration<i class="material-icons right">arrow_drop_down</i></a></li>
      @endif
	<li><a class="dropdown-button" href="#!" data-activates="dropdown_user">{{$userA->civilite}}. {{$userA->nom}}<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><img src="/images/groot.png" class="navbar-pic circle" alt=""></li>
      </ul>

      <ul id="slide-out" class="side-nav">
        <li><div class="userView">
          <div class="background">
            <img src="/images/office.jpg">
          </div>
          <a href="#!user"><img class="circle" height="128px" src="/images/groot.png"></a>
          <a href="#!name"><span class="white-text name">Groot</span></a>
          <a href="#!email"><span class="white-text email">groot@gmail.com</span></a>
          </div>
        </li>
        <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Notifications<i class="material-icons right">arrow_drop_down</i><span class="badge badge-notifs orange white-text" data-badge-caption="">2</span></a></li>
        <li><div class="divider"></div></li>
        <!--<li><a class="dropdown-button" href="#!" data-activates="dropdown_formations">Vos formations<i class="material-icons right">arrow_drop_down</i></a></li>-->
        <li><a href="mesUE">Vos UE</a></li>
        <li><a href="mesEnseignements">Enseignements</a></li>
        <li><div class="divider"></div></li>
        <li><a href="profil.html">Profil</a></li>
        <li><div class="divider"></div></li>
        <li><a href="">Déconnexion</a></li>
        <li>M. Groot</li>  
      </ul>
  <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
</div>
</nav>
