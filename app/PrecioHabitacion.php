<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrecioHabitacion extends Model
{
    use SoftDeletes;

    protected $table = 'PreciosHabitaciones';
}
