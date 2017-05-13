<?php

namespace App\Http\Controllers\ResponsableDI;

use App\Http\Controllers\Controller;

use App\User;
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
}