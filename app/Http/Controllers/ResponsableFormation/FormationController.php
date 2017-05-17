<?php

namespace App\Http\Controllers\ResponsableFormation;


use App\Formation;
use App\Http\Controllers\Controller;
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

        /*$validator = Validator::make($req->all(), [
            'nom_formation' => 'required|string|max:255',
        ]);

        $nom_formation = $req->nom;*/

        /** Récupération des droit de l'utilisateur authentifier pour gérer le menu */
        $userA = Auth::user();
	$respoDI = $userA->estResponsableDI();
        $respoUE = $userA->estResponsableUE();


        $formation = Formation::where('nom', '=', $nom_formation)->first();

        return view('respoFormation.formation')->with('userA', $userA)->with('formation', $formation)->with('respoDI', $respoDI)->with('respoUE', $respoUE);
    }
}