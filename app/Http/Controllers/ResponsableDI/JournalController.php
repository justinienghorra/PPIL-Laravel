<?php


namespace App\Http\Controllers\ResponsableDI;


use App\Http\Controllers\Controller;
use App\Journal;
use App\Notification;
use App\User;
use App\Photos;
use Illuminate\Http\Response;
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
        $respoForm = $userA->estResponsableForm();
        $photoUrl =  Photos::where('id_utilisateur', $userA->id)->first();
        $tmp = null;

        if ($photoUrl != null){
            $url = $photoUrl->adresse;
            $tmp = explode("images", $url);
        }
        return view('di.journal')->with('events', $events)->with('userA', $userA)->with('photoUrl', $tmp[1])->with('respoDI', $respoDI)->with('respoForm', $respoForm)->with('respoUE', $respoUE);
    }

    /**
     * Fonction chargée de la validation d'un élément du journal
     *
     * @param Request $req
     * @return Response
     *
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
                        $photo = new Photos;
                        $photo->adresse = "/var/www/public/images/default.jpg";
                        $photo->id_utilisateur = $user->id;
                        $photo->save();
                        $event->delete();

                        $di = Auth::user();

                        $messageNotif = "Votre inscription a été validée par le Responsable : ".$user->prenom." ".$user->nom;
                        Notification::createNotification($messageNotif, $user->id, $di->id);


                        break;
                }
            }
        } else {
            $messages = array();
            $messages['message'] = "errors";
            $messages['errors'] = $validator->errors();
            return response()->json($messages);
        }

        $messages = array();
        $messages['message'] = "success";
        return response()->json($messages);
    }

    /**
     * Fonction chargée de l'annulation d'un élément du journal
     *
     * @param Request $req
     *
     * @return Response
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
        } else {
            $messages = array();
            $messages['message'] = "errors";
            $messages['errors'] = $validator->errors();
            return response()->json($messages);
        }

        $messages = array();
        $messages['message'] = "success";
        return response()->json($messages);
    }
}