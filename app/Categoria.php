<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{

    public function productos()
    {
        return $this->hasMany('App\Producto');
    }

    use SoftDeletes;

    protected $table = 'categorias';

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];
}
