<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IngresoProducto extends Model
{
    public function productos()
    {
        return $this->belongsTo('App\Producto');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function modosPagos()
    {
        return $this->belongsTo('App\ModoPago');
    }

    use SoftDeletes;

    protected $table = 'IngresosProductos';

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];


}
