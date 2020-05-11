<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumos', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('cantidad')->default(1);
            $table->double('precio');
            $table->boolean('pagado');

            $table->unsignedBigInteger('cajas_id');
            $table->foreign('cajas_id')->references('id')->on('cajas');

            $table->unsignedBigInteger('reservas_id');
            $table->foreign('reservas_id')->references('id')->on('reservas');

            $table->unsignedSmallInteger('productos_id');
            $table->foreign('productos_id')->references('id')->on('productos');

            $table->unsignedSmallInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');

            $table->unsignedSmallInteger('modosPagos_id')->nullable();
            $table->foreign('modospagos_id')->references('id')->on('modospagos');

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
        Schema::dropIfExists('consumos');
    }
}
