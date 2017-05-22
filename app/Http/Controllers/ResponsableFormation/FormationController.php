<?php

namespace App\Http\Controllers\ResponsableFormation;


use App\Formation;
use App\Http\Controllers\Controller;
use App\ResponsableUniteeEnseignement;
use App\UniteeEnseignement;
use App\User;
use League\Csv\Reader;
use Validator;
use Illuminate\Http\Request;
use App\Photos;
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
        $photoUrl =  Photos::where('id_utilisateur', $userA->id)->first();
        $tmp = null;

        if ($photoUrl != null){
            $url = $photoUrl->adresse;
            $tmp = explode("images", $url);
        }

        //recupere les formations de l'utilisateur
        $formations = $userA->formations;

        return view('respoFormation.mesFormations')->with(['formations' => $formations, 'respoUE' => $respoUE, 'userA' => $userA, 'respoDI' => $respoDI,'respoForm' => $respoForm, 'photoUrl' => $photoUrl]);
    }

    public function show($nom_formation)
    {

        // Retourne l'utilisateur courant authentifie...
        $user = Auth::user();

        $formation = Formation::where('nom', '=', $nom_formation)->first();
        $ues = UniteeEnseignement::where('id_formation', $formation->id)->get();
        $respoUE = ResponsableUniteeEnseignement::all();
        $users = User::all();

        /** Récupération des droit de l'utilisateur authentifier pour gérer le menu */
        $userA = Auth::user();
        $respoDI = $userA->estResponsableDI();
        $respoUE = $userA->estResponsableUE();
        $respoForm = $userA->estResponsableForm();
        $photoUrl =  Photos::where('id_utilisateur', $userA->id)->first();
        $tmp = null;

        if ($photoUrl != null){
            $url = $photoUrl->adresse;
            $tmp = explode("images", $url);
        }

        return view('respoFormation.formation')->with(['user' => $user, 'formation' => $formation, 'ues' => $ues, 'respoUE' => $respoUE, 'users' => $users, 'userA' => $userA, 'respoDI' => $respoDI,'respoForm' => $respoForm, 'photoUrl' => $photoUrl]);
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
            'id_ue' => 'required|integer|exists:unitee_enseignements,id'
        ]);



        if (!$validator->fails()) {
            $form = UniteeEnseignement::where('id', $req->id_ue)->first();
            $resp = $form->responsable;
            if ($resp) {
                $resp->delete();
            }
            $form->delete();
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
        $str = "nom;description;responsable;cm_volume_attendu;td_volume_attendu;tp_volume_attendu;ei_volume_attendu;td_nb_groupes_attendus;tp_nb_groupes_attendus;ei_nb_groupes_attendus;attente_validation";


        foreach ($ues as $ue) {
            $str = $str . "\n" . $ue->nom . "; " . $ue->description . "; ";
            if ($ue->hasResponsable()) {
                $str = $str . $ue->responsable->user->email;
            }
            $str = $str . ';';

            $str = $str . $ue->cm_volume_attendu . ';';
            $str = $str . $ue->td_volume_attendu . ';' ;
            $str = $str . $ue->tp_volume_attendu . ';' ;
            $str = $str . $ue->ei_volume_attendu . ';' ;

            $str = $str . $ue->td_nb_groupes_attendus . ';';
            $str = $str . $ue->tp_nb_groupes_attendus . ';';
            $str = $str . $ue->ei_nb_groupes_attendus . ';';

            $str = $str . $ue->attente_validation;
            //$str = $str . $formation->nom;
        }

        file_put_contents("/tmp/" . $formation->nom . ".csv", $str);
        return response()->download("/tmp/" . $formation->nom . ".csv");
    }

    /**
     * Fonction chargé de l'imporation de CSV
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
        ]);

        if (!$validator->fails()) {

            $ue = UniteeEnseignement::where('id', $req->id_ue)->first();
            if ($ue->hasResponsable()) {
                $ue->responsable->delete();
            }

            if ($req->id_utilisateur > 0) {

                $resp = new ResponsableUniteeEnseignement();
                $resp->id_utilisateur = $req->id_utilisateur;
                $resp->id_ue = $req->id_ue;
                $resp->save();
            }

            return response()->json(["message" => "success", "user" => $resp->user]);
        } else {
            return response()->json(["message" => "errors", "errors" => $validator]);
        }
    }
}