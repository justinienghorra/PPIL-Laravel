<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponsableUniteeEnseignement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'responsable_unitee_enseignements';

    /**
     * Retourne l'utilisateur associé
     *
     */
    public function user() {
        return $this->belongsTo('App\User', 'id_utilisateur');
    }
}
