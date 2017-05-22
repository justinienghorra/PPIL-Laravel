<?php

namespace App\Http\Controllers\ResponsableDI;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Statut;
use Illuminate\Support\Facades\Log;
use App\User;
use App\Photos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use League\Csv\Reader;

// TODO : confirmation suppression

class AnnuaireController extends Controller
{
    protected $statut_array;

    public function __construct()
    {
        $this->statut_array = array();
        foreach (Statut::select('statut')->cursor() as $statut) {
            array_push($this->statut_array, $statut->statut);
        }
    }

    /**
     * Retourne la vue de l'annuaire
     *
     * @return View
     */
    protected function show()
    {
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
        
        return \view('di.annuaire')->with('users', $users)->with('userA', $userA)->with('photoUrl', $tmp[1])->with('respoDI', $respoDI)->with('respoForm', $respoForm)->with('respoUE', $respoUE);
    }

    /**
     * Retourne la liste des utilisateurs au format json
     */
    protected function getAnnuaireJSON()
    {
        $users = User::all();
        return $users;
    }

    /**
     * Retourne la liste des utilisateurs au format json
     */
    protected function getAnnuaireCSV()
    {
        $users = User::all();
        $str = "enseignant;statut;email";
        foreach ($users as $user) {
            $str = $str . "\n" . $user->prenom . " " . $user->nom . "; " . $user->statut() . "; " . $user->email;
        }
        file_put_contents("/tmp/annuaire.csv", $str);
        return response()->download("/tmp/annuaire.csv");
    }

    /**
     * Importation d'un fichier csv
     */
    protected function importCSV(Request $request)
    {

        $validator = Validator::make(
            [
                'file' => $request->file('file_csv'),
            ]
            ,
            [
                'file' => 'required',
            ]
        );

        if ($validator->fails()) {
            return redirect('/di/annuaire')->withErrors($validator);
        }

        $validator = Validator::make(
            [
                'extension' => strtolower($request->file('file_csv')->getClientOriginalExtension()),
            ]
            ,
            [
                'extension' => 'required|in:csv',
            ]
        );

        if ($validator->fails()) {
            return redirect('/di/annuaire')->withErrors($validator);
        }


        $file = $request->file('file_csv');
        $new_users = array();
        $messages = array();
        $num_row = 0;
        $csv = Reader::createFromPath($file->path());
        $csv->setDelimiter(';');

        $res = $csv
            ->addFilter(function ($row, $index) {
                return $index > 0; //we don't take into account the header
            })
            ->addFilter(function ($row) {
                return isset($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]); //we make sure the data are present
            })->fetch();

        //TODO checker le header

        foreach ($res as $row) {
            $num_row++;

            $validator = Validator::make([
                'civilite' => $row[0],
                'prenom' => $row[1],
                'nom' => $row[2],
                'email' => trim($row[3]),
                'adresse' => $row[4],
                'statut' => $row[5],
            ], [
                'civilite' => ['required', 'string', Rule::in(['M.', 'Mme', 'M'])],
                'prenom' => 'alpha|required|string|max:255',
                'nom' => 'alpha|required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'adresse' => 'required|string',
                'statut' => ['required', 'string', Rule::in($this->statut_array)],
            ]);

            if ($row[0] === 'M') $row[0] = 'M.';

            if ($validator->fails()) {
                $messages['ligne'] = $num_row;
                $this->importRollback($new_users);
                return redirect('/di/annuaire')
                    ->with('messages', $messages)
                    ->with('errors', $validator->errors());
            }

            $user = new User;
            $user->civilite = $row[0];
            $user->prenom = $row[1];
            $user->nom = $row[2];
            $user->email = $row[3];
            $user->adresse = $row[4];
            $user->id_statut = Statut::where('statut', $row[5])->first()->id;

            // TODO : gérer mot de passe et mail ?

            $user->password = bcrypt("password");
            $user->attente_validation = false;
            $user->save();
            $photo = new Photos;
            $photo->adresse = "/var/www/public/images/default.jpg";
            $photo->id_utilisateur =  $user->id;
            $photo->save();
            array_push($new_users, $user);

        }

        $messages['succes'] = "Importation réussie";
        return redirect('/di/annuaire')->with('messages', $messages);
    }

    /**
     * Annule les changements fait par importCSV en cas d'erreur
     *
     * @param $new_users
     */
    private function importRollback($new_users)
    {
        foreach ($new_users as $user) {
            $user->delete();
        }
    }

    /**
     * Suppression d'une utilisateur
     *
     * @param Request $req
     *
     * @return Response
     */
    public function delete(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'id_utilisateur' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(["message" => "errors", "errors" => $validator->messages()]);
        }

        $current_user = Auth::user();
        Log::info("ID utilisateur : " . $req->id_utilisateur);
        Log::info("ID current : " . $current_user->id);
        if ($req->id_utilisateur == $current_user->id) {
            return response()->json(["message" => "errors", "errors" => array("fail" => "Impossible de supprimer l'utilisateur connecté")]);
        }

        $u = User::where('id', $req->id_utilisateur)->first();
        $u->delete();
        return response()->json(["message" => "success"]);
    }


}