<?php

use Illuminate\Database\Seeder;
use App\Formation;

class UnitesEnseignementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ue1 = new App\UniteeEnseignement;
        $ue1->nom = "Développement Mobile";
        $ue1->description = "UE de devmob";
        $ue1->cm_volume_attendu = 30;
        $ue1->td_volume_attendu = 15;
        $ue1->td_volume_affecte = 0;
        $ue1->tp_volume_attendu = 15;
        $ue1->tp_volume_affecte = 0;
        $ue1->ei_volume_attendu = 0;
        $ue1->ei_volume_affecte = 0;
        $ue1->td_nb_groupes_attendus = 2;
        $ue1->tp_nb_groupes_attendus = 3;
        $ue1->ei_nb_groupes_attendus = 0;
        $ue1->attente_validation = false;
        $ue1->id_formation = Formation::where('nom', 'L3 Informatique')->first()->id;
        $ue1->save();

        $ue1 = new App\UniteeEnseignement;
        $ue1->nom = "Compilation";
        $ue1->description = "UE de compil";
        $ue1->cm_volume_attendu = 30;
        $ue1->td_volume_attendu = 15;
        $ue1->td_volume_affecte = 0;
        $ue1->tp_volume_attendu = 15;
        $ue1->tp_volume_affecte = 0;
        $ue1->ei_volume_attendu = 0;
        $ue1->ei_volume_affecte = 0;
        $ue1->td_nb_groupes_attendus = 2;
        $ue1->tp_nb_groupes_attendus = 3;
        $ue1->ei_nb_groupes_attendus = 0;
        $ue1->attente_validation = false;
        $ue1->id_formation = Formation::where('nom', 'L1 Informatique')->first()->id;
        $ue1->save();

        $ue1 = new App\UniteeEnseignement;
        $ue1->nom = "PPIL";
        $ue1->description = "PPIL";
        $ue1->cm_volume_attendu = 30;
        $ue1->td_volume_attendu = 15;
        $ue1->td_volume_affecte = 0;
        $ue1->tp_volume_attendu = 15;
        $ue1->tp_volume_affecte = 0;
        $ue1->ei_volume_attendu = 0;
        $ue1->ei_volume_affecte = 0;
        $ue1->td_nb_groupes_attendus = 2;
        $ue1->tp_nb_groupes_attendus = 3;
        $ue1->ei_nb_groupes_attendus = 0;
        $ue1->attente_validation = false;
        $ue1->id_formation = Formation::where('nom', 'L1 Informatique')->first()->id;
        $ue1->save();
    }
}
