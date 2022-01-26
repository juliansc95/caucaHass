<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFertilizantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Creando tabla de fertilizantes".__LINE__."\n";
        Schema::create('productosFertilizantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productosFertilizantes');
    }
}
