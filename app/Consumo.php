<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consumo extends Model
{
    use SoftDeletes;

    protected $table = 'Consumos';
}
