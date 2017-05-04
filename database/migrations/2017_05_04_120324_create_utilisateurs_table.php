<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Création de la table utilisateurs
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->increment('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('civilite');
            $table->string('mail');
            $table->string('hash_MDP');
            $table->string('adresse');
            $table->integer('id_statut');
            $table->boolean('attente_validation');
            $table->integer('prochaine_modif_en_attente');
            $table->date('derniere_modif');

            $table->foreign('id_statut')->references('id')->on('statuts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Destruction de la table utilisateurs
        Schema::drop('utilisateurs', function (Blueprint $table) {
            // Destruction de la clé étrangère sur id de statuts
            $table->dropForeign('id_statut');
        });
    }
}
