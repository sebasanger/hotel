<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'password', 'telefono', 'celular', 'direccion', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];

    public function reservas()
    {
        return $this->hasMany('App\Reserva');
    }

    public function consumos()
    {
        return $this->hasMany('App\Consumo');
    }

    public function pagos()
    {
        return $this->hasMany('App\Pago');
    }

    public function ingresosProductos()
    {
        return $this->hasMany('App\IngresoProducto');
    }

    public function movimientos()
    {
        return $this->hasMany('App\Movimiento');
    }

    public function cajas()
    {
        return $this->hasMany('App\Caja');
    }
}
