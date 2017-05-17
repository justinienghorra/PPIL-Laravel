w<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsableFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsable_formations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('id_utilisateur')->unsigned();
            $table->foreign('id_utilisateur')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('responsable_formations', function (Blueprint $table) {
            $table->dropForeign(['id_formation', 'id_utilisateur']);
        });
    }
}
