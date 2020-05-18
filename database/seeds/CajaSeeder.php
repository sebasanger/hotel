<?php

use App\Caja;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CajaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $caja = new Caja();
        $caja->montoApertura = 800;
        $caja->saldo = 2000;
        $caja->montoCierre = 2000;
        $caja->horaCierre = now()->subDays(5);
        $caja->cajaActiva = 0;
        $caja->users_id = 1;
        $caja->created_at = now()->subDays(5);

        $caja->save();

        $caja = new Caja();
        $caja->montoApertura = 2000;
        $caja->saldo = 1000;
        $caja->montoCierre = 1000;
        $caja->horaCierre = now()->subDays(4);
        $caja->cajaActiva = 0;
        $caja->users_id = 2;
        $caja->created_at = now()->subDays(4);

        $caja->save();

        $caja = new Caja();
        $caja->montoApertura = 1000;
        $caja->saldo = 1800;
        $caja->montoCierre = 1800;
        $caja->horaCierre = now()->subDays(4);
        $caja->cajaActiva = 0;
        $caja->users_id = 3;
        $caja->created_at = now()->subDays(4);

        $caja->save();


        $caja = new Caja();
        $caja->montoApertura = 1800;
        $caja->saldo = 3000;
        $caja->montoCierre = 3000;
        $caja->horaCierre = now()->subDays(3);
        $caja->cajaActiva = 0;
        $caja->users_id = 4;
        $caja->created_at = now()->subDays(3);

        $caja->save();

        $caja = new Caja();
        $caja->montoApertura = 3000;
        $caja->saldo = 5000;
        $caja->montoCierre = 5000;
        $caja->horaCierre = now()->subDays(3);
        $caja->cajaActiva = 0;
        $caja->users_id = 4;
        $caja->created_at = now()->subDays(3);

        $caja->save();

        $caja = new Caja();
        $caja->montoApertura = 5000;
        $caja->saldo = 800;
        $caja->montoCierre = 800;
        $caja->horaCierre = now()->subDays(2);
        $caja->cajaActiva = 0;
        $caja->users_id = 3;
        $caja->created_at = now()->subDays(2);

        $caja->save();

        $caja = new Caja();
        $caja->montoApertura = 800;
        $caja->saldo = 3000;
        $caja->montoCierre = 3000;
        $caja->horaCierre = now()->subDays(2);
        $caja->cajaActiva = 0;
        $caja->users_id = 2;
        $caja->created_at = now()->subDays(2);

        $caja->save();

        $caja = new Caja();
        $caja->montoApertura = 800;
        $caja->saldo = 3000;
        $caja->montoCierre = 3000;
        $caja->horaCierre = now()->subDays(1);
        $caja->cajaActiva = 0;
        $caja->users_id = 2;
        $caja->created_at = now()->subDays(1);

        $caja->save();

        $caja = new Caja();
        $caja->montoApertura = 800;
        $caja->saldo = 2500;
        $caja->montoCierre = 3000;
        $caja->horaCierre = now()->subDays(1);
        $caja->cajaActiva = 0;
        $caja->users_id = 2;
        $caja->created_at = now()->subDays(1);

        $caja->save();

        $caja = new Caja();
        $caja->montoApertura = 800;
        $caja->saldo = 1000;
        $caja->montoCierre = 3000;
        $caja->horaCierre = now()->subDays(1);
        $caja->cajaActiva = 0;
        $caja->users_id = 2;
        $caja->created_at = now()->subDays(1);

        $caja->save();


        $caja = new Caja();
        $caja->montoApertura = 800;
        $caja->saldo = 800;
        $caja->montoCierre = 3000;
        $caja->horaCierre = now();
        $caja->cajaActiva = 0;
        $caja->users_id = 2;
        $caja->created_at = now();

        $caja->save();

        $caja = new Caja();
        $caja->montoApertura = 5000;
        $caja->saldo = 800;
        $caja->cajaActiva = 1;
        $caja->users_id = 1;
        $caja->created_at = now();

        $caja->save();
    }
}
