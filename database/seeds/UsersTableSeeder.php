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

        // Ajout d'utilisateurs lambda
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

        $praglambda = new User;
        $praglambda->nom = "Prag";
        $praglambda->prenom = "RespoUE";
        $praglambda->email = "respoue@gmail.com";
        $praglambda->password = bcrypt("password");
        $praglambda->adresse = "51 Rue de la Liberté, 54000 Nancy";
        $praglambda->civilite = "F";
        $praglambda->attente_validation = false;
        $praglambda->id_statut = \App\Statut::where('statut', 'PRAG')->first()->id;
        $praglambda->save();
        
        $vacalambda = new User;
        $vacalambda->nom = "Vacataire";
        $vacalambda->prenom = "Lambda";
        $vacalambda->email = "vacataire.lambda2@gmail.com";
        $vacalambda->password = bcrypt("password");
        $vacalambda->adresse = "53 Rue de la Liberté, 54000 Nancy";
        $vacalambda->civilite = "M";
        $vacalambda->attente_validation = false;
        $vacalambda->id_statut = \App\Statut::where('statut', 'Vacataire')->first()->id;
        $vacalambda->save();

        $aterlambda = new User;
        $aterlambda->nom = "Ater";
        $aterlambda->prenom = "Lambda";
        $aterlambda->email = "ater.lambda@gmail.com";
        $aterlambda->password = bcrypt("password");
        $aterlambda->adresse = "55 Rue de la Liberté, 54000 Nancy";
        $aterlambda->civilite = "F";
        $aterlambda->attente_validation = false;
        $aterlambda->id_statut = \App\Statut::where('statut', 'ATER')->first()->id;
        $aterlambda->save();
    }
}
