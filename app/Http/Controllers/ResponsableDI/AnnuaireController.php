<?php

namespace App\Http\Controllers\ResponsableDI;

use App\Http\Controllers\Controller;

use App\Statut;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Validator;
use Illuminate\View\View;

class AnnuaireController extends Controller
{

    protected $civilite_array;
    protected $statut_array;

    public function __construct()
    {
        $this->civilite_array = array("M", "Mme");
        $this->statut_array = Statut::select('statut')->get();
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

            $validator = Validator::make($request->all(), [
                '0' => 'required|in_array:civilite_array',
                '1' => 'required|string|max:255',
                '2' => 'required|string|max:255',
                '3' => 'required',
                '4' => 'required',
                '5' => 'required|in_array',
            ]);

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