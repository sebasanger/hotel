<?php

use App\Reserva;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


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
        $reserva->procedencia = "brasil";
        $reserva->destino = "argentina";
        $reserva->huespedes = 1;
        $reserva->precio = 1200;
        $reserva->egreso = now()->addDays(2);
        $reserva->patenteAuto = "ase 125";
        $reserva->estado = 0;
        $reserva->totalPagar = 1250;
        $reserva->clientes_id = 6;
        $reserva->motivos_id = 1;
        $reserva->preciosHabitaciones_id = 1;
        $reserva->pagado = 1200;
        $reserva->habitaciones_id = 2;
        $reserva->users_id  = 1;
        $reserva->color = 'green';
        $reserva->created_at = now();
        $reserva->ingreso = now()->subDays(2);

        $reserva->save();


        $reserva = new Reserva();
        $reserva->procedencia = "brasil";
        $reserva->destino = "paraguay";
        $reserva->huespedes = 2;
        $reserva->precio = 1500;
        $reserva->egreso = now()->addDays(3);
        $reserva->patenteAuto = "sea 115";
        $reserva->estado = 0;
        $reserva->totalPagar = 1700;
        $reserva->clientes_id = 2;
        $reserva->motivos_id = 2;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->pagado = 1500;
        $reserva->habitaciones_id = 3;
        $reserva->users_id  = 2;
        $reserva->color = 'green';
        $reserva->created_at = now()->subDay(10);
        $reserva->ingreso = now()->subDay(10);

        $reserva->save();

        $reserva = new Reserva();
        $reserva->procedencia = "bolivia";
        $reserva->destino = "argentina";
        $reserva->huespedes = 2;
        $reserva->precio = 1500;
        $reserva->egreso = now()->addDays(10);
        $reserva->estado = 0;
        $reserva->totalPagar = 1700;
        $reserva->clientes_id = 5;
        $reserva->motivos_id = 2;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->pagado = 1500;
        $reserva->habitaciones_id = 2;
        $reserva->users_id  = 3;
        $reserva->color = 'red';
        $reserva->ingreso = now()->addDays(3);
        $reserva->created_at = now()->addDays(3);

        $reserva->save();

        $reserva = new Reserva();
        $reserva->procedencia = "chile";
        $reserva->destino = "rosario";
        $reserva->huespedes = 3;
        $reserva->precio = 1700;
        $reserva->egreso = now()->addDays(5);
        $reserva->patenteAuto = "afe 125";
        $reserva->estado = 0;
        $reserva->totalPagar = 1700;
        $reserva->clientes_id = 13;
        $reserva->motivos_id = 3;
        $reserva->preciosHabitaciones_id = 3;
        $reserva->pagado = 1700;
        $reserva->habitaciones_id = 8;
        $reserva->users_id  = 3;
        $reserva->color = 'green';
        $reserva->ingreso = now();
        $reserva->created_at = now();

        $reserva->save();




        $reserva = new Reserva();
        $reserva->procedencia = "chaco";
        $reserva->destino = "bs as";
        $reserva->huespedes = 2;
        $reserva->precio = 1500;
        $reserva->egreso = now()->addDays(4);
        $reserva->estado = 1;
        $reserva->totalPagar = 1500;
        $reserva->clientes_id = 19;
        $reserva->motivos_id = 1;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->pagado = 1000;
        $reserva->habitaciones_id = 1;
        $reserva->users_id  = 1;
        $reserva->color = 'red';
        $reserva->ingreso = now()->addDays(2);
        $reserva->created_at = now()->addDays(2);

        $reserva->save();



        $reserva = new Reserva();
        $reserva->procedencia = "iguazu";
        $reserva->destino = "bolovia";
        $reserva->huespedes = 2;
        $reserva->precio = 1500;
        $reserva->egreso = now()->addDays(5);
        $reserva->estado = 1;
        $reserva->totalPagar = 1500;
        $reserva->clientes_id = 8;
        $reserva->motivos_id = 2;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->pagado = 0;
        $reserva->habitaciones_id = 12;
        $reserva->users_id  = 1;
        $reserva->color = 'green';
        $reserva->ingreso = now();
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->procedencia = "canada";
        $reserva->destino = "eeuu";
        $reserva->huespedes = 4;
        $reserva->precio = 2400;
        $reserva->egreso = now()->addDays(8);
        $reserva->estado = 1;
        $reserva->totalPagar = 2400;
        $reserva->clientes_id = 25;
        $reserva->motivos_id = 2;
        $reserva->preciosHabitaciones_id = 4;
        $reserva->pagado = 0;
        $reserva->habitaciones_id = 14;
        $reserva->users_id  = 2;
        $reserva->color = 'red';
        $reserva->ingreso = now()->addDays(3);
        $reserva->created_at = now()->addDays(3);

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 2;
        $reserva->precio = 2400;
        $reserva->ingreso = "2020/03/20";
        $reserva->egreso = "2020/03/23";
        $reserva->estado = 0;
        $reserva->clientes_id = 20;
        $reserva->preciosHabitaciones_id = 4;
        $reserva->habitaciones_id = 14;
        $reserva->users_id  = 2;
        $reserva->color = 'green';
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 3;
        $reserva->precio = 2400;
        $reserva->ingreso = "2020/02/15";
        $reserva->egreso = "2020/02/18";
        $reserva->estado = 0;
        $reserva->clientes_id = 28;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->habitaciones_id = 11;
        $reserva->users_id  = 1;
        $reserva->color = 'green';
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 3;
        $reserva->precio = 5000;
        $reserva->ingreso = "2020/01/10";
        $reserva->egreso = "2020/01/12";
        $reserva->estado = 0;
        $reserva->clientes_id = 28;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->habitaciones_id = 8;
        $reserva->users_id  = 1;
        $reserva->color = 'green';
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 3;
        $reserva->precio = 1500;
        $reserva->ingreso = "2019/11/15";
        $reserva->egreso = "2019/11/18";
        $reserva->estado = 0;
        $reserva->clientes_id = 50;
        $reserva->preciosHabitaciones_id = 3;
        $reserva->habitaciones_id = 2;
        $reserva->users_id  = 2;
        $reserva->color = 'green';
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 3;
        $reserva->precio = 1500;
        $reserva->ingreso = "2019/12/03";
        $reserva->egreso = "2019/12/05";
        $reserva->estado = 0;
        $reserva->clientes_id = 29;
        $reserva->preciosHabitaciones_id = 4;
        $reserva->habitaciones_id = 2;
        $reserva->users_id  = 2;
        $reserva->color = 'green';
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 3;
        $reserva->precio = 1500;
        $reserva->ingreso = "2019/10/3";
        $reserva->egreso = "2019/10/6";
        $reserva->estado = 0;
        $reserva->clientes_id = 55;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->habitaciones_id = 2;
        $reserva->users_id  = 2;
        $reserva->color = 'green';
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 3;
        $reserva->precio = 1500;
        $reserva->ingreso = "2020/04/15";
        $reserva->egreso = "2020/04/18";
        $reserva->estado = 0;
        $reserva->clientes_id = 50;
        $reserva->preciosHabitaciones_id = 3;
        $reserva->habitaciones_id = 2;
        $reserva->users_id  = 2;
        $reserva->color = 'green';
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 3;
        $reserva->precio = 1500;
        $reserva->ingreso = "2020/04/20";
        $reserva->egreso = "2020/04/23";
        $reserva->estado = 0;
        $reserva->clientes_id = 4;
        $reserva->preciosHabitaciones_id = 4;
        $reserva->habitaciones_id = 4;
        $reserva->users_id  = 1;
        $reserva->color = 'green';
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 3;
        $reserva->precio = 1500;
        $reserva->ingreso = "2020/02/25";
        $reserva->egreso = "2020/02/26";
        $reserva->estado = 0;
        $reserva->clientes_id = 57;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->habitaciones_id = 7;
        $reserva->users_id  = 1;
        $reserva->color = 'green';
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 3;
        $reserva->precio = 1500;
        $reserva->ingreso = "2020/02/5";
        $reserva->egreso = "2020/02/6";
        $reserva->estado = 0;
        $reserva->clientes_id = 57;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->habitaciones_id = 6;
        $reserva->users_id  = 1;
        $reserva->color = 'green';
        $reserva->created_at = now();

        $reserva->save();

        $reserva = new Reserva();
        $reserva->huespedes = 3;
        $reserva->precio = 1500;
        $reserva->ingreso = "2020/05/5";
        $reserva->egreso = "2020/05/6";
        $reserva->estado = 0;
        $reserva->clientes_id = 57;
        $reserva->preciosHabitaciones_id = 2;
        $reserva->habitaciones_id = 9;
        $reserva->users_id  = 1;
        $reserva->color = 'green';
        $reserva->created_at = now();

        $reserva->save();
    }
}
