<?php

use Illuminate\Database\Seeder;

class ConceptoGastoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Creando Concepto Gasto  - Line:" . __LINE__ . "\n";

        $conceptos = array(
            ['nombre' => 'Compra / Alquiler terrenos'],
            ['nombre' => 'Infraestructuras'],
            ['nombre' => 'Materiales'],
            ['nombre' => 'Herramientas / Equipos'],
            ['nombre' => 'Suministros'],
            ['nombre' => 'Insumos'],
            ['nombre' => 'Mano de obra externa'],
            ['nombre' => 'Material vegetal'],
            ['nombre' => 'Transporte']
        );

        foreach ($conceptos as $concepto) {
            \App\ConceptoGasto::create([
                'nombre' => $concepto['nombre']
            ]);
        }
    }
}
