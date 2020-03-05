<?php

use App\Marca;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marca = new Marca();
        $marca->marca = "Cocacola";
        $marca->created_at = now();

        $marca->save();

        $marca = new Marca();
        $marca->marca = "Pepsi";
        $marca->created_at = now();

        $marca->save();

        $marca = new Marca();
        $marca->marca = "Sancor";
        $marca->created_at = now();

        $marca->save();

        $marca = new Marca();
        $marca->marca = "Serenisima";
        $marca->created_at = now();

        $marca->save();

        $marca = new Marca();
        $marca->marca = "quilmes";
        $marca->created_at = now();

        $marca->save();

        $marca = new Marca();
        $marca->marca = "Andes";
        $marca->created_at = now();

        $marca->save();

        $marca = new Marca();
        $marca->marca = "Brahama";
        $marca->created_at = now();

        $marca->save();

        $marca = new Marca();
        $marca->marca = "Eco de los Andes";
        $marca->created_at = now();

        $marca->save();
    }
}
