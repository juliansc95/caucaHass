<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsofrutCore extends Migration
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
            $table->unsignedInteger('etnia_id');
            $table->unsignedInteger('escolaridad_id');
            $table->unsignedInteger('departamento_id');
            $table->unsignedInteger('municipio_id');
            $table->unsignedInteger('vereda_id');
            $table->unsignedInteger('resguardo_id');
            $table->date('fechaIngreso');
            $table->string('fotocopiaCedula')->nullable();             
            $table->foreign('id')->references('id')->on('personas')->onDelete('cascade');
        });

        Schema::table('productors', function (Blueprint $table) {
            $table->foreign('sexo_id')->references('id')->on('sexos');
            $table->foreign('etnia_id')->references('id')->on('etnias');
            $table->foreign('escolaridad_id')->references('id')->on('gradoEscolaridads');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('vereda_id')->references('id')->on('veredas');
            $table->foreign('resguardo_id')->references('id')->on('resguardos');
        });

        echo "Creando tabla de fincas ".__LINE__."\n";
        Schema::create('fincas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('linea_id');
            $table->decimal('areaPredio', 11, 2);
            $table->decimal('longitudPredio', 11, 6);
            $table->decimal('latitudPredio', 11, 6);
            $table->decimal('altitudPredio', 11, 2);
            $table->unsignedInteger('departamento_id');
            $table->unsignedInteger('municipio_id');
            $table->unsignedInteger('vereda_id');
            $table->unsignedInteger('resguardo_id');
            $table->unsignedInteger('posesion_id');
            $table->decimal('distanciaAlLote', 11, 2);
            $table->decimal('distanciaLoteVia', 11, 2);
            $table->string('coordenadasFinca')->nullable();                 
            $table->timestamps();
        });

        Schema::table('fincas', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('linea_id')->references('id')->on('lineas');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('vereda_id')->references('id')->on('veredas');
            $table->foreign('resguardo_id')->references('id')->on('resguardos');
            $table->foreign('posesion_id')->references('id')->on('posesions');
        });

        echo "Creando tabla de cultivos ".__LINE__."\n";
        Schema::create('cultivos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('finca_id');
            $table->unsignedInteger('cadena_id');
            $table->decimal('areaSembrada', 11, 2);
            $table->date('fechaSiembra');
            $table->integer('numeroPlantulasArboles');
            $table->decimal('totalVentasKgAnioAnterior', 11, 2);
            $table->decimal('precioPromedio', 11, 2);
            $table->decimal('TotalVentasAnioAnterior', 11, 2);
            $table->unsignedInteger('lugarVenta_id');                 
            $table->timestamps();
        });

        Schema::table('cultivos', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('finca_id')->references('id')->on('fincas');
            $table->foreign('cadena_id')->references('id')->on('cadenas');
            $table->foreign('lugarVenta_id')->references('id')->on('lugarVentas');
        });

        echo "Creando tabla de  categorias de mora".__LINE__."\n";
        Schema::create('categoriaMoras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->decimal('valorUnitario', 11, 0);
            $table->decimal('ValorDonacion', 11, 0);
            $table->decimal('valorTransporte', 11, 0);
            $table->decimal('valorAsohof', 11, 2);
            $table->decimal('valorCuatroPorMil', 11, 4);
            $table->timestamps();
        });

        Schema::create('estadoVentas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique;            
            $table->timestamps();
        });

        echo "Creando tabla de ventas ".__LINE__."\n";
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productor_id');
            $table->unsignedInteger('linea_id');
            $table->date('fechaVenta');
            $table->unsignedInteger('lugarVenta_id');
            $table->decimal('totalVenta', 11, 2);
            $table->decimal('totalKilos', 11, 2);
            $table->unsignedInteger('estado_id');                                 
            $table->timestamps();
        });

        

        Schema::table('ventas', function (Blueprint $table) {
            $table->foreign('productor_id')->references('id')->on('productors');
            $table->foreign('linea_id')->references('id')->on('lineas');
            $table->foreign('lugarVenta_id')->references('id')->on('lugarVentas');
            $table->foreign('estado_id')->references('id')->on('estadoVentas');
        });

        echo "Creando tabla de ventas_categorias ".__LINE__."\n";
        Schema::create('ventas_categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ventas_id');
            $table->unsignedInteger('categoria_id');
            $table->decimal('peso', 11, 2);
            $table->decimal('valorUnitario', 11, 2);
            $table->decimal('subtotal', 11, 2);
            $table->decimal('donacion', 11, 2);
            $table->decimal('transporte', 11, 2);
            $table->decimal('asohof', 11, 2);
            $table->decimal('cuatroXmil', 11, 2);
            $table->text('otro')->nullable();
            $table->timestamps();
        });

        Schema::table('ventas_categorias', function (Blueprint $table) {
            $table->foreign('ventas_id')->references('id')->on('ventas');
            $table->foreign('categoria_id')->references('id')->on('categoriaMoras');
        });    

      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas_categorias');
        Schema::dropIfExists('ventas');
        Schema::dropIfExists('categoriaMoras');
        Schema::dropIfExists('cultivos');
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
    }
}
