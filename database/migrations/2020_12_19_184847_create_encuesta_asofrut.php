<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncuestaAsofrut extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        echo "Creando tabla encuesta asofrut ".__LINE__."\n";
        Schema::create('encuestaAsofruts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->string('certificacion1')->nullable(); 
            $table->string('certificacion2')->nullable(); 
            $table->string('ecosistemas1')->nullable(); 
            $table->string('ecosistemas2')->nullable(); 
            $table->string('ecosistemas3')->nullable(); 
            $table->integer('ecosistemas4')->nullable();
            $table->string('ecosistemas5')->nullable();
            $table->string('ecosistemas6')->nullable(); 
            $table->string('ecosistemas7')->nullable(); 
            $table->string('ecosistemas8')->nullable();
            $table->string('silvestre1')->nullable(); 
            $table->string('silvestre2')->nullable();
            $table->string('silvestre3')->nullable();
            $table->string('silvestre4')->nullable();
            $table->string('silvestre5')->nullable();
            $table->string('silvestre6')->nullable();
            $table->string('silvestre7')->nullable();
            $table->string('silvestre8')->nullable();
            $table->string('silvestre9')->nullable();
            $table->string('silvestre10')->nullable();
            $table->string('silvestre11')->nullable();
            $table->string('silvestre12')->nullable();
            $table->string('silvestre13')->nullable();
            $table->string('silvestre14')->nullable();
            $table->string('silvestre15')->nullable();
            $table->string('silvestre16')->nullable();
            $table->string('silvestre17')->nullable();
            $table->string('silvestre18')->nullable();
            $table->string('silvestre19')->nullable();
            $table->string('silvestre20')->nullable();
            $table->string('conservacion1')->nullable();
            $table->string('conservacion2')->nullable();
            $table->string('conservacion3')->nullable();
            $table->string('conservacion4')->nullable();
            $table->string('conservacion5')->nullable();
            $table->string('conservacion6')->nullable();
            $table->string('desechos1')->nullable();
            $table->string('desechos2')->nullable();
            $table->string('desechos3')->nullable();
            $table->string('desechos4')->nullable();
            $table->string('cultivo')->nullable();
            $table->timestamps();

        });

        Schema::table('encuestaAsofruts', function (Blueprint $table) {
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
        Schema::dropIfExists('encuestaAsofruts');
    }
}
