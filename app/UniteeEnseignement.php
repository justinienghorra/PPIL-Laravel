<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniteeEnseignement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'unitee_enseignements';

    /**
     * Retourne le responsable de l'ue
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function responsable() {
        return $this->hasOne('App\ResponsableUniteeEnseignement', 'id_ue');
    }

    /**
     * Retourne faux si l'ue n'a pas de responsable
     *
     * @return bool
     */
    public function hasResponsable() {
        return $this->responsable != null;
    }
	
}
