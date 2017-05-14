<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     *
     * @return User
     */
    protected $table = 'formations';

    public function responsable() {
        return $this->hasOne('App\ResponsableFormation', 'id_formation');
    }
}
