<?php

use App\Habitacion;
use Illuminate\Database\Seeder;

class HabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 100;
        $habitacion->piso = 1;
        $habitacion->capacidad = 1;
        $habitacion->single = 1;
        $habitacion->doble = 0;
        $habitacion->estado = 1;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 101;
        $habitacion->piso = 1;
        $habitacion->capacidad = 1;
        $habitacion->single = 1;
        $habitacion->doble = 0;
        $habitacion->estado = 1;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 102;
        $habitacion->piso = 1;
        $habitacion->capacidad = 2;
        $habitacion->single = 0;
        $habitacion->doble = 1;
        $habitacion->estado = 0;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 103;
        $habitacion->piso = 1;
        $habitacion->capacidad = 3;
        $habitacion->single = 1;
        $habitacion->doble = 1;
        $habitacion->estado = 0;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 104;
        $habitacion->piso = 1;
        $habitacion->capacidad = 4;
        $habitacion->single = 2;
        $habitacion->doble = 1;
        $habitacion->estado = 1;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 105;
        $habitacion->piso = 1;
        $habitacion->capacidad = 1;
        $habitacion->single = 1;
        $habitacion->doble = 0;
        $habitacion->estado = 1;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 201;
        $habitacion->piso = 2;
        $habitacion->capacidad = 1;
        $habitacion->single = 1;
        $habitacion->doble = 0;
        $habitacion->estado = 0;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 202;
        $habitacion->piso = 2;
        $habitacion->capacidad = 2;
        $habitacion->single = 2;
        $habitacion->doble = 0;
        $habitacion->estado = 1;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 203;
        $habitacion->piso = 2;
        $habitacion->capacidad = 3;
        $habitacion->single = 1;
        $habitacion->doble = 1;
        $habitacion->estado = 1;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 204;
        $habitacion->piso = 2;
        $habitacion->capacidad = 1;
        $habitacion->single = 2;
        $habitacion->doble = 1;
        $habitacion->estado = 1;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 205;
        $habitacion->piso = 2;
        $habitacion->capacidad = 2;
        $habitacion->single = 0;
        $habitacion->doble = 1;
        $habitacion->estado = 1;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 301;
        $habitacion->piso = 3;
        $habitacion->capacidad = 1;
        $habitacion->single = 1;
        $habitacion->doble = 0;
        $habitacion->estado = 1;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 302;
        $habitacion->piso = 3;
        $habitacion->capacidad = 2;
        $habitacion->single = 0;
        $habitacion->doble = 1;
        $habitacion->estado = 0;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 303;
        $habitacion->piso = 3;
        $habitacion->capacidad = 3;
        $habitacion->single = 1;
        $habitacion->doble = 1;
        $habitacion->estado = 1;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 304;
        $habitacion->piso = 3;
        $habitacion->capacidad = 4;
        $habitacion->single = 2;
        $habitacion->doble = 1;
        $habitacion->estado = 1;
        $habitacion->created_at = now();

        $habitacion->save();

        $habitacion = new Habitacion();
        $habitacion->numeroHabitacion = 305;
        $habitacion->piso = 3;
        $habitacion->capacidad = 3;
        $habitacion->single = 1;
        $habitacion->doble = 1;
        $habitacion->estado = 0;
        $habitacion->created_at = now();

        $habitacion->save();
    }
}
