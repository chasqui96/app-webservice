<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->increments('id');
            $table->string("per_nombre",80);
            $table->string("per_apellido",80);
            $table->string("per_cedula",60);
            $table->string("per_telefono",60);
            $table->string("tipo_persona",30);
            $table->string("per_estado",30);
            $table->string("user",30);
            $table->string("pass",120);
            $table->string("nivel",30);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personals');
    }
}
