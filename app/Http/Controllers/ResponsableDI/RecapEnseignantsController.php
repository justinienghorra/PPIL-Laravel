<?php

namespace App\Http\Controllers\ResponsableDI;

use Illuminate\Support\Facades\Auth;
use App\EnseignantDansUE;
use App\Statut;
use App\User;
use App\Photos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RecapEnseignantsController extends Controller
{
    /**
     * Retourne la vue présentant le recapitulatif des enseignants
     *
     * @return View
     */
    public function show() {
       
        $enseignantDansUE = EnseignantDansUE::all();
        $statut = Statut::all(); 
        $users = User::all();

        $tableauHeureTotale = array();
        

        $usersStatut = DB::table('statuts')
                        ->join('users', 'users.id_statut', '=', 'statuts.id')
                        ->get();

        $usersHeure = DB::table('users')
                        ->join('enseignant_dans_u_es', 'users.id', '=', 'enseignant_dans_u_es.id_utilisateur')                        
                        ->get();

        foreach ($users as $user) {
            # code...
            $idUser = $user->id;
            $UesParEnseignant = EnseignantDansUE::where('id_utilisateur', $idUser)->get();   
            $totale = 0;

            foreach($UesParEnseignant as $Ues) {

            $totale = $totale + $Ues->cm_nb_heures*1.5 + ($Ues->td_nb_groupes*$Ues->td_heures_par_groupe)
                          + ($Ues->tp_nb_groupes*$Ues->tp_heures_par_groupe)*1.5
                          + ($Ues->ei_nb_groupes*$Ues->ei_heures_par_groupe)*1.25;
            } 

            $tableauHeureTotale[$user->id] = $totale;

        }

        /** Récupération des droit de l'utilisateur authentifier pour gérer le menu */
        $userA = Auth::user();
        $respoDI = $userA->estResponsableDI();
        $respoUE = $userA->estResponsableUE();
        $photoUrl = Photos::where('id_utilisateur', $userA->id)->first();
        $tmp = null;

        if ($photoUrl != null) {
            $url = $photoUrl->adresse;
            $tmp = explode("images", $url);
        }

        return view('di/recapEnseignants')->with(['usersHeure' => $usersHeure, 'usersStatut' => $usersStatut, 'enseignantDansUE' => $enseignantDansUE, 'tableauHeureTotale' => $tableauHeureTotale])->with('userA', $userA)->with('photoUrl', $tmp[1])->with('respoDI', $respoDI)->with('respoUE', $respoUE);
    }  
}
