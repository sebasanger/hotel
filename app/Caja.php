<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'Cajas';

    public function reservas()
    {
        return $this->hasManyThrough('App\Reserva', 'App\Pago');
    }
}
