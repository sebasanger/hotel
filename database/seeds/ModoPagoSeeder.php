<?php

use App\ModoPago;
use Illuminate\Database\Seeder;

class ModoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modoPago = new ModoPago();

        $modoPago->modoPago = "efectivo";
        $modoPago->cantidadPagos = 1;
        $modoPago->descripcion = "efectivo";
        $modoPago->created_at = now();

        $modoPago->save();

        $modoPago = new ModoPago();

        $modoPago->modoPago = "Debito 1 cuota";
        $modoPago->cantidadPagos = 1;
        $modoPago->descripcion = "debito a una cuota";
        $modoPago->created_at = now();

        $modoPago->save();

        $modoPago = new ModoPago();

        $modoPago->modoPago = "credito a 1 cuota";
        $modoPago->cantidadPagos = 1;
        $modoPago->descripcion = "credito a una cuota";
        $modoPago->created_at = now();

        $modoPago->save();

        $modoPago = new ModoPago();

        $modoPago->modoPago = "Debito a 3 cuotas";
        $modoPago->cantidadPagos = 3;
        $modoPago->descripcion = "credito a tres cuotas";
        $modoPago->created_at = now();

        $modoPago->save();
    }
}
