<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Photos;
use App\Statut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Validation\Rule;
use Validator;

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

        $civilite = User::select('civilite')->where('id', '=', $user->id)->first();
        if ($civilite->civilite == "M") $civilites = array("M" => "M","Mme" => "Mme");
        else $civilites = array("Mme" => "Mme", "M" => "M");

        $photoUrl =  Photos::where('id_utilisateur', $user->id)->first();
        $tmp = null;

        if ($photoUrl != null){
            $url = $photoUrl->adresse;
            $tmp = explode("images", $url);
        }
        
        $respoDI = $user->estResponsableDI();
        $respoUE = $user->estResponsableUE();


        //TODO : modifier la vue en consequence avec le parametre (email deja change)
        return view('profil')
            ->with('user', $user)
            ->with('statuts', $statuts)
            ->with('civilites', $civilites)
            ->with('photoUrl', $tmp[1])
            ->with('respoDI', $respoDI)
            ->with('respoUE', $respoUE);
    }



    public static function getStatut(){
        $user = Auth::user();

        $statut = Statut::select('statut')->where('id', '=', $user->id_statut)->first();

        return $statut->statut;
    }






    public function postEmail(Request $request){
        $user = Auth::user();

        $user->updateEmail($request->input('email'));
    }





    public function postUpdateInformations(Request $request) {

        // Authentification de l'utilisateur
        $user = Auth::user();

        // Validation des champs
        $validator = Validator::make($request->all(), [
            'nom' => 'string|max:255|alpha',
            'prenom' => 'string|max:255|alpha',
            'statut' => 'string', Rule::in(["ATER", "PRAG", "Enseignant chercheur", "Doctorant", "Vacataire", "Aucun"]),
            'civilite' => 'string', Rule::in(["M", "Mme"]),
            'adresse' => 'string|max:255',
            'email' => 'string|email|max:255'
        ]);

        // Si la verification a echoue
        if ($validator->fails()) {
            //  return redirect('profil/test')->withErrors($validator);
            dd($validator->messages());
            die;

            // Faire un renvoi sur la page de profil
            // en affichant un message d'erreur


        }
        else {


            // Mise a jour des champs
            $user->updateNom($request->input('nom'));
            $user->updatePrenom($request->input('prenom'));
            $user->updateStatut($request->input('statut') + 1);
            $user->updateCivilite($request->input('civilite'));
            $user->updateAdresse($request->input('adresse'));
            $user->updateEmail($request->input('email'));


            // Redirection sur le profil
            // !!! Mettre un message de validation !!!
            return redirect('profil');

        }
    }








    public function postPassword(Request $request){
        //TODO : mettre un beau message sur la vue
        if ($request->input('password') != $request->input('check_password')){

            return redirect('profil')->with('password_message', 'Les deux mot de passe entrés sont différents');

        }else {

            $user = Auth::user();
            $user->updatePassword(bcrypt($request->input('password')));

            return redirect('profil')->with('password_message', 'Mot de passe modifié avec succé');
        }
    }



    public function postImage(Request $request){

        //TODO : modifier le bouton parcourir de la vue

        $user = Auth::user();
        $file = Input::file('image');

        $infos = pathinfo($file->getClientOriginalName());
        $extension = $infos['extension'];


        if ($extension == 'png' || $extension == 'jpg'){

            //on supprime l'ancienne adresse de l'image
            Photos::where('id_utilisateur', $user->id)->delete();

            //stocke l'adresse de l'image dans la BDD
            Photos::creerImage(public_path().'/images/user_'.$user->id.'/profil.' . $extension, $user->id);

            // stocke l'image
            $file->move(public_path().'/images/user_'.$user->id, 'profil.' . $extension);

            $photoUrl =  Photos::where('id_utilisateur', $user->id)->first()->adresse;
            $tmp = explode("images", $photoUrl);

            return redirect('profil')->with('image_message', 'Image modifiée')->with('photoUrl', $tmp[1]);

        } else{

            return redirect('profil')->with('image_message', 'Format du fichier invalide: "' . $extension . '"');
        }
    }
}
