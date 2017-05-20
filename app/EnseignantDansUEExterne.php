<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnseignantDansUEExterne extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'enseignant_dans_u_e_externes';

    public function user() {
        return $this->belongsTo('App\User', 'id_utilisateur');
    }
}
