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
                                ->join('unitee_enseignements', 'enseignant_dans_u_es.id_ue', 'unitee_enseignements.id')
                                ->select('unitee_enseignements.nom as nomUE', 'unitee_enseignements.*', 'enseignant_dans_u_es.*',
                                    'users.*')
                                ->get();
    }

    public function user() {
        return $this->belongsTo('App\User', 'id_utilisateur');
    }

    public function enseignement() {
        return $this->belongsTo('App\UniteeEnseignement', 'id_ue');
    }

    public static function getVolumeAffectee($id_ue)
    {
        return EnseignantDansUE::where('id_ue', $id_ue)
            ->select('SUM(ei_heures_par_groupe) as ei_volume_affecte', 'SUM(cm_nb_heures) as cm_volume_affecte',
                'SUM(td_heures_par_groupe) as td_volume_affecte', 'SUM(tp_heures_par_groupe) as tp_volume_affecte')
            ->get();
    }

}
