<?php

use App\PrecioHabitacion;
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
        
    }
}
