<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caja extends Model
{
    use SoftDeletes;

    protected $table = 'Cajas';

    public function reservas()
    {
        return $this->hasManyThrough('App\Reserva', 'App\Pago');
    }
}
