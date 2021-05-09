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
            $table->string("horas",15);
            $table->integer("reservados");
            $table->date('fecha_cupos');
            $table->unsignedInteger('agendamiento_id');
            $table->foreign('agendamiento_id')->references('id')->on('agendamientos');
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
