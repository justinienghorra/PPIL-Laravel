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
    }
}
