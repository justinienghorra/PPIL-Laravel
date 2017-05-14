<?php

namespace App\Http\Controllers\ResponsableDI;


use App\Formation;
use App\ResponsableFormation;
use App\User;
use Illuminate\Http\Request;
use Validator;
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
        $users = User::all();
        return view('di.formations')->with(['formations' => $formations, 'users' => $users]);
    }

    /**
     * Ajoute une formation
     *
     * @param Request $req
     */
    public function add(Request $req) {
        $validator = Validator::make($req->all(), [
            'nom' => 'required|string|max:255|unique:formations',
            'description' => 'required|string|max:255',
            'responsable' => 'required|integer|unique:formations,id'
        ]);

        if (!$validator->fails()) {
            $formation = new Formation();
            $formation->nom = $req->nom;
            $formation->description = $req->description;
            $formation->save();
            $respFormation = new ResponsableFormation();
            $respFormation->id_formation = $formation->id;
            $respFormation->id_utilisateur = User::where('id', $req->responsable)->first();
            $respFormation->save();
        }
    }
}