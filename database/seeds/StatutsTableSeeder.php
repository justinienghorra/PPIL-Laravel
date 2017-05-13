<?php

use Illuminate\Database\Seeder;
use App\Statuts;

class StatutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s = new Statuts;
        $s->statut = 'ATER';
        $s->save();
        $s = new Statuts;
        $s->statut = 'PRAG';
        $s->save();
        $s = new Statuts;
        $s->statut = 'Enseignant chercheur';
        $s->save();
        $s = new Statuts;
        $s->statut = 'Doctorant';
        $s->save();
        $s = new Statuts;
        $s->statut = 'Vacataire';
        $s->save();
        $s = new Statuts;
        $s->statut = 'Aucun';
        $s->save();
    }
}
