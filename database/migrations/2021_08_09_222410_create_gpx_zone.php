<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGpxZone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Creando tabla gpx zones ".__LINE__."\n";
        Schema::create('gpxzones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->string('linea');
            $table->timestamps();
        });

        Schema::table('gpxzones', function (Blueprint $table) {
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
        Schema::dropIfExists('gpxzones');
    }
}
