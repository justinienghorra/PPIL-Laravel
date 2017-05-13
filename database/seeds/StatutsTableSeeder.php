<?php

use Illuminate\Database\Seeder;
use App\Statut;

class StatutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s = new Statut;
        $s->statut = 'ATER';
        $s->save();
        $s = new Statut;
        $s->statut = 'PRAG';
        $s->save();
        $s = new Statut;
        $s->statut = 'Enseignant chercheur';
        $s->save();
        $s = new Statut;
        $s->statut = 'Doctorant';
        $s->save();
        $s = new Statut;
        $s->statut = 'Vacataire';
        $s->save();
        $s = new Statut;
        $s->statut = 'Aucun';
        $s->save();
    }
}
