<?php

use Illuminate\Database\Seeder;
use App\Photos;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photo_user_3 = new Photos;
        $photo_user_3->adresse = "/var/www/public/images/user_3/profil.png";
        $photo_user_3->id_utilisateur = 3;
        $photo_user_3->save();
    }
}
