<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     *
     * @return User
     */
    protected $table = 'formations';

    /**
     * Retourne le responsable de la formation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function responsable() {
        return $this->hasOne('App\ResponsableFormation', 'id_formation');
    }

    /**
     * Retourne faux si la formation n'a pas de responsable
     *
     * @return bool
     */
    public function hasResponsable() {
        return $this->responsable != null;
    }


}
