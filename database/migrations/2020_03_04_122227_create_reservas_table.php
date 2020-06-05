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
            $table->date('egreso');
            $table->date('ingreso');
            $table->dateTime('checkin')->nullable();
            $table->dateTime('checkout')->nullable();
            $table->string('patenteAuto', 20)->nullable();
            $table->string('color', 40)->default('blue');
            $table->tinyInteger('estado')->default(1);
            $table->double('totalPagar')->nullable();
            $table->double('pagado')->nullable()->default(0);
            $table->string('procedencia', 80)->nullable();
            $table->string('destino', 80)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unsignedSmallInteger('users_id');
            $table->foreign('users_id')
                ->references('id')->on('users');

            $table->unsignedBigInteger('clientes_id');
            $table->foreign('clientes_id')
                ->references('id')->on('clientes');

            $table->unsignedSmallInteger('motivos_id')->nullable();
            $table->foreign('motivos_id')
                ->references('id')->on('motivos');

            $table->unsignedSmallInteger('preciosHabitaciones_id');
            $table->foreign('preciosHabitaciones_id')
                ->references('id')->on('preciosHabitaciones');

            $table->unsignedSmallInteger('habitaciones_id');
            $table->foreign('habitaciones_id')
                ->references('id')->on('habitaciones');
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
