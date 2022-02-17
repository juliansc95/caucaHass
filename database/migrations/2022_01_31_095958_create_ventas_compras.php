<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasCompras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo "Creando tabla de compra".__LINE__."\n";
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('CompraNro');
            $table->string('Fecha');
            $table->string('CodProducto');
            $table->string('DescripcionProducto');
            $table->decimal('Cantidad', 11, 2);
            $table->string('Unidades');
            $table->decimal('ValorBruto',11,2);
            $table->decimal('Descuento',11,2);
            $table->decimal('ValorNeto',11,2);
            $table->decimal('Iva',11,2);
            $table->decimal('ValorIva',11,2);
            $table->decimal('ImpuestoConsumo',11,2);
            $table->decimal('TotalItem',11,2);         
            $table->string('Documento');
            $table->string('NombreTercero');
            $table->timestamps();
        });

        echo "Creando tabla de venta".__LINE__."\n";
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('VentaNro');
            $table->string('Fecha');
            $table->string('CodProducto');
            $table->string('DescripcionProducto');
            $table->decimal('Cantidad', 11, 2);
            $table->string('Unidades');
            $table->decimal('ValorBruto',11,2);
            $table->decimal('Descuento',11,2);
            $table->decimal('ValorNeto',11,2);
            $table->decimal('Iva',11,2);
            $table->decimal('ValorIva',11,2);
            $table->decimal('ImpuestoConsumo',11,2);
            $table->decimal('TotalItem',11,2);         
            $table->string('Documento');
            $table->string('NombreTercero');
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
        Schema::dropIfExists('compras');
        Schema::dropIfExists('ventas');
    }
}
