<?php

namespace App\Http\Controllers\ResponsableDI;

use App\Http\Controllers\Controller;

use App\Statut;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Validator;
use Illuminate\View\View;

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
        $str = "enseignant,statut,email";
        foreach ($users as $user) {
            $str = $str . "\n" . $user->prenom . " " . $user->nom . ", " . $user->statut() . ", " . $user->email;
        }
        file_put_contents("/tmp/annuaire.csv", $str);
        return response()->download("/tmp/annuaire.csv");
    }

    /**
     * Importation d'un fichier csv
     */
    protected function importCSV(Request $request) {
        //TODO check le type du fichier
        $file = $request->file('file_csv');

        $f = fopen($file->path(), "r");

        $csv_content = fgetcsv($f);
        while ($csv_content) {

            $validator = Validator::make($csv_content, [
                '0' => ['required', 'string', Rule::in(['M, "Mme'])],
                '1' => 'required|string|max:255',
                '2' => 'required|string|max:255',
                '3' => 'required|string|email|unique:users,email',
                '4' => 'required|string',
                '5' => ['required', 'string', Rule::in($this->statut_array)],
            ]);

            if ($validator->fails()) {
                return redirect('/di/annuaire')->withErrors($validator);
            }

            $user = new User;
            $user->civilite = $csv_content[0];
            $user->prenom = $csv_content[1];
            $user->nom = $csv_content[2];
            $user->email = $csv_content[3];
            $user->adresse = $csv_content[4];
            $user->id_statut = Statut::where('statut', $csv_content[5])->first()->id;
            $user->password = bcrypt("password");
            $user->attente_validation = false;
            $user->save();
            $csv_content = fgetcsv($f);
        }


        fclose($f);
        return redirect('/di/annuaire');
    }
}