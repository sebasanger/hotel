<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{

    public function reservas()
    {
        return $this->hasMany('App\Reserva');
    }

    public function facturas()
    {
        return $this->belongsTo('App\Factura');
    }

    use SoftDeletes;

    protected $table = 'Clientes';

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];
}
