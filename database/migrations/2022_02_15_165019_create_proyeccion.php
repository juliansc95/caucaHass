<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyeccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Creando tabla de proyeccion".__LINE__."\n";
        Schema::create('proyeccions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->integer('arbolesLoteUno');
            $table->integer('EdadArbolesLoteUno');
            $table->integer('kgProyectadoLoteUno');
            $table->integer('arbolesLoteDos');
            $table->integer('EdadArbolesLoteDos');
            $table->integer('kgProyectadoLoteDos');   
            $table->timestamps();
        });

        Schema::table('proyeccions', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyeccions');
    }
}
