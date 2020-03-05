<?php

use App\Factura;
use Illuminate\Database\Seeder;

class FacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factura = new Factura();
        $factura->tipoFactura = "factura A";
        $factura->created_at = now();

        $factura->save();

        $factura = new Factura();
        $factura->tipoFactura = "factura B";
        $factura->created_at = now();

        $factura->save();

        $factura = new Factura();
        $factura->tipoFactura = "factura C";
        $factura->created_at = now();

        $factura->save();

        $factura = new Factura();
        $factura->tipoFactura = "factura D";
        $factura->created_at = now();

        $factura->save();

        $factura = new Factura();
        $factura->tipoFactura = "factura E";
        $factura->created_at = now();

        $factura->save();
    }
}
