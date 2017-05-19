<?php

use App\ResponsableUniteeEnseignement;
use App\Statut;
use App\UniteeEnseignement;
use App\User;
use Illuminate\Database\Seeder;

class Responsable_unitee_enseignementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ajout respo Compil
        $respoUE = new ResponsableUniteeEnseignement();
        $respoUE->id_utilisateur = User::where('prenom', 'Compil')->first()->id;
        $respoUE->id_ue = UniteeEnseignement::where('nom', 'Compilation')->first()->id;
        $respoUE->save();


        //Ajout respo algo
        $respoUE_A = new ResponsableUniteeEnseignement;
        $respoUE_A->id_utilisateur = User::where('prenom', 'RespoUE')->first()->id;
        $respoUE_A->id_ue = UniteeEnseignement::where('nom', 'Algorithmique 2')->first()->id;
        $respoUE_A->save();

        //Ajout respo devmob
        $respoUE_DM = new ResponsableUniteeEnseignement;
        $respoUE_DM->id_utilisateur = User::where('prenom', 'RespoUE')->first()->id;
        $respoUE_DM->id_ue = UniteeEnseignement::where('nom', 'Développement Mobile')->first()->id;
        $respoUE_DM->save();
    }
}