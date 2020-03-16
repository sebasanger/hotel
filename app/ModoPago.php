<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModoPago extends Model
{
    use SoftDeletes;
    
    protected $table = 'ModosPagos';
}
