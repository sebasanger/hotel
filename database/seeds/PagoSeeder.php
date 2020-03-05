<?php

use App\Pago;
use Illuminate\Database\Seeder;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pago = new Pago();
        $pago->reservas_id = 1;
        $pago->modosPagos_id = 1;
        $pago->cajas_id = 1;
        $pago->monto = 1200;
        $pago->users_id = 1;
        $pago->created_at = now();

        $pago->save();

        $pago = new Pago();
        $pago->reservas_id = 2;
        $pago->modosPagos_id = 1;
        $pago->cajas_id = 1;
        $pago->monto = 700;
        $pago->users_id = 1;
        $pago->created_at = now();

        $pago->save();

        $pago = new Pago();
        $pago->reservas_id = 2;
        $pago->modosPagos_id = 1;
        $pago->cajas_id = 1;
        $pago->monto = 800;
        $pago->users_id = 1;
        $pago->created_at = now();

        $pago->save();

        $pago = new Pago();
        $pago->reservas_id = 3;
        $pago->modosPagos_id = 2;
        $pago->cajas_id = 2;
        $pago->monto = 1700;
        $pago->users_id = 2;
        $pago->created_at = now();

        $pago->save();

        $pago = new Pago();
        $pago->reservas_id = 4;
        $pago->modosPagos_id = 2;
        $pago->cajas_id = 3;
        $pago->monto = 1200;
        $pago->users_id = 3;
        $pago->created_at = now();

        $pago->save();

        $pago = new Pago();
        $pago->reservas_id = 4;
        $pago->modosPagos_id = 2;
        $pago->cajas_id = 4;
        $pago->monto = 1200;
        $pago->users_id = 4;
        $pago->created_at = now();

        $pago->save();

        $pago = new Pago();
        $pago->reservas_id = 5;
        $pago->modosPagos_id = 1;
        $pago->cajas_id = 4;
        $pago->monto = 1500;
        $pago->users_id = 3;
        $pago->created_at = now();

        $pago->save();

        $pago = new Pago();
        $pago->reservas_id = 6;
        $pago->modosPagos_id = 1;
        $pago->cajas_id = 5;
        $pago->monto = 1000;
        $pago->users_id = 5;
        $pago->created_at = now();

        $pago->save();

        $pago = new Pago();
        $pago->reservas_id = 6;
        $pago->modosPagos_id = 1;
        $pago->cajas_id = 5;
        $pago->monto = 1000;
        $pago->users_id = 5;
        $pago->created_at = now();

        $pago->save();
    }
}
