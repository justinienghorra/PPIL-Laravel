<?php

use Illuminate\Database\Seeder;

class CreateRespDIProduction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->nom = "Dupont";
        $admin->prenom = "Jean";
        $admin->email = "jean.dupont@gmail.com";
        $admin->password = bcrypt("ppil-l3-resp-di-1664");
        $admin->adresse = "45 Rue de la Liberté, 54000 Nancy";
        $admin->civilite = "M.";
        $admin->attente_validation = false;
        $admin->id_statut = \App\Statut::where('statut', 'Aucun')->first()->id;
        $admin->save();

        $respDI = new \App\ResponsableDepInfo;
        $respDI->id_utilisateur = User::where('email', "jean.dupont@gmail.com")->first()->id;
        $respDI->save();
    }
}
