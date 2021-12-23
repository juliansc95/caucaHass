<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestaFitosanitaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Creando tabla de  productos fitosanitarios".__LINE__."\n";
        Schema::create('producto_fitosanitarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });
        echo "Creando tabla de  productos fitosanitarios".__LINE__."\n";
        Schema::create('unidad_dosis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });
        echo "Creando tabla de  productos fitosanitarios".__LINE__."\n";
        Schema::create('unidad_aplicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });
        echo "Creando tabla de  productos fitosanitarios".__LINE__."\n";
        Schema::create('equipo_aplicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });
        echo "Creando tabla de  productos fitosanitarios".__LINE__."\n";
        Schema::create('metodo_aplicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        echo "Creando tabla de encuesta fitosanitaria ".__LINE__."\n";
        Schema::create('encuesta_fitosanitarias', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->date('fechaControl');
            $table->string('productoSembrado')->nullable(); 
            $table->integer('lote')->nullable(); 
            $table->unsignedInteger('linea_id');
            $table->integer('numeroPlantas')->nullable();
            $table->unsignedInteger('producto_fitosanitario_id');
            $table->decimal('cantidad_dosis',11, 2)->nullable();
            $table->unsignedInteger('unidad_dosis_id')->nullable();
            $table->decimal('cantidad_aplicacion',11, 2)->nullable();
            $table->unsignedInteger('unidad_aplicaciones_id')->nullable(); 
            $table->unsignedInteger('equipo_aplicaciones_id')->nullable();
            $table->unsignedInteger('metodo_aplicaciones_id')->nullable();
    
        });

        Schema::table('encuesta_fitosanitarias', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
            $table->foreign('linea_id')->references('id')->on('lineas');
            $table->foreign('producto_fitosanitario_id')->references('id')->on('producto_fitosanitarios');
            $table->foreign('unidad_dosis_id')->references('id')->on('unidad_dosis');
            $table->foreign('unidad_aplicaciones_id')->references('id')->on('unidad_aplicaciones');
            $table->foreign('equipo_aplicaciones_id')->references('id')->on('equipo_aplicaciones');
            $table->foreign('metodo_aplicaciones_id')->references('id')->on('metodo_aplicaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_fitosanitarios');
        Schema::dropIfExists('unidad_dosis');
        Schema::dropIfExists('unidad_aplicaciones');
        Schema::dropIfExists('equipo_aplicaciones');
        Schema::dropIfExists('metodo_aplicaciones');
        Schema::dropIfExists('encuesta_fitosanitarias');
    }
}
