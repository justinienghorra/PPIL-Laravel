<?php

use Illuminate\Database\Seeder;
use App\Formation;
use App\UniteeEnseignement;
use App\EnseignantDansUE;
use App\ResponsableUniteeEnseignement;

class UnitesEnseignementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/******************************Dev Mob******************************/
    	//Ajout de l'UE
        $devmob = new UniteeEnseignement;
		$devmob->nom = "Développement Mobile";
		$devmob->description = "UE de développement mobile en L3";
		$devmob->cm_volume_attendu = 30;
		$devmob->td_volume_attendu = 15;
		$devmob->td_volume_affecte = 0;
		$devmob->tp_volume_attendu = 15;
		$devmob->tp_volume_affecte = 0;
		$devmob->ei_volume_attendu = 0;
		$devmob->ei_volume_affecte = 0;
		$devmob->td_nb_groupes_attendus = 2;
		$devmob->tp_nb_groupes_attendus = 3;
		$devmob->ei_nb_groupes_attendus = 0;
		$devmob->attente_validation = false;
		$devmob->id_formation = 2;
		$devmob->save();

		//Ajout du respo UE
		$respoUE_DM = new ResponsableUniteeEnseignement;
		$respoUE_DM->id_utilisateur = 3; //utilisatrice PRAG
		$respoUE_DM->id_ue = 1; //devmob
		$respoUE_DM->save();

		//Ajout d'enseignants
		$enseignantDM1 = new EnseignantDansUE;
		$enseignantDM1->id_ue = 1; //devmob
		$enseignantDM1->id_utilisateur = 3; //utilisatrice PRAG
		$enseignantDM1->cm_nb_heures = 30;
		$enseignantDM1->td_nb_groupes = 1;
		$enseignantDM1->tp_nb_groupes = 2;
		$enseignantDM1->ei_nb_groupes = 0;
		$enseignantDM1->td_heures_par_groupe = 15;
		$enseignantDM1->tp_heures_par_groupe = 15;
		$enseignantDM1->ei_heures_par_groupe = 0;
		$enseignantDM1->save();

		$enseignantDM2 = new EnseignantDansUE;
		$enseignantDM2->id_ue = 1; //devmob
		$enseignantDM2->id_utilisateur = 2; //utilisateur doctorant
		$enseignantDM2->cm_nb_heures = 0;
		$enseignantDM2->td_nb_groupes = 1;
		$enseignantDM2->tp_nb_groupes = 2;
		$enseignantDM2->ei_nb_groupes = 0;
		$enseignantDM2->td_heures_par_groupe = 15;
		$enseignantDM2->tp_heures_par_groupe = 15;
		$enseignantDM2->ei_heures_par_groupe = 0;
		$enseignantDM2->save();


		/******************************Algo******************************/

		//Ajout de l'UE
		$algo = new UniteeEnseignement;
		$algo->nom = "Algorithmique 2";
		$algo->description = "UE d'algorithmique 2 en L1";
		$algo->cm_volume_attendu = 0;
		$algo->td_volume_attendu = 30;
		$algo->td_volume_affecte = 0;
		$algo->tp_volume_attendu = 15;
		$algo->tp_volume_affecte = 0;
		$algo->ei_volume_attendu = 15;
		$algo->ei_volume_affecte = 0;
		$algo->td_nb_groupes_attendus = 2;
		$algo->tp_nb_groupes_attendus = 4;
		$algo->ei_nb_groupes_attendus = 2;
		$algo->attente_validation = false;
		$algo->id_formation = 1;
		$algo->save();

		//Ajout du respo UE
		$respoUE_A = new ResponsableUniteeEnseignement;
		$respoUE_A->id_utilisateur = 3; //utilisatrice PRAG
		$respoUE_A->id_ue = 2; //algo
		$respoUE_A->save();

		//Ajout d'enseignants
		$enseignantA1 = new EnseignantDansUE;
		$enseignantA1->id_ue = 2; //algo
		$enseignantA1->id_utilisateur = 3; //utilisatrice PRAG
		$enseignantA1->cm_nb_heures = 0;
		$enseignantA1->td_nb_groupes = 1;
		$enseignantA1->tp_nb_groupes = 1;
		$enseignantA1->ei_nb_groupes = 1;
		$enseignantA1->td_heures_par_groupe = 30;
		$enseignantA1->tp_heures_par_groupe = 15;
		$enseignantA1->ei_heures_par_groupe = 15;
		$enseignantA1->save();
    }
}
