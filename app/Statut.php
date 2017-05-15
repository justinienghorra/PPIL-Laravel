<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statut extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'statuts';

    protected $fillable = ['statut'];
}
