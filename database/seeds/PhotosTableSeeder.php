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
        $photo_user_1 = new Photos;
        $photo_user_1->adresse = "/var/www/public/images/default.jpg";
        $photo_user_1->id_utilisateur = 1;
        $photo_user_1->save();
        
        $photo_user_2 = new Photos;
        $photo_user_2->adresse = "/var/www/public/images/user_2/profil.jpg";
        $photo_user_2->id_utilisateur = 2;
        $photo_user_2->save();
        
        $photo_user_3 = new Photos;
        $photo_user_3->adresse = "/var/www/public/images/user_3/profil.png";
        $photo_user_3->id_utilisateur = 3;
        $photo_user_3->save();
    }
}
