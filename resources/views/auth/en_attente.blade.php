@extends('layouts.app')

@section('title')
    Inscription en attente
@stop
@section('content')
    <div class="card">
        <div class="card-content">
            <h4 class="orange-text center">Votre inscription est en attente</h4>
            <p class="center">Vous allez être redirigé vers la page de connexion</p>
        </div>
    </div>

    <script src="/js/jquery-2.1.1.min.js"></script>

    <script>
        $(document).ready(function () {
            setTimeout(function () {
                window.location.href = "/login";
            }, 5000);
        });
    </script>
@stop