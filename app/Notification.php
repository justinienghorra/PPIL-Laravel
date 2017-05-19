<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property  id_utilisateur_a_notifie
 */
class Notification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notification';


    public function createNotification($message, $venant_de_id, $id_a_notifie){

        $notif = new Notification();

        $notif->resume = $message;
        $notif->id_utilisateur_a_notifie = $id_a_notifie;
        $notif->venant_de_id_utilisateur = $venant_de_id;

        $notif->save();

        return true;
    }
}
