<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnseignantDansUEsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseignant_dans_u_es', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('cm_nb_heures')->unsigned()->default(0);

            $table->integer('td_nb_groupes')->unsigned()->default(0);
            $table->integer('tp_nb_groupes')->unsigned()->default(0);
            $table->integer('ei_nb_groupes')->unsigned()->default(0);

            $table->integer('td_heures_par_groupe')->unsigned()->default(0);
            $table->integer('tp_heures_par_groupe')->unsigned()->default(0);
            $table->integer('ei_heures_par_groupe')->unsigned()->default(0);

            $table->integer('id_utilisateur')->unsigned();
            $table->foreign('id_utilisateur')->references('id')->on('users')->onDelete('cascade');

            $table->integer('id_ue')->unsigned();
            $table->foreign('id_ue')->references('id')->on('unitee_enseignements')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enseignant_dans_u_es', function(Blueprint $table) {
            $table->dropForeign(['id_ue']);
        });
    }
}
