<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_turnos', function (Blueprint $table) {
            $table->increments('id');
            $table->date("turno_fecha");
            $table->string("turno_estado",80);
            $table->string("dias",80);
            $table->string("hora_desde",80);
            $table->unsignedInteger('per_id');
            $table->unsignedInteger('espe_id');
            $table->integer('paciente_id');
            $table->foreign('espe_id')->references('id')->on('especialidads');
            $table->foreign('per_id')->references('id')->on('personals');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva_turnos');
    }
}
