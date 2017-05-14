<?php

namespace App\Http\Controllers\ResponsableFormation;


use App\Formation;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class FormationController extends Controller
{
    public function __construct()
    {
        //route accessible que si l'utilisateur est authentifié
        $this->middleware('auth');
    }

    public function show(){

        // Retourne l'utilisateur courant authentifie...
        $user = Auth::user();
        $formation = Formation::where('id', '=', IDFORMATION);

        return view('profil')->with('user', $user)->with('formation', $formation);
    }

    public static function getResponsable(){

        $user = Auth::user();

        $respo = User::where('id', '=', IDFORMATION)->first();

        return $respo;
    }
}