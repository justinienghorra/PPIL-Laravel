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
        $enseignantDansUEs = $userA->enseignantDansUEs;



        $photoUrl =  Photos::where('id_utilisateur', $userA->id)->first();


        if ($photoUrl != null){
            $url = $photoUrl->adresse;
            $tmp = explode("images", $url);
        }



        return view('mesEnseignements')->with('userA', $userA)
                                            ->with('enseignantDansUEs', $enseignantDansUEs)
                                            ->with('photoUrl', $tmp[1])
                                            ->with('respoDI', $respoDI)
                                            ->with('respoUE', $respoUE);

    }


    public function updateUE(Request $request){
        $cm_volume_affecte = $request->input('cm_volume_affecte');
        $td_nb_groupes = $request->input('td_nb_groupes');
        $td_heures_par_groupe = $request->input('td_heures_par_groupe');
        $tp_nb_groupes = $request->input('tp_nb_groupes');
        $tp_heures_par_groupe = $request->input('tp_heures_par_groupe');
        $ei_nb_groupes = $request->input('ei_nb_groupes');
        $ei_heures_par_groupe = $request->input('ei_heures_par_groupe');




        return redirect('mesEnseignements');
    }
}
