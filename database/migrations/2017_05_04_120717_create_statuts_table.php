<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Création de la table statuts
        Schema::create('statuts', function(Blueprint $table) {
            // Utilisé par Laravel (Ajoute les champs created_at et updated_at)
            $table->timestamps();

            // ID en autoincrement
            $table->increments('id');

            // String représentant le statut
            $table->string('statut');

            //Volume minimal statutaire
            $table->integer('volumeMin')->unsigned();

            //Volume maximal statutaire
            $table->integer('volumeMax')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Destruction de la table statuts
        Schema::drop('statuts');
    }
}
