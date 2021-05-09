<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("doc_registro",80);
            $table->string("espe_estado",80);
            $table->string("dias",80);
            $table->string("hora_desde");
            $table->string("hora_hasta");
            $table->unsignedInteger('per_id');
            $table->unsignedInteger('espe_id');
 //           $table->timestamps();

            $table->foreign('espe_id')->references('id')->on('especialidads');
            $table->foreign('per_id')->references('id')->on('personals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamientos');
    }
}
