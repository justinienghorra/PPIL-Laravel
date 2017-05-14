<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    /**
     * Renvoie une description de l'évenement
     */
    public function toString() {
        switch ($this->type) {
            case 'INSC':
                $user = User::where('id', $this->id_utilisateur)->first();
                return "Inscription de " . $user->civilite . " " . $user->prenom . " " . $user->nom;
                break;
        }
    }
}
