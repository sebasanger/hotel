<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    public function reservas()
    {
        return $this->belongsTo('App\Reserva');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function cajas()
    {
        return $this->belongsTo('App\Caja');
    }

    public function modosPagos()
    {
        return $this->belongsTo('App\ModoPago');
    }

    use SoftDeletes;

    protected $table = 'Pagos';

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];
}
