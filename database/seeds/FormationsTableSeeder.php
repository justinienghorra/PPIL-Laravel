<?php

use Illuminate\Database\Seeder;

class FormationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $formation = new \App\Formation;
        $formation->nom = "L1 Informatique";
        $formation->description = "Trop cool";
        $formation->save();

        $resp = new \App\ResponsableFormation();
        $resp->id_formation = $formation->id;
        $resp->id_utilisateur = \App\User::where('email', 'utilisateur.lambda@gmail.com')->first()->id;
        $resp->save();
		
		$l3 = new \App\Formation;
		$l3->nom = "L3 Informatique";
		$l3->description = "Trop pas ouf";
		$l3->save();
		
		$respl3 = new \App\ResponsableFormation();
		$respl3->id_formation = $formation->id;
        $respl3->id_utilisateur = \App\User::where('email', 'utilisateur.lambda@gmail.com')->first()->id;
		$respl3->save();
		
    }
}
