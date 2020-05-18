<?php

use App\Movimiento;
use Illuminate\Database\Seeder;

class MovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $movimiento = new Movimiento();
        $movimiento->descripcion = "alquiler";
        $movimiento->monto = 1500;
        $movimiento->cajas_id = 1;
        $movimiento->tipo = 1;
        $movimiento->users_id = 1;
        $movimiento->modosPagos_id = 1;
        $movimiento->created_at = now()->subDays(5);

        $movimiento->save();

        $movimiento = new Movimiento();
        $movimiento->descripcion = "agua";
        $movimiento->monto = 2500;
        $movimiento->cajas_id = 1;
        $movimiento->tipo = 0;
        $movimiento->users_id = 1;
        $movimiento->modosPagos_id = 1;
        $movimiento->created_at = now()->subDays(5);

        $movimiento->save();

        $movimiento = new Movimiento();
        $movimiento->descripcion = "canal";
        $movimiento->monto = 2000;
        $movimiento->cajas_id = 2;
        $movimiento->tipo = 0;
        $movimiento->users_id = 2;
        $movimiento->modosPagos_id = 1;
        $movimiento->created_at = now()->subDays(4);

        $movimiento->save();

        $movimiento = new Movimiento();
        $movimiento->descripcion = "limpieza de ropa";
        $movimiento->monto = 80;
        $movimiento->cajas_id = 1;
        $movimiento->tipo = 0;
        $movimiento->users_id = 3;
        $movimiento->modosPagos_id = 1;
        $movimiento->created_at = now()->subDays(3);

        $movimiento->save();

        $movimiento = new Movimiento();
        $movimiento->descripcion = "limpieza de ropa";
        $movimiento->monto = 100;
        $movimiento->cajas_id = 1;
        $movimiento->tipo = 0;
        $movimiento->users_id = 3;
        $movimiento->modosPagos_id = 1;
        $movimiento->created_at = now()->subDays(1);

        $movimiento->save();

        $movimiento = new Movimiento();
        $movimiento->descripcion = "limpieza de ropa";
        $movimiento->monto = 150;
        $movimiento->cajas_id = 1;
        $movimiento->tipo = 0;
        $movimiento->users_id = 4;
        $movimiento->modosPagos_id = 1;
        $movimiento->created_at = now()->subDays(1);

        $movimiento->save();

        $movimiento = new Movimiento();
        $movimiento->descripcion = "mancharon una toalla";
        $movimiento->monto = 120;
        $movimiento->cajas_id = 1;
        $movimiento->tipo = 1;
        $movimiento->users_id = 4;
        $movimiento->modosPagos_id = 1;
        $movimiento->created_at = now()->subDays(1);

        $movimiento->save();

        $movimiento = new Movimiento();
        $movimiento->descripcion = "pago de la antena";
        $movimiento->monto = 5000;
        $movimiento->cajas_id = 1;
        $movimiento->tipo = 1;
        $movimiento->users_id = 1;
        $movimiento->modosPagos_id = 2;
        $movimiento->created_at = now();

        $movimiento->save();
    }
}
