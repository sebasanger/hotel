<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model
{

    public function clientes()
    {
        return $this->hasMany('App\Cliente');
    }

    use SoftDeletes;

    protected $table = 'facturas';

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];
}
