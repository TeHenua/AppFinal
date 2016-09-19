<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socios', function (Blueprint $table) {
            $table->increments('id');   //primary
            $table->integer('num_socio')->nullable();
            $table->string('dni',9);
            $table->string('nombre');
            $table->string('apellido1');
            $table->string('apellido2')->nullable();
            $table->date('fecha_nac');
            $table->string('lugar_nac')->nullable();
            $table->string('direccion');
            $table->string('localidad');
            $table->string('codigo_pos',5);
            $table->string('fijo',9)->nullable();
            $table->string('movil',9)->nullable();
            $table->string('email')->nullable();
            $table->string('tipo_socio');
            $table->string('num_cuenta',24);
            $table->string('tipo_comunicacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('socios');
    }
}
