<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Habitacion extends Model
{
    public function reservas()
    {
        return $this->hasMany('App\Reserva');
    }

    use SoftDeletes;

    protected $table = 'Habitaciones';

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];
}
