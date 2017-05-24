<?php

namespace App\Http\Controllers\ResponsableDI;

use Illuminate\Support\Facades\Auth;
use App\EnseignantDansUE;
use App\EnseignantDansUEExterne;
use App\Statut;
use App\User;
use App\Photos;
use Illuminate\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RecapEnseignantsController extends Controller
{
    /**
     * Retourne la vue présentant le recapitulatif des enseignants
     *
     * @return View\View
     */
    public function show() {
       
        $enseignantDansUE = EnseignantDansUE::all();
        $statut = Statut::all(); 
        $users = User::allValidate();

        $tableauHeureTotale = [];
        

        $usersStatut = DB::table('statuts')
                        ->join('users', 'users.id_statut', '=', 'statuts.id')
                        ->where('attente_validation', false)
                        ->get();

        $tableauHeureTotaleFST = [];

        foreach ($users as $user) {
            # code...
            $idUser = $user->id;
            $UesParEnseignant = EnseignantDansUE::where('id_utilisateur', $idUser)->get();   
            $totaleFST = 0;
            $UesExterneParEnseignant = EnseignantDansUEExterne::where('id_utilisateur', $idUser)->get();

            foreach($UesParEnseignant as $Ues) {

            $totaleFST = $totaleFST + $Ues->cm_nb_heures*1.5 + ($Ues->td_nb_groupes*$Ues->td_heures_par_groupe)
                          + ($Ues->tp_nb_groupes*$Ues->tp_heures_par_groupe)*1.5
                          + ($Ues->ei_nb_groupes*$Ues->ei_heures_par_groupe)*1.25;
            } 

            $totale = $totaleFST;

            foreach ($UesExterneParEnseignant as $UesExterne) {
                # code...
                   $totale = $totale + $UesExterne->cm_nb_heures*1.5 + ($UesExterne->td_nb_groupes*$UesExterne->td_heures_par_groupe)
                          + ($UesExterne->tp_nb_groupes*$UesExterne->tp_heures_par_groupe)*1.5
                          + ($UesExterne->ei_nb_groupes*$UesExterne->ei_heures_par_groupe)*1.25;
            }
           
            $tableauHeureTotaleFST[$user->id] = $totaleFST;
            $tableauHeureTotale[$user->id] = $totale;
        }




        /** Récupération des droit de l'utilisateur authentifier pour gérer le menu */
        $userA = Auth::user();
        $respoDI = $userA->estResponsableDI();
        $respoUE = $userA->estResponsableUE();
        $respoForm = $userA->estResponsableForm();
        $photoUrl = Photos::where('id_utilisateur', $userA->id)->first();
        $tmp = null;

        if ($photoUrl != null) {
            $url = $photoUrl->adresse;
            $tmp = explode("images", $url);
        }

        return view('di/recapEnseignants')->with(['usersStatut' => $usersStatut, 'tableauHeureTotale' => $tableauHeureTotale, 'tableauHeureTotaleFST' => $tableauHeureTotaleFST])->with('userA', $userA)->with('photoUrl', $tmp[1])->with('respoDI', $respoDI)->with('respoForm', $respoForm)->with('respoUE', $respoUE);
    }  
}
