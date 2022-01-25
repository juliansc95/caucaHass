<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaucahassCore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Creando tabla de tipoIds ".__LINE__."\n";
        Schema::create('tipoIds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        echo "Creando tabla de sexo ".__LINE__."\n";
        Schema::create('sexos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        echo "Creando tabla de etnia ".__LINE__."\n";
        Schema::create('etnias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        echo "Creando tabla de  grado escolaridad ".__LINE__."\n";
        Schema::create('gradoEscolaridads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        

        echo "Creando tabla de  resguardos".__LINE__."\n";
        Schema::create('resguardos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        echo "Creando tabla de  departamentos".__LINE__."\n";
        Schema::create('departamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        echo "Creando tabla de  municipios".__LINE__."\n";
        Schema::create('municipios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->unsignedInteger('departamento_id');
            $table->timestamps();
        });
    
        Schema::table('municipios', function (Blueprint $table) {
            $table->foreign('departamento_id')->references('id')->on('departamentos');
        });

        echo "Creando tabla de  veredas ".__LINE__."\n";
        Schema::create('veredas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->unsignedInteger('municipio_id');
            $table->timestamps();
        });
        Schema::table('veredas', function (Blueprint $table) {
            $table->foreign('municipio_id')->references('id')->on('municipios');
        });

        echo "Creando tabla de  posesion".__LINE__."\n";
        Schema::create('posesions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        echo "Creando tabla de  linea productiva".__LINE__."\n";
        Schema::create('lineas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        echo "Creando tabla de  cadena de valor".__LINE__."\n";
        Schema::create('cadenas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        echo "Creando tabla de  lugares de venta".__LINE__."\n";
        Schema::create('lugarVentas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        echo "Creando tabla de productos comerciales quimicos".__LINE__."\n";
        Schema::create('quimicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        echo "Creando tabla personas ".__LINE__."\n";
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100)->unique();
            $table->unsignedInteger('tipo_id');
            $table->string('num_documento', 20)->nullable();
            $table->string('direccion', 70)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->timestamps();
        });
        Schema::table('personas', function (Blueprint $table) {
            $table->foreign('tipo_id')->references('id')->on('tipoIds');
        });


        echo "Creando tabla de productores ".__LINE__."\n";
        Schema::create('productors', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->date('fechaExpedicion');
            $table->date('fechaNacimiento');
            $table->unsignedInteger('sexo_id');
            $table->unsignedInteger('departamento_id');
            $table->unsignedInteger('municipio_id');
            $table->string('vereda');
            $table->date('fechaIngreso');
            $table->foreign('id')->references('id')->on('personas')->onDelete('cascade');
        });

        Schema::table('productors', function (Blueprint $table) {
            $table->foreign('sexo_id')->references('id')->on('sexos');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('municipio_id')->references('id')->on('municipios');
        });

        echo "Creando tabla de fincas ".__LINE__."\n";
        Schema::create('fincas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->unsignedInteger('productor_id');
            $table->decimal('areaPredio', 11, 2);
            $table->decimal('longitudPredio', 11, 6);
            $table->decimal('latitudPredio', 11, 6);
            $table->decimal('altitudPredio', 11, 2);
            $table->unsignedInteger('departamento_id');
            $table->unsignedInteger('municipio_id');
            $table->string('vereda');
            $table->unsignedInteger('posesion_id');
            $table->decimal('distanciaAlLote', 11, 2);
            $table->decimal('distanciaLoteVia', 11, 2);
            $table->string('coordenadasFinca')->nullable();                 
            $table->timestamps();
        });

        Schema::table('fincas', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('posesion_id')->references('id')->on('posesions');
        });

        echo "Creando tabla de aplicacion fertilizantes ".__LINE__."\n";
        Schema::create('fertilizantes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->date('fechaAplicacion');
            $table->string('nombreProducto');
            $table->string('nombreIngenieroAgronomo');
            $table->string('concentracion');
            $table->string('RegistroICA');
            $table->integer('Dosis');
            $table->string('formaAplicacion');
            $table->string('recomendo');
            $table->string('Aplico');            
            $table->timestamps();
        });

        Schema::table('fertilizantes', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
        });

        echo "Creando tabla de aplicacion quimicos ".__LINE__."\n";
        Schema::create('aplquimicos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->date('fechaAplicacion');
            $table->unsignedInteger('quimico_id');
            $table->string('nombreIngenieroAgronomo');
            $table->string('concentracion');
            $table->string('RegistroICA');
            $table->integer('Dosis');
            $table->integer('periodoCarencia');
            $table->integer('periodoEntrada');
            $table->string('formaAplicacion');
            $table->string('recomendo');
            $table->string('Aplico');            
            $table->timestamps();
        });

        Schema::table('aplquimicos', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
            $table->foreign('quimico_id')->references('id')->on('quimicos');
        });

       
      
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fertilizantes');
        Schema::dropIfExists('aplquimicos');
        Schema::dropIfExists('fincas');
        Schema::dropIfExists('productors');
        Schema::dropIfExists('personas');
        Schema::dropIfExists('lugarVentas');
        Schema::dropIfExists('cadenas');
        Schema::dropIfExists('lineas');
        Schema::dropIfExists('municipios');
        Schema::dropIfExists('departamentos');
        Schema::dropIfExists('resguardos');
        Schema::dropIfExists('veredas');
        Schema::dropIfExists('gradoEscolaridads');
        Schema::dropIfExists('etnias');
        Schema::dropIfExists('sexos');
        Schema::dropIfExists('tipoIds');
        Schema::dropIfExists('estadoVentas');
        Schema::dropIfExists('quimicos');
    }
}
