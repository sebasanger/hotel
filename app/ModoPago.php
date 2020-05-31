<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModoPago extends Model
{

    public function pagos()
    {
        return $this->hasMany('App\Pago');
    }

    public function movimientos()
    {
        return $this->hasMany('App\Movimiento');
    }

    public function ingresosProductos()
    {
        return $this->hasMany('App\IngresoProducto');
    }

    public function consumos()
    {
        return $this->hasMany('App\Consumo');
    }

    use SoftDeletes;

    protected $table = 'modospagos';

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];
}
