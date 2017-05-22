<?php

namespace App\Http\Controllers\ResponsableUE;


use App\UniteeEnseignement;
use App\ResponsableUniteeEnseignement;
use App\EnseignantDansUE;
use App\Http\Controllers\Controller;
use App\User;
use App\Photos;
use Validator;
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
	
	public function verifRespoUE($id_ue)
    {
        $userA = Auth::user();
        $isRespoUE = ResponsableUniteeEnseignement::where(['id_utilisateur' => $userA->id, 'id_ue' => $id_ue ])->first();
        return !empty($isRespoUE);
    }


    /**
     * Retourne la vue présentant la liste des UEs dont l'utilisateur est responsable
     *
     * @return View
     */
    public function show() 
    {
        $users = User::allValidate();
        $userA = Auth::user();
        $respoDI = $userA->estResponsableDI();
        $respoUE = $userA->estResponsableUE();
        $respoForm = $userA->estResponsableForm();
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
            $ues[$id_ue] = UniteeEnseignement::where('id', $id_ue)->first();

            //On récupère aussi tous les enseignants en lien avec l'UE (avec leur nom et leur prénom)
            $enseignantsParUE[$id_ue] = EnseignantDansUE::where('id_ue', $id_ue)->join('users', 'users.id', '=', 'enseignant_dans_u_es.id_utilisateur')->get(); //tableau 3D (id UE -> id enseignant -> données de l'enseignant en lien avec l'UE)

        }

        return view('respoUE/affichageUEs')->with('userA', $userA)->with('photoUrl', $tmp[1])->with('ues', $ues)->with('enseignants', $enseignantsParUE)->with('nomPrenomEnseignant', $nomPrenomEnseignant)->with('users', $users)->with('respoDI', $respoDI)->with('respoForm', $respoForm)->with('respoUE', $respoUE);
    }

    /**
     * Ajoute un enseignant à une UE s'il n'y enseigne pas déjà 
     *
     * @param $request la requête du formulaire d'ajout d'un enseignant 
     */
    public function addEnseignant(Request $request)
    {
        $id_ue = $request->input('id_ue');
        $id_enseignant = $request->input('id_enseignant');
        if($this->verifRespoUE($id_ue)) {
            $verifExistenceEnseignant = EnseignantDansUE::where(['id_ue' => $id_ue, 'id_utilisateur' => $id_enseignant])->first();
            if(empty($verifExistenceEnseignant)) {
                $enseignantDsUE = new EnseignantDansUE();
                $enseignantDsUE->id_utilisateur = $id_enseignant;
                $enseignantDsUE->id_ue = $request->input('id_ue');
                $enseignantDsUE->save();
            }
        }
        return redirect('/respoUE/mesUE');
    }

    /**
     * Supprime un enseignant d'une UE s'il y enseigne
     *
     * @param $request la requête du formulaire de suppression d'un enseignant 
     */
    public function deleteEnseignant(Request $request)
    {   
        //Tests sur le contenu du tableau ? Affichage erreur (aucune case cochée) ?
        $validator = Validator::make($request->all(), ['enseignants_a_supprimer' => 'required']);
        if (!$validator->fails()) {
            $id_ue = $request->input('id_ue');
            if($this->verifRespoUE($id_ue)) {
                foreach($request->input('enseignants_a_supprimer') as $idEnseignantASupprimer) {
                    $enseignantDsUE = EnseignantDansUE::where(['id_utilisateur' => $idEnseignantASupprimer, 'id_ue' => $id_ue ])->first();
                    if(!empty($enseignantDsUE)) {
                        $enseignantDsUE->delete();
                    }
                }
            }
        }
        return redirect('/respoUE/mesUE');
    }

    /**
     * Modifie les horaires et les groupes d'un enseignant dans une UE
     *
     * @param $request la requête du formulaire de modification d'un enseignant 
     */
    public function modifEnseignant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cm_nb_heures' => 'required|integer|min:0',
            'td_heures_par_groupe' => 'required|integer|min:0',
            'tp_heures_par_groupe' => 'required|integer|min:0',
            'ei_heures_par_groupe' => 'required|integer|min:0',
            'td_nb_groupes' => 'required|integer|min:0',
            'tp_nb_groupes' => 'required|integer|min:0',
            'ei_nb_groupes' => 'required|integer|min:0',
        ]);

        if (!$validator->fails()) {
            $id_ue = $request->input('id_ue'); 
            $id_utilisateur = $request->input('id_utilisateur')  ;
            if($this->verifRespoUE($id_ue)) {
                EnseignantDansUE::where(['id_utilisateur' => $id_utilisateur, 'id_ue' => $id_ue])->update([
                    'cm_nb_heures' => $request->input('cm_nb_heures'),
                    'td_heures_par_groupe' => $request->input('td_heures_par_groupe'),
                    'tp_heures_par_groupe' => $request->input('tp_heures_par_groupe'),
                    'ei_heures_par_groupe' => $request->input('ei_heures_par_groupe'),
                    'td_nb_groupes' => $request->input('td_nb_groupes'),
                    'tp_nb_groupes' => $request->input('tp_nb_groupes'),
                    'ei_nb_groupes' => $request->input('ei_nb_groupes')
                ]);
            }
        }
        return redirect('/respoUE/mesUE');
    }

    /**
     * Modifie les horaires et les groupes attendus d'une UE
     *
     * @param $request la requête du formulaire de modification d'une UE
     */
    public function modifUE(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cm_volume_attendu' => 'required|integer|min:0',
            'td_volume_attendu' => 'required|integer|min:0',
            'tp_volume_attendu' => 'required|integer|min:0',
            'ei_volume_attendu' => 'required|integer|min:0',
            'td_nb_groupes' => 'required|integer|min:0',
            'tp_nb_groupes' => 'required|integer|min:0',
            'ei_nb_groupes' => 'required|integer|min:0',
        ]);

        if (!$validator->fails()) {
            $id_ue = $request->input('id_ue');   
            if($this->verifRespoUE($id_ue)) {
                UniteeEnseignement::where('id', $id_ue)->update([
                    'cm_volume_attendu' => $request->input('cm_volume_attendu'),
                    'td_volume_attendu' => $request->input('td_volume_attendu'),
                    'tp_volume_attendu' => $request->input('tp_volume_attendu'),
                    'ei_volume_attendu' => $request->input('ei_volume_attendu'),
                    'td_nb_groupes_attendus' => $request->input('td_nb_groupes'),
                    'tp_nb_groupes_attendus' => $request->input('tp_nb_groupes'),
                    'ei_nb_groupes_attendus' => $request->input('ei_nb_groupes')
                ]);
            }
        }
        return redirect('/respoUE/mesUE');
    }



    public function export()
    {   
        $userA = Auth::user();
        $uesTemp = ResponsableUniteeEnseignement::where('id_utilisateur', $userA->id)->get();

        $ues = null;
        $enseignantsParUE = null;
        $nomPrenomEnseignant = null;

        //pour chaque UE dont l'utilisateur est responsable
        foreach ($uesTemp as $ueTemp) {
            $id_ue = $ueTemp['id_ue'];

            //On récupère toutes les infos de l'UE
            $ues[$id_ue] = UniteeEnseignement::where('id', $id_ue)->first();

            //On récupère aussi tous les enseignants en lien avec l'UE (avec leur nom et leur prénom)
            $enseignantsParUE[$id_ue] = EnseignantDansUE::where('id_ue', $id_ue)->join('users', 'users.id', '=', 'enseignant_dans_u_es.id_utilisateur')->get(); //tableau 3D (id UE -> id enseignant -> données de l'enseignant en lien avec l'UE)

        }

        $str = array(
                    array("Liste des UE"),
                    array(
                        "Nom",
                        "heures CM",
                        "heures TD",
                        "groupes TD",
                        "heures TP ",
                        "groupes TP",
                        "heures EI",
                        "groupes EI"
            ));

        foreach ($ues as $ue) {
            array_push($str, array(
                $ue->nom,
                $ue->cm_volume_attendu,
                $ue->td_volume_attendu, 
                $ue->td_nb_groupes_attendus,
                $ue->tp_volume_attendu,
                $ue->tp_nb_groupes_attendus,
                $ue->ei_volume_attendu,
                $ue->ei_nb_groupes_attendus,
            ));
        }

        array_push($str, array(""));
        array_push($str, array("Enseignants par UE"));

        $champs = array("Nom",
                        "heures CM",
                        "heures TD",
                        "groupes TD",
                        "heures TP ",
                        "groupes TP",
                        "heures EI",
                        "groupes EI"
                );

        foreach ($ues as $ue) {
            array_push($str, array(" ", " ", " ", $ue->nom, " ", " ", " ", " "));
            array_push($str, $champs);
            foreach ($enseignantsParUE[$ue->id] as $enseignant) {
                array_push($str, array(
                    $enseignant->prenom." ".$enseignant->nom,
                    $enseignant->cm_nb_heures,
                    $enseignant->td_heures_par_groupe,
                    $enseignant->td_nb_groupes,
                    $enseignant->tp_heures_par_groupe,
                    $enseignant->tp_nb_groupes,
                    $enseignant->ei_heures_par_groupe,
                    $enseignant->ei_nb_groupes
                ));
            }
            array_push($str, array(""));
        }

        $fichier = fopen("/tmp/mesUE.csv", "w");
        
        fprintf($fichier, chr(0xEF).chr(0xBB).chr(0xBF));

        foreach($str as $fields) {
            fputcsv($fichier, $fields);
        }

        fclose($fichier);

        return response()->download("/tmp/mesUE.csv");
    }

    
}
