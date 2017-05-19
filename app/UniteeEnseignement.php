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

     * Retourne faux si l'UE n'a pas de responsable
     *
     * @return bool
     */
    public function hasResponsable() {
        return $this->responsable != null;
    }

    public function enseignants() {
        return $this->hasMany('App\EnseignantDansUE', 'id_ue');
    }

    public function getCMNbHeuresAffectees() {
        $nbHeures = 0;
        foreach ($this->enseignants as $enseignant) {
            $nbHeures += $enseignant->cm_nb_heures;
        }
        return $nbHeures;
    }

    public function getEINbHeuresAffectees(){
        $nbHeures = 0;
        foreach ($this->enseignants as $enseignant) {
            $nbHeures += ($enseignant->ei_nb_groupes * $enseignant->ei_heures_par_groupe);
        }
        return $nbHeures;
    }


    public function getTDNbHeuresAffectees(){
        $nbHeures = 0;
        foreach ($this->enseignants as $enseignant) {
            $nbHeures += ($enseignant->td_nb_groupes * $enseignant->td_heures_par_groupe);
        }
        return $nbHeures;
    }


    public function getTPNbHeuresAffectees(){
        $nbHeures = 0;
        foreach ($this->enseignants as $enseignant) {
            $nbHeures += ($enseignant->tp_nb_groupes * $enseignant->tp_heures_par_groupe);
        }
        return $nbHeures;
    }

}
