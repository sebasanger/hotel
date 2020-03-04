<?php

use App\Motivo;
use Illuminate\Database\Seeder;

class MotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motivo = new Motivo();
        $motivo->motivo = "Negocios";

        $motivo->save();

        $motivo = new Motivo();
        $motivo->motivo = "Placer";

        $motivo->save();

        $motivo = new Motivo();
        $motivo->motivo = "Fiesta del inmigrante";

        $motivo->save();
    }
}
