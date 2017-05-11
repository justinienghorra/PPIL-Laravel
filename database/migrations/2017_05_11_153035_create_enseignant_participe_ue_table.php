<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnseignantParticipeUeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseignant_participe_ue', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('id_utilisateur')->unsigned();
            $table->foreign('id_utilisateur')->references('id')->on('users');

            $table->integer('id_ue')->unsigned();
            $table->foreign('id_ue')->references('id')->on('unitee_enseignements');

            $table->integer('cm_nb_heures')->unsigned();
            $table->integer('td_nb_heures')->unsigned();
            $table->integer('tp_nb_heures')->unsigned();
            $table->integer('ei_nb_heures')->unsigned();

            $table->integer('td_heures_par_groupe')->unsigned();
            $table->integer('tp_heures_par_groupe')->unsigned();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enseignant_participe_ue', function (Blueprint $table) {
            $table->dropForeign(['id_ue', 'id_utilisateur']);
        });
    }
}
