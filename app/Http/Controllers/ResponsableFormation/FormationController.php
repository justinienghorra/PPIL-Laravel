<?php

namespace App\Http\Controllers\ResponsableFormation;


use App\Formation;
use App\Http\Controllers\Controller;
use App\ResponsableUniteeEnseignement;
use App\UniteeEnseignement;
use App\User;
use Illuminate\Support\Facades\Auth;

class FormationController extends Controller
{
    public function __construct()
    {
        //route accessible que si l'utilisateur est authentifié
        $this->middleware('auth');
    }

    public function show($nom_formation){

        // Retourne l'utilisateur courant authentifie...
        $user = Auth::user();

        $formation = Formation::where('nom', '=', $nom_formation)->first();
        $ues = UniteeEnseignement::where('id_formation', $formation->id)->get();
        $respoUE = ResponsableUniteeEnseignement::all();
        $users = User::all();

        return view('respoFormation.formation')->with(['user' => $user, 'formation' => $formation, 'ues' => $ues, 'respoUE' => $respoUE, 'users' => $users]);
    }
}