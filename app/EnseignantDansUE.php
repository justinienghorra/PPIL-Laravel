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
}
