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

        //$enseignements = $userA->getEnseignements();
        $enseignantDansUEs = $userA->enseignantDansUEs;



        $photoUrl =  Photos::where('id_utilisateur', $userA->id)->first();


        if ($photoUrl != null){
            $url = $photoUrl->adresse;
            $tmp = explode("images", $url);
        }

        /*$enseignantsArray[] = null;
        $volumeAffecteArray[] = null;

        foreach ($enseignements as $enseignement){
            //on recupere les enseignants
            $enseignants = EnseignantDansUE::getEnseignantsDansUE($enseignement->id_unit_ens);

            //recupere les volumes affectes des TP, TD... de chaque UE
            //$volumeAffecte = EnseignantDansUE::getVolumeAffectee($enseignement->id_unit_ens);

            array_push($enseignantsArray, $enseignants);

            //array_push($volumeAffecteArray, $volumeAffecte);

        }*/

        //->with('volumeAffecteArray', $volumeAffecteArray)
        //->with('enseignantsArray', $enseignantsArray)
        //->with('enseignements', $enseignements)

        return view('mesEnseignements')->with('userA', $userA)
                                            ->with('enseignantDansUEs', $enseignantDansUEs)
                                            ->with('photoUrl', $tmp[1])
                                            ->with('respoDI', $respoDI)
                                            ->with('respoUE', $respoUE);

    }
}
