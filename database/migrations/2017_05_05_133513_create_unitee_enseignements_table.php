<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniteeEnseignementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unitee_enseignements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('nom');
            $table->string('description');

            $table->integer('cm_volume_attendu')->unsigned();
            $table->integer('td_volume_attendu')->unsigned();
            $table->integer('tp_volume_attendu')->unsigned();
            $table->integer('ei_volume_attendu')->unsigned();

            $table->integer('td_nb_groupes_attendus')->unsigned();
            $table->integer('tp_nb_groupes_attendus')->unsigned();
            $table->integer('ei_nb_groupes_attendus')->unsigned();


            $table->boolean('attente_validation');
            $table->date('date_derniere_modif');

            $table->integer('id_formation')->unsigned();
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
        Schema::dropIfExists('unitee_enseignements', function(Blueprint $table) {
            $table->dropForeign(['id_formation']);
        });
    }
}
