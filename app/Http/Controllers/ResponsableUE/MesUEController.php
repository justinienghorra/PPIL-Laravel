<?php

namespace App\Http\Controllers\ResponsableUE;


use App\UniteeEnseignement;
use App\ResponsableUniteeEnseignement;
use App\EnseignantDansUE;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
	
class MesUEController extends Controller
{
	public function __construct()
    {
        //route accessible que si l'utilisateur est authentifié
        $this->middleware('auth');
    }
	
	
    /**
     * Retourne la vue présentant la liste des UEs dont l'utilisateur est responsable
     *
     * @return View
     */
     public function show() {
        $user = Auth::user();
        $uesTemp = ResponsableUniteeEnseignement::where('id_utilisateur', $user->id)->get();

        $ues = null;
        $enseignantsParUE = null;
        $nomPrenomEnseignant = null;

        //pour chaque UE dont l'utilisateur est responsable
        foreach ($uesTemp as $ueTemp) {
            $id_ue = $ueTemp['id_ue'];

            //On récupère toutes les infos de l'UE
            $ues[$id_ue] = UniteeEnseignement::where('id', '=', $id_ue)->first();

            //On récupère aussi tous les enseignants en lien avec l'UE
            $enseignantsParUE[$id_ue] = EnseignantDansUE::where('id_ue', '=', $id_ue)->get(); //tableau 3D (id UE -> id enseignant -> données de l'enseignant en lien avec l'UE)

            foreach($enseignantsParUE[$id_ue] as $enseignant) {
                $id_enseignant = $enseignant->id_utilisateur;

                //On récupère le nom et le prénom de l'enseignant
                $nomPrenomEnseignant['id_enseignant'] = User::where('id', '=', $id_ue)->select('nom', 'prenom')->first();
            }

            }

        return view('respoUE/affichageUEs')->with('user', $user)->with('ues', $ues)->with('enseignants', $enseignantsParUE)->with('nomPrenomEnseignant', $nomPrenomEnseignant);
     }
    
}
