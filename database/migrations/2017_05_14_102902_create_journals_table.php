<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            // Type de l'évenement (Inscription, ajout UE, ajout formation...)
            // id_utilisateur
            // id_ue
            // id_formation

            $table->string('type'); // "INSC", "ADD_UE" ...
            $table->integer('id_utilisateur')->nullable()->unsigned();
            $table->integer('id_ue')->nullable()->unsigned();
            $table->integer('id_formation')->nullable()->unsigned();

            $table->foreign('id_utilisateur')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_ue')->references('id')->on('unitee_enseignements');
            $table->foreign('id_formation')->references('id')->on('formations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journals', function (Blueprint $table) {
            $table->dropForeign(['id_utilisateur', 'id_ue', 'id_formation']);
        });
    }
}
