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
use League\Csv\Reader;

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
            $resp = $form->responsable;
            if ($resp) {
                $resp->delete();
            }
            $form->delete();
            return response()->json(["message" => "success"]);
        } else {
            return response()->json(["message" => "errors", "errors" => json_encode($validator->messages())]);
        }
    }

    /**
     * Renvoie un CSV contenant la liste des formations
     *
     * @return Response
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

    /**
     * Fonction chargé de l'imporation de CSV
     *
     *
     */
    public function importCSV(Request $req) {
        $validator = Validator::make(
            [
                'file' => $req->file('file_csv'),
                'extension' => strtolower($req->file('file_csv')->getClientOriginalExtension()),
            ]
            ,
            [
                'file' => 'required',
                'extension' => 'required|in:csv',
            ]
        );

        if ($validator->fails()) {
            return redirect('/di/formations')->withErrors($validator);
        }


        $file = $req->file('file_csv');

        $csv = Reader::createFromPath($file->path());
        //$csv = Reader::createFromPath('');
        $csv->setDelimiter(';');

        $res = $csv
            ->addFilter(function ($row, $index) {
                return $index > 0; //we don't take into account the header
            })
            ->addFilter(function ($row) {
                return isset($row[1], $row[2]); //we make sure the data are present
            })->fetch();

        //dd($res);
        $new_formations = array();
        $new_responsables = array();
        foreach ($res as $row) {
            $validator = Validator::make([
                'nom' => $row[0],
                'description' => $row[1],
            ], [
                'nom' => 'max:255|required|string|unique:formations,nom',
                'description' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                $this->importRollback($new_formations, $new_responsables);
                return redirect('/di/formations');
            }

            $formation = new Formation;
            $formation->nom = $row[0];
            $formation->description = $row[1];
            $formation->save();
            if (isset($row[2]) && is_string($row[2]) && strlen(trim($row[2])) > 2) {
                $row[2] = trim($row[2]);
                $validator_mail = Validator::make([
                    'email' => trim($row[2]),
                ], [
                    'email' => 'exists:users,email'
                ]);

                if ($validator_mail->fails()) {
                    $this->importRollback($new_formations, $new_responsables);
                    return redirect('/di/formations');
                }

                $resp = new ResponsableFormation;
                $resp->id_formation = $formation->id;
                $user = User::where('email', trim($row[2]))->first();
                $resp->id_utilisateur = $user->id;
                $resp->save();

                array_push($new_formations, $formation);
                array_push($new_responsables, $resp);

            } else {
                array_push($new_formations, $formation);
            }

        }

        return redirect('/di/formations');
    }

    /**
     * Annule les changements faits par l'importation en cas d'erreur
     *
     * @param $new_formations
     * @param $new_responsable
     */
    private function importRollback($new_formations, $new_responsable) {
        foreach ($new_responsable as $resp) {
            $resp->delete();
        }
        foreach ($new_formations as $form) {
            $form->delete();
        }
    }
}