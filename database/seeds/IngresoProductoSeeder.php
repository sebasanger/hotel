<?php

use App\IngresoProducto;
use Illuminate\Database\Seeder;

class IngresoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingresoProducto = new IngresoProducto();
        $ingresoProducto->cantidadIngreso = 5;
        $ingresoProducto->precioCompra = 50;
        $ingresoProducto->modosPagos_id = 2;
        $ingresoProducto->productos_id = 1;
        $ingresoProducto->users_id = 1;
        $ingresoProducto->created_at = now();

        $ingresoProducto->save();

        $ingresoProducto = new IngresoProducto();
        $ingresoProducto->cantidadIngreso = 2;
        $ingresoProducto->precioCompra = 70;
        $ingresoProducto->modosPagos_id = 2;
        $ingresoProducto->productos_id = 2;
        $ingresoProducto->users_id = 2;
        $ingresoProducto->created_at = now();

        $ingresoProducto->save();

        $ingresoProducto = new IngresoProducto();
        $ingresoProducto->cantidadIngreso = 8;
        $ingresoProducto->precioCompra = 40;
        $ingresoProducto->productos_id = 3;
        $ingresoProducto->users_id = 2;
        $ingresoProducto->created_at = now();

        $ingresoProducto->save();


        $ingresoProducto = new IngresoProducto();
        $ingresoProducto->cantidadIngreso = 4;
        $ingresoProducto->precioCompra = 70;
        $ingresoProducto->productos_id = 4;
        $ingresoProducto->users_id = 2;
        $ingresoProducto->created_at = now();

        $ingresoProducto->save();


        $ingresoProducto = new IngresoProducto();
        $ingresoProducto->cantidadIngreso = 2;
        $ingresoProducto->precioCompra = 50;
        $ingresoProducto->productos_id = 5;
        $ingresoProducto->users_id = 3;
        $ingresoProducto->created_at = now();

        $ingresoProducto->save();

        $ingresoProducto = new IngresoProducto();
        $ingresoProducto->cantidadIngreso = 2;
        $ingresoProducto->precioCompra = 75;
        $ingresoProducto->productos_id = 6;
        $ingresoProducto->users_id = 4;
        $ingresoProducto->created_at = now();

        $ingresoProducto->save();

        $ingresoProducto = new IngresoProducto();
        $ingresoProducto->cantidadIngreso = 6;
        $ingresoProducto->precioCompra = 45;
        $ingresoProducto->productos_id = 7;
        $ingresoProducto->users_id = 4;
        $ingresoProducto->created_at = now();

        $ingresoProducto->save();

        $ingresoProducto = new IngresoProducto();
        $ingresoProducto->cantidadIngreso = 8;
        $ingresoProducto->precioCompra = 50;
        $ingresoProducto->productos_id = 8;
        $ingresoProducto->users_id = 1;
        $ingresoProducto->created_at = now();

        $ingresoProducto->save();

        $ingresoProducto = new IngresoProducto();
        $ingresoProducto->cantidadIngreso = 4;
        $ingresoProducto->precioCompra = 55;
        $ingresoProducto->productos_id = 9;
        $ingresoProducto->users_id = 1;
        $ingresoProducto->created_at = now();

        $ingresoProducto->save();
    }
}
