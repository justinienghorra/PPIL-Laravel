<?php

namespace App\Http\Controllers\Enseignant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnseignantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show(){

        $user = Auth::user();

        return view('mesEnseignements')->with('user', $user);
    }
}
