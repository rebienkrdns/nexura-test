<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id()->comment('Identificador del empleado');
            $table->string('nombre')->comment('Nombre completo del empleado');
            $table->string('email')->comment('Correo electrónico del empleado');
            $table->char('sexo', 1);
            $table->unsignedBigInteger('area_id')->comment('Área de la empresa a la que pertenece el empleado');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('RESTRICT')->onUpdate('CASCADE');
            $table->tinyInteger('boletin');
            $table->text('descripcion')->comment('Se escribe la experiencia del empleado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
