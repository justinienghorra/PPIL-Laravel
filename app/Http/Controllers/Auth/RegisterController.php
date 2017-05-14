<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Journal;
use App\Statut;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;

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
    protected $redirectTo = '/en_attente';

    protected $statut_array;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->statut_array = array();
        foreach (Statut::select('statut')->cursor() as $statut) {
            array_push($this->statut_array, $statut->statut);
        }
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
            'civilite' => ['required', 'string', Rule::in(["M", "Mme"]) ],
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'adresse' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',

            'statut' => ['required', 'string', Rule::in($this->statut_array)]
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
        $event = new Journal;
        $event->type = "INSC";

        $user =  User::create([
            'civilite' => $data['civilite'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'adresse' => $data['adresse'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),

            // TODO Gérer l'attente de validation
            'attente_validation' => true,

            'id_statut' => Statut::where('statut', $data['statut'])->first()->id,
        ]);

        $event->id_utilisateur = $user->id;
        $event->save();

        return $user;
    }

    /**
     *
     * Surcharge de la méthode register pour éviter l'autologin après inscription
     *
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
