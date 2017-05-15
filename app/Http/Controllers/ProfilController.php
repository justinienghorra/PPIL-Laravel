<?php

namespace App\Http\Controllers;

use App\Statut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
        $user = Auth::user();

        $user->updateEmail($request->input('email'));
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
        $file = Input::file('image');

        $extension = \File::extension($file->getClientOriginalExtension());
        $extension = strtolower($extension);

        //if ($extension == 'png' || $extension == 'jpg'){
            $user = Auth::user();
            //$file = $request->input('image');
            //$file = Input::file('image');
            $file->move(public_path().'/images/user_'.$user->id, 'profil.jpg');

            return redirect('profil')->with('image_message', 'Image modifiée' . $extension);
        /*} else{
            return redirect('profil')->with('image_message', 'Format du fichier invalide: ' . $extension);
        }*/
    }
}
