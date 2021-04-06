<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("cantidad");
            $table->integer("reservados");
            $table->date('fecha_cupos');
            $table->unsignedInteger('per_id');
            $table->unsignedInteger('espe_id');
            $table->foreign('espe_id')->references('id')->on('especialidads');
            $table->foreign('per_id')->references('id')->on('personals');
  //          $table->foreign('agendamiento_id')->references('id')->on('agendamientos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cupos');
    }
}
