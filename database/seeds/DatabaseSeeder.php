<?php

use App\Cliente;
use App\IngresoProducto;
use App\ModoPago;
use App\PrecioHabitacion;
use App\Producto;
use App\Reserva;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);

        factory(User::class, 5)->create();

        $this->call(PrecioHabitacionSeeder::class);

        $this->call(MotivoSeeder::class);

        $this->call(CategoriaSeeder::class);

        $this->call(FacturaSeeder::class);

        $this->call(MarcaSeeder::class);

        $this->call(ModoPagoSeeder::class);

        $this->call(HabitacionSeeder::class);

        factory(Cliente::class, 200)->create();

        $this->call(ProductoSeeder::class);
        
        $this->call(CajaSeeder::class);

        $this->call(ReservaSeeder::class);

        $this->call(ConsumoSeeder::class);
    
        $this->call(PagoSeeder::class);

        $this->call(IngresoProductoSeeder::class);

        $this->call(MovimientoSeeder::class);
    }
}
