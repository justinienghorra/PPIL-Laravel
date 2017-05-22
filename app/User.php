<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'email', 'password', 'prenom', 'adresse', 'civilite', 'attente_validation', 'id_statut',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Retourne vrai si l'utilisateur est responsable DI
     *
     * @return boolean
     */
    public function estResponsableDI() {
        $res = ResponsableDepInfo::where('id_utilisateur', $this->id)->count();
        return $res > 0;
    }

    /**
     * Retourne vrai si l'utilisateur est responsable de la Formation $nom_formation
     *
     * @return boolean
     */
    public function estResponsableFormation($nom_formation) {
        $id_formation = Formation::where('nom', '=', $nom_formation)->first();


        if(is_null($id_formation)){
            return false;
        }

        $id_formation = $id_formation->id;

        $res = ResponsableFormation::where('id_utilisateur', '=', $this->id)->where('id_formation', '=', $id_formation)->count();

        return $res > 0;
    }
    
    public function estResponsableForm() {
        $res = ResponsableFormation::where('id_utilisateur', '=', $this->id)->count();
        return $res > 0;
    }


    public function estResponsableUE() {
        $res = ResponsableUniteeEnseignement::where('id_utilisateur', '=', $this->id)->count();
        return $res > 0;
    }

    /**
     * Retourne le statut
     *
     * @return string
     */
    public function statut() {
        return Statut::where('id', $this->id_statut)->first()->statut;
    }






    public function updatePrenom($prenom) {
        User::where('id', $this->id)->update(['prenom' => $prenom]);
    }



    public function updateNom($nom) {
        User::where('id', $this->id)->update(['nom' => $nom]);
    }



    public function updateStatut($statut) {
        User::where('id', $this->id)->update(['id_statut' => $statut]);
    }



    public function updateCivilite($civilite) {
        User::where('id', $this->id)->update(['civilite' => $civilite]);
    }



    public function updateAdresse($adresse) {
        User::where('id', $this->id)->update(['adresse' => $adresse]);
    }



    public function updateEmail($email) {
        User::where('id', $this->id)->update(['email' => $email]);
    }



    public function updatePassword($password) {
        User::where('id', $this->id)->update(['password' => $password]);
    }


    public function enseignantDansUEs() {
        return $this->hasMany('App\EnseignantDansUE', 'id_utilisateur');
    }

    public function enseignantDansUEsExterne() {
        return $this->hasMany('App\EnseignantDansUEExterne', 'id_utilisateur');
    }

    public function photo() {
        return $this->hasOne('App\Photos', 'id_utilisateur');
    }

    public function formations() {
        return $this->hasMany('App\ResponsableFormation', 'id_utilisateur');
    }
}
