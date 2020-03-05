<?php

use App\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $producto = new Producto();
        $producto->producto = "Cocacola 1L";
        $producto->codigoProducto = "sdfs32332";
        $producto->stock = 5;
        $producto->precio = 50;

        $producto->categorias_id = 1;
        $producto->marcas_id = 1;
        $producto->created_at = now();

        $producto->save();

        $producto = new Producto();
        $producto->producto = "Cocacola 2L";
        $producto->codigoProducto = "sss32332";
        $producto->stock = 2;
        $producto->precio = 70;

        $producto->categorias_id = 1;
        $producto->marcas_id = 1;
        $producto->created_at = now();

        $producto->save();

        $producto = new Producto();
        $producto->producto = "Cocacola 500ml";
        $producto->codigoProducto = "sdsdfxs32332";
        $producto->stock = 8;
        $producto->precio = 40;

        $producto->categorias_id = 1;
        $producto->marcas_id = 1;
        $producto->created_at = now();

        $producto->save();

        $producto = new Producto();
        $producto->producto = "quilmes 1L";
        $producto->codigoProducto = "sdsdf";
        $producto->stock = 4;
        $producto->precio = 70;

        $producto->categorias_id = 2;
        $producto->marcas_id = 5;
        $producto->created_at = now();

        $producto->save();

        $producto = new Producto();
        $producto->producto = "quilmes 500ml";
        $producto->codigoProducto = "sdsdfsds";
        $producto->stock = 2;
        $producto->precio = 50;

        $producto->categorias_id = 2;
        $producto->marcas_id = 5;
        $producto->created_at = now();

        $producto->save();

        $producto = new Producto();
        $producto->producto = "brahama 1L";
        $producto->codigoProducto = "sdssss";
        $producto->stock = 2;
        $producto->precio = 75;

        $producto->categorias_id = 2;
        $producto->marcas_id = 7;
        $producto->created_at = now();

        $producto->save();

        $producto = new Producto();
        $producto->producto = "brahama 500ml";
        $producto->codigoProducto = "sdse33sss";
        $producto->stock = 6;
        $producto->precio = 45;

        $producto->categorias_id = 2;
        $producto->marcas_id = 7;
        $producto->created_at = now();

        $producto->save();

        $producto = new Producto();
        $producto->producto = "Sancor leche 1L";
        $producto->codigoProducto = "2e33sss";
        $producto->stock = 8;
        $producto->precio = 50;

        $producto->categorias_id = 4;
        $producto->marcas_id = 3;
        $producto->created_at = now();

        $producto->save();

        $producto = new Producto();
        $producto->producto = "Serenisima leche 1L";
        $producto->codigoProducto = "2e3213s";
        $producto->stock = 4;
        $producto->precio = 55;

        $producto->categorias_id = 4;
        $producto->marcas_id = 4;
        $producto->created_at = now();

        $producto->save();
    }
}
