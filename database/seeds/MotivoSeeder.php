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
        $motivo->created_at = now();

        $motivo->save();

        $motivo = new Motivo();
        $motivo->motivo = "Placer";
        $motivo->created_at = now();

        $motivo->save();

        $motivo = new Motivo();
        $motivo->motivo = "Fiesta del inmigrante";
        $motivo->created_at = now();

        $motivo->save();

        $motivo = new Motivo();
        $motivo->motivo = "Estudio";
        $motivo->created_at = now();

        $motivo->save();

        $motivo = new Motivo();
        $motivo->motivo = "Congreso";
        $motivo->created_at = now();

        $motivo->save();

        $motivo = new Motivo();
        $motivo->motivo = "Razones medicas";
        $motivo->created_at = now();

        $motivo->save();
    }
}
