<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movimiento extends Model
{
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

    protected $table = 'Movimientos';

    protected $fillable = [
        'descripcion', 'monto', 'ingreso', 'egreso', 'users_id', 'modosPagos_id'
    ];
}
