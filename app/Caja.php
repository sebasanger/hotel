<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caja extends Model
{
    public function pagos()
    {
        return $this->hasMany('App\PAgo');
    }

    public function consumos()
    {
        return $this->hasMany('App\Consumo');
    }

    public function movimientos()
    {
        return $this->hasMany('App\Movimiento');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    use SoftDeletes;

    protected $table = 'Cajas';

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];
}
