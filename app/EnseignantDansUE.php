<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnseignantDansUE extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'enseignant_dans_u_es';

    public static function getEnseignantsDansUE($id_ue){
        return EnseignantDansUE::where('id_ue', $id_ue)
                                ->join('users', 'enseignant_dans_u_es.id_utilisateur', 'users.id')
                                ->get();
    }

    public function user() {
        return $this->belongsTo('App\User', 'id_utilisateur');
    }

    public function enseignement() {
        return $this->belongsTo('App\UniteeEnseignement', 'id_ue');
    }
}
