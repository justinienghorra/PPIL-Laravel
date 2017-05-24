<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Photos;
use App\Statut;
use App\EnseignantDansUE;
use App\EnseignantDansUEExterne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Validation\Rule;
use Validator;
use \Hash;

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


    /**
     * Affiche la vue du profil
     * @return $this
     */
    public function show(){


        /** Récupération des droit de l'utilisateur authentifié pour gérer le menu */
        $userA = Auth::user();
        $respoDI = $userA->estResponsableDI();
        $respoUE = $userA->estResponsableUE();
        $respoForm = $userA->estResponsableForm();

        $photoUrl = Photos::where('id_utilisateur', $userA->id)->first();
        $statuts = Statut::all();
        $civilite = User::select('civilite')->where('id', '=', $userA->id)->first();

        if ($civilite->civilite == "M.") $civilites = array("M." => "M.","Mme" => "Mme");
        else $civilites = array("Mme" => "Mme", "M." => "M.");

        $photoUrl =  Photos::where('id_utilisateur', $userA->id)->first();
        $tmp = null;

        if ($photoUrl != null){
            $url = $photoUrl->adresse;
            $tmp = explode("images", $url);
        }

        $statuts = Statut::all();
        $uesUserA = EnseignantDansUE::where('id_utilisateur', $userA->id)->get();
        $uesExUserA = EnseignantDansUEExterne::where('id_utilisateur', $userA->id)->get();
        $heurestotals = 0;

        foreach ($uesUserA as $ue) {

            $heurestotals = $heurestotals + $ue->cm_nb_heures*1.5 + ($ue->td_nb_groupes*$ue->td_heures_par_groupe)
                + ($ue->tp_nb_groupes*$ue->tp_heures_par_groupe)*1.5
                + ($ue->ei_nb_groupes*$ue->ei_heures_par_groupe)*1.25;
        }
        
        foreach ($uesExUserA as $ue) {

            $heurestotals = $heurestotals + $ue->cm_nb_heures*1.5 + ($ue->td_nb_groupes*$ue->td_heures_par_groupe)
                + ($ue->tp_nb_groupes*$ue->tp_heures_par_groupe)*1.5
                + ($ue->ei_nb_groupes*$ue->ei_heures_par_groupe)*1.25;
        }

	    if ($this->getStatutVolumeMin() > 0) {
	    $pourcentage = ($heurestotals / $this->getStatutVolumeMin())*100;

           if ($pourcentage > 100){
                $pourcentage = 100;
           }
        }
        else {
	        $pourcentage = 100;
        }


        return view('profil')
            ->with('userA', $userA)
            ->with('statuts', $statuts)
            ->with('civilites', $civilites)
            ->with('photoUrl', $tmp[1])
            ->with('respoDI', $respoDI)
            ->with('respoUE', $respoUE)
            ->with('respoForm', $respoForm)
            ->with('heuresTotals', $heurestotals)
            ->with('pourcentage', $pourcentage);
    }



    public static function getStatut(){
        $user = Auth::user();
        $statut = Statut::select('statut')->where('id', '=', $user->id_statut)->first();

        return $statut->statut;
    }

    public static function getStatutVolumeMin(){
        $user = Auth::user();
        $statut = Statut::select('volumeMin')->where('id', '=', $user->id_statut)->first();

        return $statut->volumeMin;
    }



    public function postEmail(Request $request){
        $user = Auth::user();
        $user->updateEmail($request->input('email'));
    }


    /**
     * Met à jour les informations personnelles
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdateInformations(Request $request) {

        // Authentification de l'utilisateur
        $user = Auth::user();

        // Validation des champs
        $validator = Validator::make($request->all(), [
            'nom' => 'string|max:255|alpha',
            'prenom' => 'string|max:255|alpha',
            'statut' => 'string', Rule::in(["ATER", "PRAG", "Enseignant chercheur", "Doctorant", "Vacataire", "Aucun"]),
            'civilite' => 'string', Rule::in(["M.", "Mme"]),
            'adresse' => 'string|max:255',
            'email' => 'string|email|max:255'
        ]);

        // Si la verification a echoue
        if ($validator->fails()) {
            $messages = "Impossible de modifier vos informations, un des champs spécifiés n'est pas valide.";
            return redirect('profil')
                ->with('messages', $messages);
        }
        else {

            // Mise a jour des champs
            $user->updateNom($request->input('nom'));
            $user->updatePrenom($request->input('prenom'));
            $user->updateStatut($request->input('statut') + 1);
            $user->updateCivilite($request->input('civilite'));
            $user->updateAdresse($request->input('adresse'));
            $user->updateEmail($request->input('email'));

            $messages = "Informations modifiées avec succès.";

            return redirect('profil')
                ->with('messages', $messages);
        }
    }





    /**
     * Met à jour le password dans la BDD
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function postPassword(Request $request) {

        $user = Auth::user();

        // validation pour un type String et une longueur minimale de 6 caracteres
        $validator = Validator::make($request->all(), [
            'password' => 'string|min:6',
            'check_password' => 'string|min:6'
        ]);

        if ( ! Hash::check($request['old_password'], $user->password) ) {
            
            return redirect('profil')->with('messages', 'L\'ancien mot de passe entré est faux.');
        }
        else if ($request->input('password') != $request->input('check_password')) {

            return redirect('profil')->with('messages', 'Les deux mot de passe entrés sont différents.');
        }
        else if ($validator->fails()) {

            return redirect('profil')->with('messages', 'Votre mot de passe doit comporter 6 caractères au minimum.');
        }
        else {


            $user->updatePassword(bcrypt($request->input('password')));
            $messages = "Mot de passe modifié avec succès.";

            return redirect('profil')
                ->with('messages', $messages);;
        }
    }


    /**
     * Sauvegarde de l'image importee sur le serveur et
     * de l'adresse où est stocker l'image
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function postImage(Request $request){

        //TODO : modifier le bouton parcourir de la vue

        $user = Auth::user();
        $file = Input::file('image');

        $infos = pathinfo($file->getClientOriginalName());
        $extension = $infos['extension'];

        //recupere l'adresse de l'ancienne photo si elle existe
        $anciennePhoto = Photos::where('id_utilisateur', $user->id)->first();

        if ($anciennePhoto != null){
            //on supprime l'ancienne adresse de l'image
            Photos::where('id_utilisateur', $user->id)->delete();

            $tmp = explode("images", $anciennePhoto->adresse);

            //on delete l'ancienne photo de profil
            \File::delete('images' . $tmp[1]);
        }


        if ($extension == 'png' || $extension == 'jpg'){

            //stocke l'adresse de l'image dans la BDD
            Photos::creerImage(public_path().'/images/user_'.$user->id.'/profil.' . $extension, $user->id);

            // stocke l'image
            $file->move(public_path().'/images/user_'.$user->id, 'profil.' . $extension);

            $photoUrl =  Photos::where('id_utilisateur', $user->id)->first()->adresse;
            $tmp = explode("images", $photoUrl);
            $messages = "Photographie de profil modifiée avec succès";

            return redirect('profil')
                ->with('photoUrl', $tmp[1])
                ->with('messages', $messages);
        }
        else {

            return redirect('profil')
                ->with('messages', 'Format du fichier invalide: "' . $extension . '"');
        }
    }
}
