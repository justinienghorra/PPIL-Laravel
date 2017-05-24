<?php

use App\Notification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('resume')->size(256);

            $table->date('date_notification');

            $table->integer('id_utilisateur_a_notifie')->unsigned();
            $table->foreign('id_utilisateur_a_notifie')->references('id')->on('users')->onDelete('cascade');

            $table->integer('venant_de_id_utilisateur')->unsigned();
            $table->foreign('venant_de_id_utilisateur')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification', function (Blueprint $table) {
            $table->dropForeign(['id_utilisateur_a_notifie', 'venant_de_id_utilisateur']);
        });
    }
}
