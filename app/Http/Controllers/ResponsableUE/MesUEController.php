<?php

namespace App\Http\Controllers\ResponsableUE;


use App\UniteeEnseignement;
use App\ResponsableUniteeEnseignement;
use App\EnseignantDansUE;
use App\Http\Controllers\Controller;
use App\User;
use App\Photos;
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
        $userA = Auth::user();
        $respoDI = $userA->estResponsableDI();
        $respoUE = $userA->estResponsableUE();
        $tmp = null;
	    $photoUrl =  Photos::where('id_utilisateur', $userA->id)->first();
        if ($photoUrl != null){
            $url = $photoUrl->adresse;
            $tmp = explode("images", $url);
        }

        $uesTemp = ResponsableUniteeEnseignement::where('id_utilisateur', $userA->id)->get();

        $ues = null;
        $enseignantsParUE = null;
        $nomPrenomEnseignant = null;

        //pour chaque UE dont l'utilisateur est responsable
        foreach ($uesTemp as $ueTemp) {
            $id_ue = $ueTemp['id_ue'];

            //On récupère toutes les infos de l'UE
            $ues[$id_ue] = UniteeEnseignement::where('id', '=', $id_ue)->first();

            //On récupère aussi tous les enseignants en lien avec l'UE (avec leur nom et leur prénom)
            $enseignantsParUE[$id_ue] = EnseignantDansUE::where('id_ue', '=', $id_ue)->join('users', 'users.id', '=', 'enseignant_dans_u_es.id_utilisateur')->get(); //tableau 3D (id UE -> id enseignant -> données de l'enseignant en lien avec l'UE)

        }

        return view('respoUE/affichageUEs')->with('userA', $userA)->with('photoUrl', $tmp[1])->with('ues', $ues)->with('enseignants', $enseignantsParUE)->with('nomPrenomEnseignant', $nomPrenomEnseignant)->with('respoDI', $respoDI)->with('respoUE', $respoUE);
     }
    
}
