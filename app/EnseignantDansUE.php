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


    public function user() {
        return $this->belongsTo('App\User', 'id_utilisateur');
    }

    public function enseignement() {
        return $this->belongsTo('App\UniteeEnseignement', 'id_ue');
    }



}
