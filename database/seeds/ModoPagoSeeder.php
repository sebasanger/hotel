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

        $modoPago->modoPago = "debito 1 cuota";
        $modoPago->cantidadPagos = 1;
        $modoPago->descripcion = "debito a una cuota";
        $modoPago->created_at = now();

        $modoPago->save();

        $modoPago = new ModoPago();

        $modoPago->modoPago = "credito 1 cuota";
        $modoPago->cantidadPagos = 1;
        $modoPago->descripcion = "credito a una cuota";
        $modoPago->created_at = now();

        $modoPago->save();

        $modoPago = new ModoPago();

        $modoPago->modoPago = "credito 3 cuotas";
        $modoPago->cantidadPagos = 3;
        $modoPago->descripcion = "credito a tres cuotas";
        $modoPago->created_at = now();

        $modoPago->save();

        $modoPago = new ModoPago();

        $modoPago->modoPago = "credito 6 cuotas";
        $modoPago->cantidadPagos = 6;
        $modoPago->descripcion = "credito a seis cuotas";
        $modoPago->created_at = now();

        $modoPago->save();

        $modoPago = new ModoPago();

        $modoPago->modoPago = "credito 10 cuotas";
        $modoPago->cantidadPagos = 10;
        $modoPago->descripcion = "credito a diez cuotas";
        $modoPago->created_at = now();

        $modoPago->save();

        $modoPago = new ModoPago();

        $modoPago->modoPago = "credito 12 cuotas";
        $modoPago->cantidadPagos = 12;
        $modoPago->descripcion = "credito a doce cuotas";
        $modoPago->created_at = now();

        $modoPago->save();
    }
}
