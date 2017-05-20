<?php

use Illuminate\Database\Seeder;

class DefaultPhotoRespDIProduction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photo = new Photo;
        $photo->adresse = "/var/www/public/images/default.jpg";
        $photo->id_utilisateur = 1;
        $photo->save();
    }
}
