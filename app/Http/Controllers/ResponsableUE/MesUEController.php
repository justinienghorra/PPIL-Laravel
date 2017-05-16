<?php


namespace App\Http\Controllers\ResponsableUE;


use App\Http\Controllers\Controller;
use App\UniteeEnseignement;
use App\ResponsableUniteeEnseignement;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\View\View;
	
class MesUEController extends Controller
{
    /**
     * Retourne la vue présentant la liste des UEs dont l'utilisateur est responsable
     *
     * @return View
     */
     public function show() {
     		return view('mesUE');
     }
    
}
