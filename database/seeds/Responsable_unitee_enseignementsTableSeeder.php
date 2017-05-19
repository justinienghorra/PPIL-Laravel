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
    }
}
