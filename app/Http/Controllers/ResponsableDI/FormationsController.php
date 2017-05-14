<?php

namespace App\Http\Controllers\ResponsableDI;


use App\Formation;
use Illuminate\View\View;

class FormationsController
{
    /**
     * Retourne la vue présentant la liste des formations
     *
     * @return View
     */
    public function show() {

        $formations = Formation::all();

        return view('di.formations')->with(['formations' => $formations]);
    }
}