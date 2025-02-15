<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->smallInteger('numeroHabitacion');
            $table->smallInteger('piso');
            $table->smallInteger('capacidad');
            $table->smallInteger('single')->nullable()->default(0);
            $table->smallInteger('doble')->nullable()->default(0);
            $table->string('image_path')->nullable();
            $table->string('image_path2')->nullable();
            $table->string('image_path3')->nullable();
            $table->smallInteger('estado')->default(1);
            $table->smallInteger('estadoLimpieza')->default(1);
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

        Schema::dropIfExists('habitaciones');
    }
}
