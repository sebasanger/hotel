<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('huespedes')->nullable();
            $table->double('precio');
            $table->date('egreso')->nullable();
            $table->string('patenteAuto',20)->nullable();
            $table->boolean('activa')->default(1);
            $table->double('totalPagar')->nullable();
            $table->double('pagado')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')
            ->references('id')->on('users');

            $table->unsignedBigInteger('clientes_id');
            $table->foreign('clientes_id')
            ->references('id')->on('clientes');

            $table->unsignedInteger('motivos_id');
            $table->foreign('motivos_id')
            ->references('id')->on('motivos');

            $table->unsignedInteger('preciosHabitaciones_id');
            $table->foreign('preciosHabitaciones_id')
            ->references('id')->on('preciosHabitaciones');

            $table->unsignedInteger('habitaciones_id');
            $table->foreign('habitaciones_id')
            ->references('id')->on('preciosHabitaciones');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
