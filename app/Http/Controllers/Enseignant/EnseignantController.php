<?php

namespace App\Http\Controllers\Enseignant;

use App\EnseignantDansUE;
use App\Photos;
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

        $userA = \Auth::user();
        $respoDI = $userA->estResponsableDI();
        $respoUE = $userA->estResponsableUE();
        $tmp = null;

        //recuperation des enseignements de l'utilisateur
        $enseignements = $userA->getEnseignements();

        $photoUrl =  Photos::where('id_utilisateur', $userA->id)->first();


        if ($photoUrl != null){
            $url = $photoUrl->adresse;
            $tmp = explode("images", $url);
        }

        $enseignantsArray[] = null;

        foreach ($enseignements as $enseignement){
            //on recupere les enseignants
            $enseignants = EnseignantDansUE::getEnseignantsDansUE($enseignement->id_unit_ens);
            //array_push($enseignantsArray, $enseignants);
            //$enseignantsArray = array_add($enseignement->id_ue, $enseignement);
            $enseignantsArray[$enseignement->id_unit_ens] = $enseignants;

        }

        return view('mesEnseignements')->with('userA', $userA)
                                            ->with('enseignements', $enseignements)
                                            ->with('enseignantsArray', $enseignantsArray)
                                            ->with('photoUrl', $tmp[1])
                                            ->with('respoDI', $respoDI)
                                            ->with('respoUE', $respoUE);
    }
}
