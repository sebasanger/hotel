<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    public function ingresosProductos()
    {
        return $this->hasMany('App\IngresoProducto');
    }

    public function marcas()
    {
        return $this->belongsTo('App\Marca');
    }

    public function categorias()
    {
        return $this->belongsTo('App\Categoria');
    }

    use SoftDeletes;

    protected $table = 'productos';

    protected $fillable = [
        'stock', 'producto', 'precio', 'codigoProducto', 'categorias_id', 'marcas_id'
    ];
}
