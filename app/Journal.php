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
                return $user;
                break;
        }
    }

    public function getType() {
        switch ($this->type) {
            case 'INSC':                
                return 'Inscription';
                break;
        }
    }
}
