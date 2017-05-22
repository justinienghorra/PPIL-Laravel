@extends('layouts.main')
@section('title')
    Mes Formations
@stop
@section('content')


    @foreach($formations as $formation)
        <div class="row">
            <div class="col s12 m10">
                <div class="card white">
                    <div class="card-content black-text">
                        <span class="card-title blue-text">{!! $formation->formation->nom !!}</span>
                        <p>{!! $formation->formation->description !!}</p>
                    </div>
                    <div class="card-action">
                        <a href="/respoFormation/formation/{!! $formation->formation->nom !!}">Voir</a>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
@stop