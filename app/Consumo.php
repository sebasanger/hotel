<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consumo extends Model
{
    public function reservas()
    {
        return $this->belongsTo('App\Reserva');
    }

    public function productos()
    {
        return $this->belongsTo('App\Producto');
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

    protected $fillable = [
        'cantidad', 'precio', 'pagado', 'productos_id', 'cajas_id', 'modosPagos_id', 'reservas_id'
    ];

    use SoftDeletes;

    protected $table = 'consumos';
}
