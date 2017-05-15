<?php

namespace App\Http\Controllers\ResponsableDI;


use App\Formation;
use App\ResponsableFormation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
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
     *
     * @return mixed
     */
    public function add(Request $req) {
        $validator = Validator::make($req->all(), [
            'nom' => 'required|string|max:255|unique:formations',
            'description' => 'required|string|max:255',
        ]);

        if (!$validator->fails()) {
            $formation = new Formation();
            $formation->nom = $req->nom;
            $formation->description = $req->description;
            $formation->save();
            return response()->json(["message" => "success", "formation" => json_encode($formation)]);
        } else {
            return response()->json(["message" => "errors", "errors" => json_encode($validator)]);
        }
    }

    /**
     * Supprime une formation avec un ID
     *
     * @param Request $req
     *
     * @return Response
     */
    public function delete(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'id_formation' => 'required|integer|exists:formations,id'
        ]);

        if (!$validator->fails()) {
            $form = Formation::where('id', $req->id_formation)->first();
            $form->delete();
            return response()->json(["message" => "success"]);
        } else {
            return response()->json(["message" => "errors", "errors" => json_encode($validator->messages())]);
        }
    }

    /**
     * Renvoie un CSV contenant la liste des formations
     */
    public function getFormationsCSV() {
        $formations = Formation::all();
        $str = "nom,description,responsable";
        foreach ($formations as $formation) {
            $str = $str . "\n" . $formation->nom . ", " . $formation->description . ", ";
            if ($formation->hasResponsable()) {
                $str = $str . $formation->responsable->user->email;
            }
        }
        file_put_contents("/tmp/formations.csv", $str);
        return response()->download("/tmp/formations.csv");
    }
}