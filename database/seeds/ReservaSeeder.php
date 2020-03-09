<?php

use App\Reserva;
use Illuminate\Database\Seeder;


class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reserva = new Reserva();
        $reserva->huespedes = 1;
        $reserva->precio = 1200;
        $reserva->egreso = now();
        $reserva->patenteAuto = "ase 125";
        $reserva->activa = 0;
        $reserva->totalPagar = 1250;
        $reserva->clientes_id = 1;
        $reserva->motivos_id = 1;
        $reserva->preciosHabitaciones_id = 1;
        $reserva->pagado = 1200;
        $reserva->habitaciones_id = 1;
        $reserva->users_id = 1;
        $reserva->created_at = now();

        $reserva->save();


        $reserva = new Reserva();
        $reserva->huespedes = 2;
        $reserva->precio = 1500;
        $reserva->egreso = now();
        $reserva->patenteAuto = "sea 115";
        $reserva->activa = 0;
        $reserva->totalPagar = 1700;
        $reserva->clientes_id = 2;
        $reserva->motivos_id = 2;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->pagado = 1500;
        $reserva->habitaciones_id = 2;
        $reserva->users_id = 2;
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 3;
        $reserva->precio = 1700;
        $reserva->egreso = now();
        $reserva->patenteAuto = "afe 125";
        $reserva->activa = 0;
        $reserva->totalPagar = 1700;
        $reserva->clientes_id = 13;
        $reserva->motivos_id = 3;
        $reserva->preciosHabitaciones_id = 3;
        $reserva->pagado = 1700;
        $reserva->habitaciones_id = 8;
        $reserva->users_id = 3;
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 4;
        $reserva->precio = 2400;
        $reserva->egreso = now();
        $reserva->activa = 0;
        $reserva->totalPagar = 2400;
        $reserva->clientes_id = 25;
        $reserva->motivos_id = 1;
        $reserva->preciosHabitaciones_id = 4;
        $reserva->pagado = 2400;
        $reserva->habitaciones_id = 9;
        $reserva->users_id = 1;
        $reserva->created_at = now();

        $reserva->save();


        $reserva = new Reserva();
        $reserva->huespedes = 2;
        $reserva->precio = 1500;
        $reserva->egreso = now();
        $reserva->activa = 1;
        $reserva->totalPagar = 1500;
        $reserva->clientes_id = 19;
        $reserva->motivos_id = 1;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->pagado = 1000;
        $reserva->habitaciones_id = 1;
        $reserva->users_id = 1;
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 3;
        $reserva->precio = 2000;
        $reserva->egreso = now();
        $reserva->activa = 1;
        $reserva->totalPagar = 2100;
        $reserva->clientes_id = 8;
        $reserva->motivos_id = 2;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->pagado = 2100;
        $reserva->habitaciones_id = 13;
        $reserva->users_id = 4;
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 2;
        $reserva->precio = 1500;
        $reserva->egreso = now();
        $reserva->activa = 1;
        $reserva->totalPagar = 1500;
        $reserva->clientes_id = 8;
        $reserva->motivos_id = 2;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->pagado = 0;
        $reserva->habitaciones_id = 12;
        $reserva->users_id = 1;
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 1 ;
        $reserva->precio = 1200;
        $reserva->egreso = now();
        $reserva->activa = 1;
        $reserva->totalPagar = 1250;
        $reserva->clientes_id = 12;
        $reserva->motivos_id = 1;
        $reserva->preciosHabitaciones_id = 1;
        $reserva->pagado = 0;
        $reserva->habitaciones_id = 15;
        $reserva->users_id = 4;
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 4;
        $reserva->precio = 2400;
        $reserva->egreso = now();
        $reserva->activa = 1;
        $reserva->totalPagar = 2400;
        $reserva->clientes_id = 17;
        $reserva->motivos_id = 2;
        $reserva->preciosHabitaciones_id = 4;
        $reserva->pagado = 0;
        $reserva->habitaciones_id = 14;
        $reserva->users_id = 5;
        $reserva->created_at = now();

        $reserva->save();

        
    }
}
