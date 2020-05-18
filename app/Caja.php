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
        'horaCierre' => 'datetime:d/m/Y H:i',
        'cajaActiva' => 'boolean',
    ];

    protected $fillable = [
        'saldo', 'horaCierre', 'montoCierre', 'cajaActiva', 'users_id', 'created_at', 'updated_at'
    ];
}
