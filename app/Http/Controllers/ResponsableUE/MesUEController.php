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

        //pour chaque UE dont l'utilisateur est responsable
        foreach ($uesTemp as $ueTemp) {
            $id = $ueTemp['id_ue'];

            //On récupère toutes les infos de l'UE
            $ues[$id] = UniteeEnseignement::where('id', '=', $id)->first();

            //On récupère aussi tous les enseignants en lien avec l'UE
            $enseignantsParUE[$id] = EnseignantDansUE::where('id_ue', '=', $id)->get(); //tableau 2D (id UE -> données Enseignants)
        }

        return view('respoUE/affichageUEs')->with('user', $user)->with('ues', $ues)->with('enseignants', $enseignantsParUE);
     }
    
}
