<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
		    $table->string('nombre', 80);
		    $table->string('apellido', 80);
		    $table->string('dni', 40)->unique();
		    $table->date('fechaNacimiento')->nullable();
		    $table->string('celular', 40)->nullable();
		    $table->string('email', 60)->nullable();
            $table->string('cuit', 40)->nullable();
            $table->string('procedencia', 80)->nullable();
            $table->string('domicilio', 80)->nullable();
            $table->string('destino', 80)->nullable();
            $table->string('profecion', 80)->nullable();
            $table->unsignedSmallInteger('facturas_id')->nullable();
            $table->foreign('facturas_id')
            ->references('id')->on('facturas');

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
        Schema::dropIfExists('clientes');
    }
}
