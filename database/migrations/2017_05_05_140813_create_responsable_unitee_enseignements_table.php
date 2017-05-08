<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsableUniteeEnseignementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsable_unitee_enseignements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('id_utilisateur')->unsigned();
            $table->foreign('id_utilisateur')->references('id')->on('users');

            $table->integer('id_ue')->unsigned();
            $table->foreign('id_ue')->references('id')->on('unitee_enseignements');

             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responsable_unitee_enseignements', function (Blueprint $table) {
            $table->dropForeign(['id_ue', 'id_utilisateur']);
        });
    }
}
