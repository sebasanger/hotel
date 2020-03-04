<?php

use App\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = new Categoria();
        $categoria->categoria = "Gaseosa";

        $categoria->save();

        $categoria = new Categoria();
        $categoria->categoria = "Cerveza";

        $categoria->save();

        $categoria = new Categoria();
        $categoria->categoria = "Artesania";

        $categoria->save();

        $categoria = new Categoria();
        $categoria->categoria = "Desayuno";

        $categoria->save();
    }
}
