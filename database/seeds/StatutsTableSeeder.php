<?php

use Illuminate\Database\Seeder;
use App\Statut;
use App\ServiceStatutaire;

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
        $s->volumeMin = 192;
        $s->volumeMax = 192;
        $s->save();
        $s = new Statut;
        $s->statut = '1/2 ATER';
        $s->volumeMin = 96;
        $s->volumeMax = 96;
        $s->save();
        $s = new Statut;
        $s->statut = 'PRAG';
        $s->volumeMin = 384;
        $s->volumeMax = 768;
        $s->save();
        $s = new Statut;
        $s->statut = 'Enseignant chercheur';
        $s->volumeMin = 192;
        $s->volumeMax = 384;
        $s->save();
        $s = new Statut;
        $s->statut = 'Doctorant';
        $s->volumeMin = 64;
        $s->volumeMax = 64;
        $s->save();
        $s = new Statut;
        $s->statut = 'Vacataire';
        $s->volumeMin = 0;
        $s->volumeMax = 96;
        $s->save();
        $s = new Statut;
        $s->statut = 'Aucun';
        $s->volumeMin = 0;
        $s->volumeMax = 0;
        $s->save();

    }
}
