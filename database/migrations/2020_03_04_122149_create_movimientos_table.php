<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',150);
            $table->double('monto');
            $table->boolean('ingreso');
            $table->boolean('egreso');

            $table->unsignedSmallInteger('users_id');
            $table->unsignedBigInteger('cajas_id');
            $table->unsignedSmallInteger('modosPagos_id');

            $table->foreign('modosPagos_id')
            ->references('id')->on('modosPagos');

            $table->foreign('cajas_id')
            ->references('id')->on('cajas');

            $table->foreign('users_id')
            ->references('id')->on('users');

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
        Schema::dropIfExists('movimientos');
    }
}
