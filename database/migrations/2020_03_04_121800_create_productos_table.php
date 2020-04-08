<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('producto',120);
            $table->double('precio');
            $table->string('codigoProducto');
            $table->smallInteger('stock');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedSmallInteger('categorias_id')->nullable();
            $table->foreign('categorias_id')
            ->references('id')->on('categorias');

            $table->unsignedSmallInteger('marcas_id')->nullable();
            $table->foreign('marcas_id')
            ->references('id')->on('marcas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
