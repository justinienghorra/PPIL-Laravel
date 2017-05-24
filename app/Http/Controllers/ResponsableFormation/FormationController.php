<?php

namespace App\Http\Controllers\ResponsableFormation;


use App\EnseignantDansUE;
use App\Formation;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Notification;
use App\ResponsableDepInfo;
use App\ResponsableUniteeEnseignement;
use App\UniteeEnseignement;
use App\User;
use League\Csv\Reader;
use Illuminate\Http\Request;
use App\Photos;
use Validator;
use Illuminate\Support\Facades\Auth;

class FormationController extends Controller
{
    public function __construct()
    {
        //route accessible que si l'utilisateur est authentifié
        $this->middleware('auth');
    }

    public function showAll()
    {
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

        //recupere les formations de l'utilisateur
        $formations = $userA->formations;


        return view('respoFormation.mesFormations')->with(['formations' => $formations, 'respoUE' => $respoUE, 'userA' => $userA, 'respoDI' => $respoDI, 'respoForm' => $respoForm, 'photoUrl' => $tmp[1]]);

    }

    public function show($nom_formation)
    {

        // Retourne l'utilisateur courant authentifie...
        $user = Auth::user();

        $formation = Formation::where('nom', '=', $nom_formation)->first();
        $ues = UniteeEnseignement::where('id_formation', $formation->id)->get();
        $respoUE = ResponsableUniteeEnseignement::all();
        $users = User::allValidate();

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

        return view('respoFormation.formation')->with(['user' => $user, 'formation' => $formation, 'ues' => $ues, 'respoUE' => $respoUE, 'users' => $users, 'userA' => $userA, 'respoDI' => $respoDI, 'respoForm' => $respoForm, 'photoUrl' => $tmp[1]]);
    }

    /**
     * Ajoute une ue
     *
     * @param Request $req
     *
     * @return mixed
     */
    public function add(Request $req, $nom_formation)
    {
        $user = Auth::user();

        $validator = Validator::make($req->all(), [
            'nom' => 'required|string|max:255|unique:unitee_enseignements',
            'description' => 'required|string|max:255',
        ]);

        $formation = Formation::where('nom', $nom_formation)->first();

        if (!$validator->fails()) {
            $ue = new UniteeEnseignement();
            $ue->nom = $req->nom;
            $ue->description = $req->description;
            $ue->id_formation = $formation->id;
            $ue->save();

            $di = ResponsableDepInfo::all()->first();

            $messageNotif = "L'UE " . $ue->nom . " a été ajoutée à la formation " . $formation->nom;
            Notification::createNotification($messageNotif, $user->id, $di->id);


            //return response()->json(["message" => "success", "ue" => $ue]);
            return redirect('/formation/' . $nom_formation);
        } else {
            //return response()->json(["message" => "errors", "errors" => $validator->messages()]);
            return redirect('/formation/' . $nom_formation)->withErrors($validator);
        }
    }


