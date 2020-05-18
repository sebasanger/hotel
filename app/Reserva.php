<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Model
{

    public function clientes()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function motivos()
    {
        return $this->belongsTo('App\Motivo');
    }

    public function preciosHabitaciones()
    {
        return $this->belongsTo('App\PrecioHabitacion');
    }

    public function habitaciones()
    {
        return $this->belongsTo('App\Habitacion');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function consumos()
    {
        return $this->hasMany('App\Consumo');
    }

    public function pagos()
    {
        return $this->hasMany('App\Pago');
    }

    protected $fillable = [
        'huespedes', 'precioDia', 'egreso', 'patenteAuto', 'estado', 'totalPagar','pagado','clientes_id','motivos_id','preciosHabitaciones_id','habitaciones_id','users_id'
    ];


    use SoftDeletes;

    protected $table = 'Reservas';

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
        'ingreso' => 'datetime',
        'egreso' => 'datetime',

    ];
}
