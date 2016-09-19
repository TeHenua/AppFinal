<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');   //primary
            $table->integer('num_socio')->nullable();
            $table->integer('socio_id')->unsigned();
            $table->string('dni',9)->nullable();
            $table->string('nombre');
            $table->string('apellido1');
            $table->string('apellido2')->nullable();
            $table->date('fecha_nac');
            $table->string('lugar_nac');
            $table->string('direccion');
            $table->string('localidad');
            $table->string('codigo_pos',5);
            $table->string('colegio')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('diagnostico');
            $table->string('grado_discapacidad')->nullable();
            $table->string('grado_dependencia')->nullable();
            $table->string('demanda')->nullable();
            $table->string('num_ss');
            $table->date('primera_entrevista');
            $table->timestamps();


            $table->foreign('socio_id')->references('id')->on('socios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
    }
}