    /**
     * Supprime une ue avec un ID
     *
     * @param Request $req
     *
     * @return Response
     */
    public function delete(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id_ue' => 'required|integer|exists:unitee_enseignements,id',
            'nom_formation' => 'required|string|exists:formations,nom'
        ]);

        $user = Auth::user();

        if (!$validator->fails()) {
            $ue = UniteeEnseignement::where('id', $req->id_ue)->first();
            $resp = $ue->responsable;
            if ($resp) {
                $resp->delete();
            }

            $formation = Formation::where('nom', $req->nom_formation)->first();

            $di = ResponsableDepInfo::all()->first();

            $messageNotif = "L'UE " . $ue->nom . " a été supprimée à la formation " . $formation->nom;
            Notification::createNotification($messageNotif, $user->id, $di->id);

            $ue->delete();
            return response()->json(["message" => "success"]);
        } else {
            return response()->json(["message" => "errors", "errors" => json_encode($validator->messages())]);
        }
    }

    /**
     * Renvoie un CSV contenant la liste des ues
     *
     * @return Response
     */
    public function getFormationsCSV($nom_formation)
    {

        $formation = Formation::where('nom', $nom_formation)->first();
        $ues = UniteeEnseignement::where('id_formation', $formation->id)->get();

        //TODO CM_VOLUME_AFFECTE
        $str = array(
            array($formation->nom),
            array(),
            array(
                "nom",
                "description",
                "responsable",
                "cm_volume_attendu",
                "td_volume_attendu",
                "tp_volume_attendu",
                "ei_volume_attendu",
                "td_nb_groupes_attendus",
                "tp_nb_groupes_attendus",
                "ei_nb_groupes_attendus",
                "attente_validation"
            ));

        foreach ($ues as $ue) {

            if ($ue->hasResponsable()) {
                array_push($str, array(
                    $ue->nom,
                    $ue->description,
                    $ue->responsable->user->email,
                    $ue->cm_volume_attendu,
                    $ue->td_volume_attendu,
                    $ue->tp_volume_attendu,
                    $ue->ei_volume_attendu,
                    $ue->td_nb_groupes_attendus,
                    $ue->tp_nb_groupes_attendus,
                    $ue->ei_nb_groupes_attendus,
                    $ue->attente_validation
                ));
            } else {
                array_push($str, array(
                    $ue->nom,
                    $ue->description,
                    " ",
                    $ue->cm_volume_attendu,
                    $ue->td_volume_attendu,
                    $ue->tp_volume_attendu,
                    $ue->ei_volume_attendu,
                    $ue->td_nb_groupes_attendus,
                    $ue->tp_nb_groupes_attendus,
                    $ue->ei_nb_groupes_attendus,
                    $ue->attente_validation
                ));
            }
        }

        $fichier = fopen("/tmp/" . $formation->nom . ".csv", "w");

        fprintf($fichier, chr(0xEF) . chr(0xBB) . chr(0xBF));

        foreach ($str as $fields) {
            fputcsv($fichier, $fields);
        }

        fclose($fichier);
        return response()->download("/tmp/" . $formation->nom . ".csv");
    }

    /**
     * Fonction chargée de l'imporation de CSV
     *
     *
     */
    public function importCSV(Request $req, $nom_formation)
    {
        $validator = Validator::make(
            [
                'file' => $req->file('file_csv'),
                'extension' => strtolower($req->file('file_csv')->getClientOriginalExtension()),
            ]
            ,
            [
                'file' => 'required',
                'extension' => 'required|in:csv',
            ]
        );

        $user = Auth::user();

        if ($validator->fails()) {
            return redirect('/respoFormation/formation/' . $nom_formation)->withErrors($validator);
        }

        $formation = Formation::where('nom', $nom_formation)->first();


        $file = $req->file('file_csv');
        $num_row = 0;
        $csv = Reader::createFromPath($file->path());
        $csv->setDelimiter(';');
        $errors_custom = array();
        $res = $csv
            ->addFilter(function ($row, $index) {
                return $index > 0; //we don't take into account the header
            })
            ->addFilter(function ($row) {
                return true; //we make sure the data are present
            })->fetch();

        //TODO checker le header
        $new_ues = array();
        $new_responsables = array();


        foreach ($res as $row) {
            $num_row++;
            $validator = Validator::make([
                'nom' => $row[0],
                'description' => $row[1],
                'responsable' => trim($row[2]),
                'cm_volume_attendu' => $row[3],
                'td_volume_attendu' => $row[4],
                'tp_volume_attendu' => $row[5],
                'ei_volume_attendu' => $row[6],
                'td_nb_groupes_attendus' => $row[7],
                'tp_nb_groupes_attendus' => $row[8],
                'ei_nb_groupes_attendus' => $row[9],
                'attente_validation' => $row[10],

            ], [
                'nom' => 'max:255|required|string',
                'description' => 'required|string|max:255',
                'responsable' => 'string|exists:users,email',
                'cm_volume_attendu' => 'required|integer|min:0',
                'td_volume_attendu' => 'required|integer|min:0',
                'tp_volume_attendu' => 'required|integer|min:0',
                'ei_volume_attendu' => 'required|integer|min:0',
                'td_nb_groupes_attendus' => 'required|integer|min:0',
                'tp_nb_groupes_attendus' => 'required|integer|min:0',
                'ei_nb_groupes_attendus' => 'required|integer|min:0',
                'attente_validation' => 'required|boolean',
            ]);

            if ($validator->fails()) {

                dd($validator);

                $errors_custom['ligne'] = $num_row;
                $this->importRollback($new_ues, $new_responsables);
                return redirect('/respoFormation/formation/' . $nom_formation)->with('errors_custom', $errors_custom)->withErrors($validator);
            }


            $ue = new UniteeEnseignement();
            $ue->nom = $row[0];
            $ue->description = $row[1];
            $ue->save();

            $di = ResponsableDepInfo::all()->first();

            $messageNotif = "L'UE " . $ue->nom . " a été ajoutée à la formation " . $formation->nom;
            Notification::createNotification($messageNotif, $user->id, $di->id);


            if (isset($row[2]) && is_string($row[2]) && strlen(trim($row[2])) > 2) {
                $row[2] = trim($row[2]);
                $validator_mail = Validator::make([
                    'email' => trim($row[2]),
                ], [
                    'email' => 'exists:users,email'
                ]);

                if ($validator_mail->fails()) {
                    $errors_custom['ligne'] = $num_row;
                    $this->importRollback($new_ues, $new_responsables);
                    return redirect('/respoFormation/formation/' . $formation->nom)->with('errors_custom', $errors_custom)->withErrors($validator);;
                }

                $resp = new ResponsableUniteeEnseignement();
                $resp->id_ue = $ue->id;
                $user = User::where('email', trim($row[2]))->first();
                $resp->id_utilisateur = $user->id;
                $resp->save();


                array_push($new_responsables, $resp);

            }

            $ue->cm_volume_attendu = $row[3];
            $ue->td_volume_attendu = $row[4];
            $ue->tp_volume_attendu = $row[5];
            $ue->ei_volume_attendu = $row[6];
            $ue->td_nb_groupes_attendus = $row[7];
            $ue->tp_nb_groupes_attendus = $row[8];
            $ue->ei_nb_groupes_attendus = $row[9];
            $ue->attente_validation = 1;

            $formation = Formation::where('nom', $nom_formation)->first();
            //dd($formation->id);
            $ue->id_formation = $formation->id;

            $ue->save();
            array_push($new_ues, $ue);

        }

        return redirect('/respoFormation/formation/' . $nom_formation);
    }

    /**
     * Annule les changements faits par l'importation en cas d'erreur
     *
     * @param $new_ues
     * @param $new_responsable
     */
    private function importRollback($new_ues, $new_responsable)
    {
        foreach ($new_responsable as $resp) {
            $resp->delete();
        }
        foreach ($new_ues as $form) {
            $form->delete();
        }
    }

    /**
     * Change le responsable d'une UE
     *
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateResponsable(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id_utilisateur' => 'required|integer',
            'id_ue' => 'required|integer|exists:unitee_enseignements,id',
            'nom_formation' => 'required|string|exists:formations,nom'
        ]);

        $user = Auth::user();

        if (!$validator->fails()) {

            $ue = UniteeEnseignement::where('id', $req->id_ue)->first();
            if ($ue->hasResponsable()) {
                $ue->responsable->delete();
            }

            $formation = Formation::where('nom', $req->nom_formation)->first();

            if ($req->id_utilisateur > 0) {

                $resp = new ResponsableUniteeEnseignement();
                $resp->id_utilisateur = $req->id_utilisateur;
                $resp->id_ue = $req->id_ue;
                $resp->save();

                $responsable = User::where('id', $resp->id_utilisateur)->first();

                $di = ResponsableDepInfo::all()->first();

                $messageNotif = "Nouveau responsable de l'UE " . $ue->nom . " de la formation " . $formation->nom . " : " . $responsable->prenom . " " . $responsable->nom;
                Notification::createNotification($messageNotif, $user->id, $di->id);
                $messageNotif = "Vous êtes le responsable de l'UE " . $ue->nom . " de la formation " . $formation->nom;
                Notification::createNotification($messageNotif, $user->id, $responsable->id);

            }

            return response()->json(["message" => "success", "user" => $resp->user]);
        } else {
            return response()->json(["message" => "errors", "errors" => $validator]);
        }
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
        $nom_formation = $request->input('nom_formation');

        $verifExistenceEnseignant = EnseignantDansUE::where(['id_ue' => $id_ue, 'id_utilisateur' => $id_enseignant])->first();
        if (empty($verifExistenceEnseignant)) {

            $enseignantDsUE = new EnseignantDansUE();
            $enseignantDsUE->id_utilisateur = $id_enseignant;
            $enseignantDsUE->id_ue = $request->input('id_ue');
            $enseignantDsUE->save();

            $ue = UniteeEnseignement::where('id', $id_ue)->first();
            $userA = Auth::user();

            $messageNotif = "Ajouté dans l'UE " . $ue->nom;
            Notification::createNotification($messageNotif, $userA->id, $id_enseignant);

        }
        return redirect('/respoFormation/formation/' . $nom_formation);
    }

    /**
     * Supprime un enseignant d'une UE s'il y enseigne
     *
     * @param $request la requête du formulaire de suppression d'un enseignant
     */
    public function deleteEnseignant(Request $request)
    {
        //Tests sur le contenu du tableau ? Affichage erreur (aucune case cochée) ?
        $nom_formation = $request->input('nom_formation');
        $validator = Validator::make($request->all(), ['enseignants_a_supprimer' => 'required']);
        if (!$validator->fails()) {
            $id_ue = $request->input('id_ue');
            foreach ($request->input('enseignants_a_supprimer') as $idEnseignantASupprimer) {
                $enseignantDsUE = EnseignantDansUE::where(['id_utilisateur' => $idEnseignantASupprimer, 'id_ue' => $id_ue])->first();
                if (!empty($enseignantDsUE)) {
                    $enseignantDsUE->delete();

                    $ue = UniteeEnseignement::where('id', $id_ue)->first();
                    $userA = Auth::user();

                    $messageNotif = "Retiré de l'UE " . $ue->nom;
                    Notification::createNotification($messageNotif, $userA->id, $enseignantDsUE->id_utilisateur);

                }
            }
        }
        return redirect('/respoFormation/formation/' . $nom_formation);
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

        $nom_formation = $request->input('nom_formation');


        if (!$validator->fails()) {
            $id_ue = $request->input('id_ue');
            $id_utilisateur = $request->input('id_utilisateur');
            EnseignantDansUE::where(['id_utilisateur' => $id_utilisateur, 'id_ue' => $id_ue])->update([
                'cm_nb_heures' => $request->input('cm_nb_heures'),
                'td_heures_par_groupe' => $request->input('td_heures_par_groupe'),
                'tp_heures_par_groupe' => $request->input('tp_heures_par_groupe'),
                'ei_heures_par_groupe' => $request->input('ei_heures_par_groupe'),
                'td_nb_groupes' => $request->input('td_nb_groupes'),
                'tp_nb_groupes' => $request->input('tp_nb_groupes'),
                'ei_nb_groupes' => $request->input('ei_nb_groupes')
            ]);

            $ue = UniteeEnseignement::where('id', $id_ue)->first();
            $userA = Auth::user();

            $messageNotif = "Horaires modifiés dans l'UE " . $ue->nom;
            Notification::createNotification($messageNotif, $userA->id, $id_utilisateur);


        }
        return redirect('/respoFormation/formation/' . $nom_formation);
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

        $nom_formation = $request->input('nom_formation');

        if (!$validator->fails()) {
            $id_ue = $request->input('id_ue');
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
        return redirect('/respoFormation/formation/' . $nom_formation);
    }
}