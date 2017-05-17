<?php

namespace App\Http\Controllers\ResponsableDI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecapEnseignantsController extends Controller
{
    /**
     * Retourne la vue présentant le recapitulatif des enseignants
     *
     * @return View
     */
    public function show() {
       // $formations = Formation::all();
        //$users = User::all();
        return view('di/recapEnseignants');
    }
}
