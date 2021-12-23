<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaracterizacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Creando tabla predioCultivos ".__LINE__."\n";
        Schema::create('predioCultivos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->decimal('areaSembradaPredio', 11, 2);
            $table->date('fechaSiembra');
            $table->integer('numeroPlantasTotales')->nullable(); 
            $table->integer('numeroPlantasProduccion')->nullable(); 
            $table->integer('plantasErradicadas')->nullable();
            $table->integer('plantasLevante')->nullable();  
            $table->string('TipoMora')->nullable(); 
            $table->unsignedInteger('vereda_id')->nullable(); 
            $table->string('tipoReproduccion')->nullable(); 
            $table->string('bolsa')->nullable();             
            $table->timestamps();
        });

        Schema::table('predioCultivos', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
            $table->foreign('vereda_id')->references('id')->on('veredas');
        });

        echo "Creando tabla podas ".__LINE__."\n";
        Schema::create('podas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->string('estadoVegetativo')->nullable(); 
            $table->string('podaFormacion')->nullable(); 
            $table->string('podaAclareo')->nullable(); 
            $table->integer('frecuenciaAclareo')->nullable(); 
            $table->string('podaMantenimiento')->nullable();
            $table->integer('frecuenciaMantenimiento')->nullable(); 
            $table->string('podaFitosanitaria')->nullable(); 
            $table->integer('frecuenciaFitosanitaria')->nullable();             
            $table->timestamps();
        });

        Schema::table('podas', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });

        echo "Creando tabla plagas ".__LINE__."\n";
        Schema::create('plagas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->string('monitoreo')->nullable(); 
            $table->integer('frecuenciaMonitoreo')->nullable(); 
            $table->string('perlaTierra')->nullable(); 
            $table->string('tipoManejoPerla')->nullable(); 
            $table->integer('frecuenciaAplicacionPerla')->nullable(); 
            $table->string('barrenadorCultivo')->nullable(); 
            $table->string('tipoManejoBarrenador')->nullable(); 
            $table->integer('frecuenciaAplicacionBarrenador')->nullable(); 
            $table->string('tripsCultivo')->nullable(); 
            $table->string('tipoManejoTrips')->nullable(); 
            $table->integer('frecuenciaAplicacionTrips')->nullable(); 
            $table->string('afidiosCultivos')->nullable(); 
            $table->string('tipoManejoAfidios')->nullable(); 
            $table->integer('frecuenciaAplicacionAfidios')->nullable();               
            $table->string('acarosCultivos')->nullable(); 
            $table->string('tipoManejoAcaros')->nullable(); 
            $table->integer('frecuenciaAplicacionAcaros')->nullable();   
            $table->string('cochinillaCultivos')->nullable(); 
            $table->string('tipoManejoCochinilla')->nullable(); 
            $table->integer('frecuenciaAplicacionCochinilla')->nullable();             
            $table->timestamps();
        });

        Schema::table('plagas', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });


        echo "Creando tabla nutricion ".__LINE__."\n";
        Schema::create('nutricions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->string('analisis')->nullable(); 
            $table->date('fechaAnalisis')->nullable(); 
            $table->string('fertilizaAnalisis')->nullable(); 
            $table->string('aplicacionesCal')->nullable(); 
            $table->string('aplicoSiembraCal')->nullable(); 
            $table->decimal('dosisAplicacionCal',11,2)->nullable();
            $table->string('formaAplicacionCal')->nullable();
            $table->integer('frecuenciaAplicacionCal')->nullable();
            $table->date('fechaCal')->nullable();
            $table->string('aplicacionesMateriaOrganica')->nullable(); 
            $table->string('aplicoSiembraMateriaOrganica')->nullable(); 
            $table->decimal('dosisAplicacionMateriaOrganica',11,2)->nullable();
            $table->string('formaAplicacionMateriaOrganica')->nullable();
            $table->integer('frecuenciaAplicacionMateriaOrganica')->nullable();
            $table->date('fechaMateriaOrganica')->nullable();
            $table->date('fechaUltimaFertilizacion')->nullable();
            $table->string('formaAplicacionFert')->nullable();  
            $table->integer('frecuenciaAplicacionFert')->nullable();
            $table->timestamps();
        });

        Schema::table('nutricions', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });


        echo "Creando tabla tutorado ".__LINE__."\n";
        Schema::create('tutorados', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->string('tutorado')->nullable(); 
            $table->string('tipoTutorado')->nullable(); 
            $table->string('tipoMadera')->nullable(); 
            $table->timestamps();
        });

        Schema::table('tutorados', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });

        
        echo "Creando tabla riegos ".__LINE__."\n";
        Schema::create('riegos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->string('riego')->nullable(); 
            $table->integer('adquisicion')->nullable(); 
            $table->string('frecuencia')->nullable(); 
            $table->string('tipo')->nullable(); 
            $table->integer('tiempo')->nullable(); 
            $table->integer('jornales')->nullable();             
            $table->timestamps();
        });

        Schema::table('riegos', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });

        echo "Creando tabla practicas ".__LINE__."\n";
        Schema::create('practicas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->string('vivenda')->nullable(); 
            $table->string('viveSitio')->nullable(); 
            $table->string('bateriaSanitaria')->nullable(); 
            $table->string('pozoSeptico')->nullable(); 
            $table->string('zonaBarbecho')->nullable(); 
            $table->string('usaBarbecho')->nullable();
            $table->string('agroquimicos')->nullable();
            $table->string('mezclaAgroquimicos')->nullable();
            $table->string('usaAgroquimicos')->nullable();
            $table->string('bodegaMateriales')->nullable();
            $table->string('usaBodega')->nullable();
            $table->string('canastillas')->nullable();
            $table->string('usaCanastillas')->nullable();
            $table->string('trajeProteccion')->nullable();
            $table->string('usaTraje')->nullable();
            $table->string('puntoEcologico')->nullable();
            $table->string('usaPuntoEcologico')->nullable();
            $table->string('botiquin')->nullable();
            $table->string('usaBotiquin')->nullable();
            $table->string('extintor')->nullable();
            $table->string('usaExtintor')->nullable();
            $table->string('capacitacionesBPA')->nullable();
            $table->string('certificadas')->nullable();
            $table->string('institucionCertificado')->nullable();
            $table->timestamps();
        });

        Schema::table('practicas', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });

        echo "Creando tabla suelos ".__LINE__."\n";
        Schema::create('suelos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->string('curvasNivel')->nullable(); 
            $table->string('controlArvenses')->nullable(); 
            $table->integer('frecuencia')->nullable(); 
            $table->string('herbicida')->nullable(); 
            $table->decimal('dosisAplicacionCal',11,2)->nullable();
            $table->integer('frecuenciaHerbicida')->nullable();
            $table->timestamps();
        });

        Schema::table('suelos', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });


        echo "Creando tabla vocacion ".__LINE__."\n";
        Schema::create('vocacions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->string('vocacion')->nullable(); 
            $table->integer('tiempo')->nullable(); 
            $table->string('practicaBasica')->nullable(); 
            $table->string('capacitacionRefuerzo')->nullable();
            $table->string('temasRefuerzo')->nullable();
            $table->integer('diasMora')->nullable(); 
            $table->string('labores')->nullable();
            $table->string('motivo')->nullable();
            $table->timestamps();
        });

        Schema::table('vocacions', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });

        echo "Creando tabla cosechas ".__LINE__."\n";
        Schema::create('cosechas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->integer('frecuencia')->nullable(); 
            $table->string('clasificacion')->nullable(); 
            $table->string('empaque')->nullable();
            $table->string('transporte')->nullable(); 
            $table->integer('kilogramoMoraPrimera')->nullable();
            $table->integer('kilogramoMoraSegunda')->nullable();
            $table->integer('mesesProduccion')->nullable();
            $table->string('clientes')->nullable(); 
            $table->string('tiempoPago')->nullable();
            $table->string('tipoPago')->nullable();
            $table->timestamps();
        });

        Schema::table('cosechas', function (Blueprint $table) {
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
        Schema::dropIfExists('predioCultivo');
        Schema::dropIfExists('podas');
        Schema::dropIfExists('plagas');
        Schema::dropIfExists('nutricions');
        Schema::dropIfExists('tutorados');
        Schema::dropIfExists('riegos');
        Schema::dropIfExists('practicas');
        Schema::dropIfExists('suelos');
        Schema::dropIfExists('vocacions');
        Schema::dropIfExists('cosechas');
    }
}
