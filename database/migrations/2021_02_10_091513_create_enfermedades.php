<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnfermedades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Creando tabla Enfermedades ".__LINE__."\n";
        Schema::create('Enfermedads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->string('monitoreo')->nullable();
            $table->integer('frecuenciaMonitoreo')->nullable();  
            $table->string('antracnosis')->nullable();
            $table->string('tipoManejoAntra')->nullable();
            $table->integer('frecuenciaAntra')->nullable(); 
            $table->string('botritys')->nullable();
            $table->string('tipoManejoBotritys')->nullable();
            $table->integer('frecuenciaBotritys')->nullable();
            $table->string('mildeo')->nullable();
            $table->string('tipoManejoMildeo')->nullable();
            $table->integer('frecuenciaMildeo')->nullable();
            $table->string('mildeoVelloso')->nullable();
            $table->string('tipoManejoMildeoVelloso')->nullable();
            $table->integer('frecuenciaMildeoVelloso')->nullable();
            $table->string('adherentes')->nullable();
            $table->string('nombreAdherente')->nullable();
            $table->integer('dosisAplicacion')->nullable();        
            $table->timestamps();
        });

        Schema::table('practicas', function (Blueprint $table) {
            $table->integer('tiempo')->nullable()->after('institucionCertificado');;
        });

        Schema::table('riegos', function (Blueprint $table) {
            $table->string('reservorio')->nullable()->after('jornales');  
            $table->integer('capacidadR')->nullable()->after('reservorio');
            $table->integer('alturaR')->nullable()->after('capacidadR');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Enfermedads');
    }
}
