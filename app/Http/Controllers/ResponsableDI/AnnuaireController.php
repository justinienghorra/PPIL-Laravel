<?php

namespace App\Http\Controllers\ResponsableDI;

use App\Http\Controllers\Controller;

use App\Statut;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use League\Csv\Reader;

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
    protected function show() {
        $users = User::all();
        return \view('di.annuaire')->with('users', $users);
    }

    /**
     * Retourne la liste des utilisateurs au format json
     */
    protected function getAnnuaireJSON() {
        $users = User::all();
        return json_encode($users);
    }

    /**
     * Retourne la liste des utilisateurs au format json
     */
    protected function getAnnuaireCSV() {
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
    protected function importCSV(Request $request) {

        $validator = Validator::make(
            [
                'file' => $request->file('file_csv'),
                'extension' => strtolower($request->file('file_csv')->getClientOriginalExtension()),
            ]
            ,
            [
                'file' => 'required',
                'extension' => 'required|in:csv',
            ]
        );

        if ($validator->fails()) {
            return redirect('/di/annuaire')->withErrors($validator);
        }


        $file = $request->file('file_csv');
        $new_users = array();
        $errors_custom = array();
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
                'civilite' => ['required', 'string', Rule::in(['M, "Mme'])],
                'prenom' => 'alpha|required|string|max:255',
                'nom' => 'alpha|required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'adresse' => 'required|string',
                'statut' => ['required', 'string', Rule::in($this->statut_array)],
            ]);

            if ($validator->fails()) {
                $errors_custom['ligne'] = $num_row;
                $this->importRollback($new_users);
                return redirect('/di/annuaire')->with('errors_custom', $errors_custom)->withErrors($validator);
            }

            $user = new User;
            $user->civilite = $row[0];
            $user->prenom = $row[1];
            $user->nom = $row[2];
            $user->email = $row[3];
            $user->adresse = $row[4];
            $user->id_statut = Statut::where('statut', $row[5])->first()->id;

            // TODO gérer mot de passe et mail ?

            $user->password = bcrypt("password");
            $user->attente_validation = false;
            $user->save();
            array_push($new_users, $user);

        }

        return redirect('/di/annuaire');
    }

    private function importRollback($new_users) {
        foreach ($new_users as $user) {
            $user->delete();
        }
    }
}