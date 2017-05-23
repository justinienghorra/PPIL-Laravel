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

    public function getCMNbHeuresAffectees() {
        $nbHeures = 0;

        $nbHeures += $this->cm_nb_heures;

        return $nbHeures;
    }

    public function getEINbHeuresAffectees(){
        $nbHeures = 0;

        $nbHeures += ($this->ei_nb_groupes * $this->ei_heures_par_groupe);

        return $nbHeures;
    }


    public function getTDNbHeuresAffectees(){
        $nbHeures = 0;

        $nbHeures += ($this->td_nb_groupes * $this->td_heures_par_groupe);

        return $nbHeures;
    }


    public function getTPNbHeuresAffectees(){
        $nbHeures = 0;

        $nbHeures += ($this->tp_nb_groupes * $this->tp_heures_par_groupe);

        return $nbHeures;
    }


}
