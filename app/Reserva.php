<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'Reservas';


      public function cajas()
    {
        return $this->hasManyThrough('App\Caja', 'App\Pago');
    }
}
