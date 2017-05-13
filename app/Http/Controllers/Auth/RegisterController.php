<?php

namespace App\Http\Controllers\Auth;

use App\Statuts;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // TODO : Rediriger vers la page de profil
    protected $redirectTo = '/profil';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // TODO : Vérifier que civilité = M ou Mme (Voir doc Validator)
            'civilite' => 'required|string|max:3',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'adresse' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',

            // TODO : Vérifier que le statut est correct
            'statut' => 'required|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'civilite' => $data['civilite'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'adresse' => $data['adresse'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),

            // TODO Gérer l'attente de validation
            'attente_validation' => false,

            'id_statut' => Statuts::where('statut', $data['statut'])->first()->id,
        ]);
    }
}
