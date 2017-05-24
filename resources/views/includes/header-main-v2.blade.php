<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>


<!-- Dropdown Structure -->
<ul id="dropdown_notifs_mobile" class="dropdown-content">
    @foreach($userA->notifications as $notification)
        <li id="notification-mobile-{{$notification->id}}">
            <a  class="blue-text darken-1" href="#!">{{$notification->resume}}
                <i onclick="deleteNotificationMobile(event, {{$notification->id}})" class="material-icons tiny red-text">clear</i>
            </a>
        </li>
    @endforeach
</ul>

<ul id="dropdown_notifs" class="dropdown-content">
    @foreach($userA->notifications as $notification)
        <li id="notification-{{$notification->id}}">
            <a  class="blue-text darken-1" href="#!">
                {{$notification->resume}}
            </a>
            <button onclick="deleteNotification(event, {{$notification->id}})" class=" right btn btn-flat red-text">Supprimer</button>
        </li>
    @endforeach
</ul>

<ul id="dropdown_scolarite" class="dropdown-content">
    @if($respoForm)
        <li><a class="blue-text darken-1" href="/respoFormation/formations">Vos Formations</a></li>
    @endif
    @if($respoUE)
        <li><a class="blue-text darken-1" href="/respoUE/mesUE">Vos UE</a></li>
    @endif
    <li><a class="blue-text darken-1" href="/mesEnseignements">Mes enseignements</a></li>
</ul>

<ul id="dropdown_formations" class="dropdown-content">
    <li><a class="blue-text darken-1" href="/mesFormations/L1Informatique">L1 Informatique</a></li>
    <li><a class="blue-text darken-1" href="#!">L2 Informatique</a></li>
    <li><a class="blue-text darken-1" href="#!">L3 Informatique</a></li>
</ul>
<ul id="dropdown_administration" class="dropdown-content">
    <li><a class="blue-text darken-1" href="/di/annuaire">Annuaire</a></li>
    <li><a class="blue-text darken-1" href="/di/formations">Formations</a></li>
    <li><a class="blue-text darken-1" href="/di/journal">Journal</a></li>
    <li><a class="blue-text darken-1" href="/di/recapEnseignants">Recapitulatif des enseignants</a></li>
</ul>
<ul id="dropdown_user" class="dropdown-content">
    <li><a class="blue-text darken-1" href="/profil">Profil</a></li>
    <li><a class="blue-text darken-1" href="#!"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            Déconnexion
        </a></li>
</ul>


<nav class="light-blue lighten-1" role="navigation">

    <div class="nav-wrapper container">
	<a id="logo-container" href="/profil" class="brand-logo">
        <img class="navbar-logo" src="/images/SGE.png" alt=""></a>
        <ul class="right hide-on-med-and-down">

            <li>
                <a class="dropdown-button" href="#!" onclick="event.preventDefault()" data-activates="dropdown_notifs">
                    <span class="badge badge-notifs orange white-text"><span id="notif-count">{{$userA->notifications->count()}}</span></span>
                    Notifications
                    <i class="material-icons right">arrow_drop_down</i>
                </a>
            </li>

            <li><a class="dropdown-button" href="#!" data-activates="dropdown_scolarite">Scolarité<i
                            class="material-icons right">arrow_drop_down</i></a></li>
            <!--<li><a class="dropdown-button" href="#!" data-activates="dropdown_formations">Vos formations<i class="material-icons right">arrow_drop_down</i></a></li>-->
            @if($respoDI)
                <li><a class="dropdown-button" href="#!" data-activates="dropdown_administration">Administration<i
                                class="material-icons right">arrow_drop_down</i></a></li>
            @endif
            <li><a class="dropdown-button" href="#!" data-activates="dropdown_user">{{$userA->civilite}}
                    {{$userA->nom}}<i class="material-icons right">arrow_drop_down</i></a></li>
            @if(isset($userA->photo))
	    <li>
            <a id="imageProfil" href="/profil">
                <img src="/images{{$photoUrl}}" class="navbar-pic circle" alt="">
            </a>
        </li>
            @else
	      <li><a id="imageProfil" href="/profil"><img src="/images/default.jpg" class="navbar-pic circle" alt=""></a></li>
            @endif

        </ul>


         <ul id="slide-out" class="side-nav">
            <li>
                <div class="userView">
                    <div class="background">
                        <img src="/images/office.jpg">
                    </div>

                    @if(isset($userA->photo))
                    <a href="#!user"><img class="circle" height="128px" src="/images{{$photoUrl}}" ></a>
                    @else
                    <a href="#!user"><img class="circle" height="128px" src="/images/default.jpg" ></a>
                    @endif
                    <a href="#!name"><span class="white-text name">{{$userA->civilite}} {{$userA->nom}}</span></a>
                    <a href="#!email"><span class="white-text email">{{$userA->email}}</span></a>
                </div>
            </li>
             <li>
                 <a class="dropdown-button" href="#!" onclick="event.preventDefault()" data-activates="dropdown_notifs_mobile">
                     <span class="badge badge-notifs orange white-text"><span id="notif-count-mobile">{{$userA->notifications->count()}}</span></span>
                     Notifications
                     <i class="material-icons right">arrow_drop_down</i>
                 </a>
             </li>
                <div class="divider"></div>
            </li>

            <li><a href="#" >Scolarité</a></li>
            @if($respoForm)
                <li><a href="/respoFormation/formations"><i class="material-icons">keyboard_arrow_right</i>Vos Formations</a></li>
            @endif
            @if($respoUE)
                <li><a href="/respoUE/mesUE"><i class="material-icons">keyboard_arrow_right</i>Vos UE</a></li>
            @endif
            <li><a href="/mesEnseignements"><i class="material-icons">keyboard_arrow_right</i>Mes Enseignements</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <!--<li><a class="dropdown-button" href="#!" data-activates="dropdown_formations">Vos formations<i class="material-icons right">arrow_drop_down</i></a></li>-->
            <!--<li><div class="divider"></div></li> -->
            @if($respoDI)
                <li><a href="#">Administration</a></li>
                <li><a href="/di/annuaire"><i class="material-icons">keyboard_arrow_right</i>Annuaire</a></li>
                <li><a href="/di/formations"><i class="material-icons">keyboard_arrow_right</i>Formations</a></li>
                <li><a href="/di/journal"><i class="material-icons">keyboard_arrow_right</i>Journal</a></li>
                <li><a href="/di/recapEnseignants"><i class="material-icons">keyboard_arrow_right</i>Enseignants</a></li>
                <li>
                    <div class="divider"></div>
                </li>
            @endif
            <li><a href="/profil">Profil</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a href="#!" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Déconnexion</a>
            </li>
            <li>M. Groot</li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
