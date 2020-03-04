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
		    $table->string('dni', 20)->unique();
		    $table->date('fechaNacimiento')->nullable();
		    $table->string('celular', 20)->nullable();
		    $table->string('email', 60)->nullable();
		    $table->string('cuit', 20)->nullable();
            $table->unsignedInteger('facturas_id')->nullable();
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
