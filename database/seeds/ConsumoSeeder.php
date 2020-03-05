<?php

use App\Consumo;
use Illuminate\Database\Seeder;

class ConsumoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $consumo = new Consumo();
        $consumo->cantidad = 1;
        $consumo->precio = 50;
        $consumo->pagado = 1;
        $consumo->cajas_id = 1;
        $consumo->reservas_id = 1;
        $consumo->productos_id = 1;
        $consumo->users_id = 1;
        $consumo->created_at = now();


        $consumo->save();

        $consumo = new Consumo();
        $consumo->cantidad = 1;
        $consumo->precio = 70;
        $consumo->pagado = 1;
        $consumo->cajas_id = 2;
        $consumo->reservas_id = 2;
        $consumo->productos_id = 2;
        $consumo->users_id = 4;
        $consumo->created_at = now();

        $consumo->save();

        $consumo = new Consumo();
        $consumo->cantidad = 2;
        $consumo->precio = 40;
        $consumo->pagado = 1;
        $consumo->cajas_id = 3;
        $consumo->reservas_id = 3;
        $consumo->productos_id = 3;
        $consumo->users_id = 2;
        $consumo->created_at = now();

        $consumo->save();

        $consumo = new Consumo();
        $consumo->cantidad = 1;
        $consumo->precio = 40;
        $consumo->pagado = 1;
        $consumo->cajas_id = 3;
        $consumo->reservas_id = 5;
        $consumo->productos_id = 3;
        $consumo->users_id = 1;
        $consumo->created_at = now();

        $consumo->save();


        $consumo = new Consumo();
        $consumo->cantidad = 1;
        $consumo->precio = 50;
        $consumo->pagado = 0;
        $consumo->cajas_id = 3;
        $consumo->reservas_id = 7;
        $consumo->productos_id = 5;
        $consumo->users_id = 2;
        $consumo->created_at = now();

        $consumo->save();

        $consumo = new Consumo();
        $consumo->cantidad = 2;
        $consumo->precio = 75;
        $consumo->pagado = 1;
        $consumo->cajas_id = 3;
        $consumo->reservas_id = 8;
        $consumo->productos_id = 6;
        $consumo->users_id = 2;
        $consumo->created_at = now();

        $consumo->save();

















        $consumo = new Consumo();
        $consumo->cantidad = 2;
        $consumo->precio = 70;
        $consumo->pagado = 0;
        $consumo->cajas_id = 8;
        $consumo->reservas_id = 2;
        $consumo->productos_id = 2;
        $consumo->users_id = 5;
        $consumo->created_at = now();

        $consumo->save();
    }
}
