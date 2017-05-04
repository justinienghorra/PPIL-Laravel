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
            // ID en autoincrement
            $table->increment('id');

            // String représentant le statut
            $table->string('statut');
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
