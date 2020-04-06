<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresoProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresosProductos', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('cantidadIngreso');
            $table->smallInteger('precioCompra')->nullable();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('productos_id');
            $table->unsignedInteger('modosPagos_id')->default(1);

            $table->foreign('users_id')
                ->references('id')->on('users');

            $table->foreign('productos_id')
                ->references('id')->on('productos');

            $table->foreign('modosPagos_id')
                ->references('id')->on('modosPagos');

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
        Schema::dropIfExists('ingresosProductos');
    }
}
