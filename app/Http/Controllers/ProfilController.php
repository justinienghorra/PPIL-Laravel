<?php

namespace App\Http\Controllers;

use App\Statut;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //route accessible que si l'utilisateur est authentifié
        $this->middleware('auth');
    }

    public function show(){

        // Retourne l'utilisateur courant authentifie...
        $user = Auth::user();

        $statuts = Statut::all();

        //TODO : modifier la vue en consequence avec le parametre (email deja change)
        return view('profil')->with('user', $user)->with('statuts', $statuts);
    }

    public static function getStatut(){
        $user = Auth::user();

        $statut = Statut::select('statut')->where('id', '=', $user->id_statut)->first();

        return $statut->statut;
    }

    public function postEmail(Request $request){

        // Retourne l'utilisateur courant authentifie...
        $user = Auth::user();

        $user->updateEmail($request->input('email'));
    }
}
