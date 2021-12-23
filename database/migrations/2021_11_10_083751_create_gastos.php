<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Creando tabla conceptos gasto ".__LINE__."\n";
        Schema::create('conceptoGastos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });


        echo "Creando tabla de gastos establecimiento ".__LINE__."\n";
        Schema::create('gastosEstablecimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->date('fechaRegistro');                              
            $table->timestamps();
        });

        

        Schema::table('gastosEstablecimientos', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });

        echo "Creando tabla de establecimiento concepto ".__LINE__."\n";
        Schema::create('establecimientoConceptos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('gastosEstablecimiento_id');
            $table->unsignedInteger('conceptoGasto_id');
            $table->text('descripcion')->nullable();
            $table->text('otro')->nullable();
            $table->decimal('valorTotal', 11, 2);
            $table->timestamps();
        });

        Schema::table('establecimientoConceptos', function (Blueprint $table) {
            $table->foreign('gastosEstablecimiento_id')->references('id')->on('gastosEstablecimientos');
            $table->foreign('conceptoGasto_id')->references('id')->on('conceptoGastos');
        });    

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establecimientoConceptos');
        Schema::dropIfExists('gastosEstablecimientos');
        Schema::dropIfExists('conceptoGastos');
    }
}
