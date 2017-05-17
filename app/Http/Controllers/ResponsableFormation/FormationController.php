<?php

namespace App\Http\Controllers\ResponsableFormation;


use App\Formation;
use App\Http\Controllers\Controller;
use App\User;
use App\Photos;
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
        $photoUrl =  Photos::where('id_utilisateur', $userA->id)->first();
        $tmp = null;

        if ($photoUrl != null){
            $url = $photoUrl->adresse;
            $tmp = explode("images", $url);
        }


        $formation = Formation::where('nom', '=', $nom_formation)->first();

        return view('respoFormation.formation')->with('userA', $userA)->with('photoUrl', $tmp[1])->with('formation', $formation)->with('respoDI', $respoDI)->with('respoUE', $respoUE);
    }
}