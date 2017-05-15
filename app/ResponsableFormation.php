<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponsableFormation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'responsable_formations';

    /**
     * Retourne l'utilisateur associé
     *
     */
    public function user() {
        return $this->belongsTo('App\User', 'id_utilisateur');
    }
}
