<?php


namespace App\Http\Controllers\ResponsableDI;


use App\Http\Controllers\Controller;
use App\Journal;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JournalController extends Controller
{
    /**
     * Retourne la vue du journal
     *
     * @return View
     */
    public function show() {
        $events = Journal::all();
        /** Récupération des droit de l'utilisateur authentifier pour gérer le menu */
        $userA = Auth::user();
        $respoDI = $userA->estResponsableDI();
        $respoUE = $userA->estResponsableUE();
        return view('di.journal')->with('events', $events)->with('userA', $userA)->with('respoDI', $respoDI)->with('respoUE', $respoUE);
    }

    /**
     * Fonction chargée de la validation d'un élément du journal
     *
     * @param Request $req
     */
    public function accept(Request $req) {
        $validator = Validator::make($req->all(), [
            'id_journal' => 'required|integer',
        ]);

        if (!$validator->fails()) {
            // Vérification de l'éxistence de l'évenement
            $c = Journal::where('id', $req->id_journal)->count();
            if ($c == 1) {
                $event = Journal::where('id', $req->id_journal)->first();
                switch ($event->type) {
                    case 'INSC':
                        $user = User::where('id', $event->id_utilisateur)->first();
                        //TODO : envoyer un mail à l'utilisateur
                        $user->attente_validation = false;
                        $user->save();
                        $event->delete();
                        break;
                }
            }
        }
    }

    /**
     * Fonction chargée de l'annulation d'un élément du journal
     *
     * @param Request $req
     */
    public function deny(Request $req) {
        $validator = Validator::make($req->all(), [
            'id_journal' => 'required|integer',
        ]);

        if (!$validator->fails()) {
            // Vérification de l'éxistence de l'évenement
            $c = Journal::where('id', $req->id_journal)->count();
            if ($c == 1) {
                $event = Journal::where('id', $req->id_journal)->first();
                switch ($event->type) {
                    case 'INSC':
                        $user = User::where('id', $event->id_utilisateur)->first();
                        //TODO : envoyer un mail à l'utilisateur
                        $user->delete();
                        $event->delete();
                        break;
                }
            }
        }
    }
}