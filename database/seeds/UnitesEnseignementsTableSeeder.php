<?php

use Illuminate\Database\Seeder;
use App\Formation;
use App\UniteeEnseignement;

class UnitesEnseignementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Ajout de l'UE Compil
        $devmob = new UniteeEnseignement;
        $devmob->nom = "Compilation";
        $devmob->description = "UE de compil";
        $devmob->cm_volume_attendu = 30;
        $devmob->td_volume_attendu = 15;
        $devmob->tp_volume_attendu = 15;
        $devmob->ei_volume_attendu = 0;
        $devmob->td_nb_groupes_attendus = 2;
        $devmob->tp_nb_groupes_attendus = 3;
        $devmob->ei_nb_groupes_attendus = 0;
        $devmob->attente_validation = false;
        $devmob->id_formation = 2;
        $devmob->save();

    	/******************************Dev Mob******************************/
        //Ajout de l'UE
        $devmob = new UniteeEnseignement;
        $devmob->nom = "Développement Mobile";
        $devmob->description = "UE de développement mobile en L3";
        $devmob->cm_volume_attendu = 30;
        $devmob->td_volume_attendu = 30;
        $devmob->tp_volume_attendu = 60;
        $devmob->ei_volume_attendu = 0;
        $devmob->td_nb_groupes_attendus = 2;
        $devmob->tp_nb_groupes_attendus = 3;
        $devmob->ei_nb_groupes_attendus = 0;
        $devmob->attente_validation = false;
        $devmob->id_formation = 2;
        $devmob->save();

		/******************************Algo******************************/

		//Ajout de l'UE
		$algo = new UniteeEnseignement;
		$algo->nom = "Algorithmique 2";
		$algo->description = "UE d'algorithmique 2 en L1";
		$algo->cm_volume_attendu = 0;
		$algo->td_volume_attendu = 60;
		$algo->tp_volume_attendu = 60;
		$algo->ei_volume_attendu = 30;
		$algo->td_nb_groupes_attendus = 2;
		$algo->tp_nb_groupes_attendus = 4;
		$algo->ei_nb_groupes_attendus = 2;
		$algo->attente_validation = false;
		$algo->id_formation = 1;
		$algo->save();

    }
}
