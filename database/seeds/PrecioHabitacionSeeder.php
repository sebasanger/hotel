<?php

use App\PrecioHabitacion;
use Illuminate\Database\Seeder;

class PrecioHabitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $precio = new PrecioHabitacion();
        $precio->precioHabitacion = 1200;
        $precio->descripcion = "habitacion single";

        $precio->save();

        $precio = new PrecioHabitacion();
        $precio->precioHabitacion = 1500;
        $precio->descripcion = "habitacion doble";

        $precio->save();

        $precio = new PrecioHabitacion();
        $precio->precioHabitacion = 2000;
        $precio->descripcion = "habitacion triple";

        $precio->save();

        $precio = new PrecioHabitacion();
        $precio->precioHabitacion = 2400;
        $precio->descripcion = "habitacion cuadruple";

        $precio->save();

        $precio = new PrecioHabitacion();
        $precio->precioHabitacion = 1000;
        $precio->descripcion = "habitacion single viajante";

        $precio->save();
    }
}
