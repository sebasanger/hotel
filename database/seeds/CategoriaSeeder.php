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
        $categoria->created_at = now();

        $categoria->save();

        $categoria = new Categoria();
        $categoria->categoria = "Cerveza";
        $categoria->created_at = now();

        $categoria->save();

        $categoria = new Categoria();
        $categoria->categoria = "Artesania";
        $categoria->created_at = now();

        $categoria->save();

        $categoria = new Categoria();
        $categoria->categoria = "Desayuno";
        $categoria->created_at = now();

        $categoria->save();
    }
}
