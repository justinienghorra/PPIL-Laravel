<?php

namespace App\Http\Controllers\Enseignant;

use App\EnseignantDansUE;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnseignantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show(){

        $user = \Auth::user();

        //recuperation des enseignements de l'utilisateur
        $enseignements = $user->getEnseignements();




        foreach ($enseignements as $enseignement){
            //on recupere les enseignants
            $enseignants = EnseignantDansUE::getEnseignantsDansUE($enseignement->id_unit_ens);
            //array_push($enseignantsArray, $enseignants);
            //$enseignantsArray = array_add($enseignement->id_ue, $enseignement);
            $enseignantsArray[$enseignement->id_unit_ens] = $enseignants;

        }

        return view('mesEnseignements')->with('user', $user)
                                            ->with('enseignements', $enseignements)
                                            ->with('enseignantsArray', $enseignantsArray);
    }
}
