<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ajout du responsable DI
        $admin = new User;
        $admin->nom = "Dupont";
        $admin->prenom = "Jean";
        $admin->email = "jean.dupont@gmail.com";
        $admin->password = bcrypt("password");
        $admin->adresse = "45 Rue de la Liberté, 54000 Nancy";
        $admin->civilite = "M";
        $admin->attente_validation = false;
        $admin->id_statut = \App\Statut::where('statut', 'Aucun')->first()->id;
        $admin->save();

        $respDI = new \App\ResponsableDepInfo;
        $respDI->id_utilisateur = User::where('email', "jean.dupont@gmail.com")->first()->id;
        $respDI->save();

        // Ajout d'un utilisateur lambda Respo L1 Info
        $user = new User;
        $user->nom = "Utilisateur";
        $user->prenom = "Lambda";
        $user->email = "utilisateur.lambda@gmail.com";
        $user->password = bcrypt("password");
        $user->adresse = "49 Rue de la Liberté, 54000 Nancy";
        $user->civilite = "M";
        $user->attente_validation = false;
        $user->id_statut = \App\Statut::where('statut', 'Doctorant')->first()->id;
        $user->save();

        // Ajout d'un respo UE Compil
        $user = new User;
        $user->nom = "Respo";
        $user->prenom = "Compil";
        $user->email = "respo.compil@gmail.com";
        $user->password = bcrypt("password");
        $user->adresse = "49 Rue de la Liberté, 54000 Nancy";
        $user->civilite = "M";
        $user->attente_validation = false;
        $user->id_statut = \App\Statut::where('statut', 'Doctorant')->first()->id;
        $user->save();
    }
}
