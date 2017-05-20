<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnseignantDansUEExternesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseignant_dans_u_e_externes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('nom');
            $table->string('description');

            $table->string('nom_formation');

            $table->integer('cm_nb_heures')->unsigned()->default(0);

            $table->integer('td_nb_groupes')->unsigned()->default(0);
            $table->integer('tp_nb_groupes')->unsigned()->default(0);
            $table->integer('ei_nb_groupes')->unsigned()->default(0);

            $table->integer('td_heures_par_groupe')->unsigned()->default(0);
            $table->integer('tp_heures_par_groupe')->unsigned()->default(0);
            $table->integer('ei_heures_par_groupe')->unsigned()->default(0);

            $table->integer('id_utilisateur')->unsigned();
            $table->foreign('id_utilisateur')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enseignant_dans_u_e_externes');
    }
}
