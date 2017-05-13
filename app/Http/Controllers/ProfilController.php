<?php

namespace App\Http\Controllers;

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

        //TODO : modifier la vue en consequence avec le parametre (email deja change)
        return view('profil')->with('user', $user);
    }
}
