<?php

namespace App\Http\Controllers\ResponsableDI;

use App\Http\Controllers\Controller;

use Illuminate\View\View;

class AnnuaireController extends Controller
{
    /**
     * Retourne la vue de l'annuaire
     *
     * @return View
     */
    protected function show() {
        return \view('di.annuaire');
    }
}