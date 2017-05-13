<?php

namespace App\Http\Controllers\ResponsableDI;

use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AnnuaireController extends Controller
{
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

        return redirect('/di/annuaire');
    }
}