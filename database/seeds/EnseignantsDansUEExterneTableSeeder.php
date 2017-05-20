<?php

use App\EnseignantDansUEExterne;
use Illuminate\Database\Seeder;

class EnseignantsDansUEExterneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ajout UE externe pour User 2
        $ue_externe = new EnseignantDansUEExterne;
        $ue_externe->nom = 'BDD 2';
        $ue_externe->description = 'UE de base de données en L2';

        $ue_externe->nom_formation = 'L2 Informatique';

        $ue_externe->cm_nb_heures = 15;

        $ue_externe->td_nb_groupes = 2;
        $ue_externe->tp_nb_groupes = 1;
        $ue_externe->ei_nb_groupes = 0;

        $ue_externe->td_heures_par_groupe = 10;
        $ue_externe->tp_heures_par_groupe = 10;
        $ue_externe->ei_heures_par_groupe = 5;

        $ue_externe->id_utilisateur = 2;

        $ue_externe->save();
    }
}
