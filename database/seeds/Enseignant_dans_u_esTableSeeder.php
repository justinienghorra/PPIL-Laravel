<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UniteeEnseignement;
use App\EnseignantDansUE;

class Enseignant_dans_u_esTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$enseignantDM1 = new EnseignantDansUE;
		$enseignantDM1->id_ue = UniteeEnseignement::where('nom', 'Développement Mobile')->first()->id;
        $enseignantDM1->id_utilisateur = User::where('prenom', 'RespoUE')->first()->id;
		$enseignantDM1->cm_nb_heures = 30;
		$enseignantDM1->td_nb_groupes = 1;
		$enseignantDM1->tp_nb_groupes = 2;
		$enseignantDM1->ei_nb_groupes = 0;
		$enseignantDM1->td_heures_par_groupe = 15;
		$enseignantDM1->tp_heures_par_groupe = 15;
		$enseignantDM1->ei_heures_par_groupe = 0;
		$enseignantDM1->save();

		$enseignantDM2 = new EnseignantDansUE;
		$enseignantDM2->id_ue = UniteeEnseignement::where('nom', 'Développement Mobile')->first()->id;
        $enseignantDM2->id_utilisateur = User::where('email', 'vacataire.lambda2@gmail.com')->first()->id;
		$enseignantDM2->cm_nb_heures = 0;
		$enseignantDM2->td_nb_groupes = 1;
		$enseignantDM2->tp_nb_groupes = 2;
		$enseignantDM2->ei_nb_groupes = 0;
		$enseignantDM2->td_heures_par_groupe = 15;
		$enseignantDM2->tp_heures_par_groupe = 15;
		$enseignantDM2->ei_heures_par_groupe = 0;
		$enseignantDM2->save();

		$enseignantA1 = new EnseignantDansUE;
		$enseignantA1->id_ue = UniteeEnseignement::where('nom', 'Algorithmique 2')->first()->id;
        $enseignantA1->id_utilisateur = User::where('prenom', 'RespoUE')->first()->id;
		$enseignantA1->cm_nb_heures = 0;
		$enseignantA1->td_nb_groupes = 1;
		$enseignantA1->tp_nb_groupes = 2;
		$enseignantA1->ei_nb_groupes = 1;
		$enseignantA1->td_heures_par_groupe = 30;
		$enseignantA1->tp_heures_par_groupe = 15;
		$enseignantA1->ei_heures_par_groupe = 15;
		$enseignantA1->save();

        $enseignant = new EnseignantDansUE;
        $enseignant->id_ue = UniteeEnseignement::where('nom', 'Algorithmique 2')->first()->id;
        $enseignant->id_utilisateur = 2;
        $enseignant->cm_nb_heures = 0;
        $enseignant->td_nb_groupes = 1;
        $enseignant->tp_nb_groupes = 2;
        $enseignant->ei_nb_groupes = 1;
        $enseignant->td_heures_par_groupe = 30;
        $enseignant->tp_heures_par_groupe = 15;
        $enseignant->ei_heures_par_groupe = 15;
        $enseignant->save();
    }
}
