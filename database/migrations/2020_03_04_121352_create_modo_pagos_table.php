<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModoPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modosPagos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('modoPago', 80);
		    $table->smallInteger('cantidadPagos')->nullable()->default(1);
            $table->string('descripcion', 45)->nullable();
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
        Schema::dropIfExists('modosPagos');
    }
}
