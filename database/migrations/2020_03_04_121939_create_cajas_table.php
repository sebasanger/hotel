<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();
            $table->double('montoApertura');
            $table->double('saldo')->nullable();
            $table->dateTime('horaCierre')->nullable();
            $table->double('montoCierre')->nullable();
            $table->boolean('cajaActiva');
            $table->unsignedSmallInteger('users_id');

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
        Schema::dropIfExists('cajas');
    }
}
