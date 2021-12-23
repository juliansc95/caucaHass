<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosOtras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Creando tabla de adecuacion y renovacion ".__LINE__."\n";
        Schema::create('adecuacionrenovacions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->date('fechaRegistro');                              
            $table->timestamps();
        });        

        Schema::table('adecuacionrenovacions', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });

        echo "Creando tabla de renovacion concepto ".__LINE__."\n";
        Schema::create('renovacionconceptos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('adecuacionrenovacion_id');
            $table->unsignedInteger('conceptoGasto_id');
            $table->text('descripcion')->nullable();
            $table->text('otro')->nullable();
            $table->decimal('valorTotal', 11, 2);
            $table->timestamps();
        });

        Schema::table('renovacionconceptos', function (Blueprint $table) {
            $table->foreign('adecuacionrenovacion_id')->references('id')->on('adecuacionrenovacions');
            $table->foreign('conceptoGasto_id')->references('id')->on('conceptoGastos');
        });  
        
        echo "Creando tabla de gastos de produccion, cosecha y poscosechas  ".__LINE__."\n";
        Schema::create('gastosproduccions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->date('fechaRegistro');                              
            $table->timestamps();
        });        

        Schema::table('gastosproduccions', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });

        echo "Creando tabla de produccion concepto ".__LINE__."\n";
        Schema::create('produccionconceptos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('gastosproduccion_id');
            $table->unsignedInteger('conceptoGasto_id');
            $table->text('descripcion')->nullable();
            $table->text('otro')->nullable();
            $table->decimal('valorTotal', 11, 2);
            $table->timestamps();
        });

        Schema::table('produccionconceptos', function (Blueprint $table) {
            $table->foreign('gastosproduccion_id')->references('id')->on('gastosproduccions');
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
        Schema::dropIfExists('renovacionconceptos');
        Schema::dropIfExists('adecuacionrenovacions');
        Schema::dropIfExists('produccionconceptos');
        Schema::dropIfExists('gastosproduccions');
    }
}
