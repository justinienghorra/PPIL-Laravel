<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    protected $table = 'photos';

    protected $fillable = ['adresse'];


    public static function creerImage($adresse, $id_utilisateur){
        $photo = new Photos;
        $photo->adresse = $adresse;
        $photo->id_utilisateur = $id_utilisateur;
        $photo->save();

        return $photo;
    }
}
