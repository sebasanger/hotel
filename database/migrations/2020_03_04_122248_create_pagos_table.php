<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->double('monto');
            $table->unsignedBigInteger('cajas_id');
		    $table->unsignedBigInteger('reservas_id')->unsigned();
		    $table->unsignedBigInteger('users_id')->unsigned();
            $table->unsignedInteger('modosPagos_id');

            $table->foreign('cajas_id')
		        ->references('id')->on('cajas');
		
		    $table->foreign('reservas_id')
		        ->references('id')->on('reservas');
		
		    $table->foreign('users_id')
		        ->references('id')->on('users');
		
		    $table->foreign('modospagos_id')
		        ->references('id')->on('modospagos');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
