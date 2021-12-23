<?php

use Illuminate\Database\Seeder;

class coreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Iniciando ejecuion de Seeder " . __CLASS__ . "\n";

        echo "Creando tipos de documentos - Line:" . __LINE__ . "\n";
        \App\TipoId::create([
            'nombre' => 'Cedula de ciudadania',
        ]);
        \App\TipoId::create([
            'nombre' => 'Tarjeta de identidad',
        ]);

        echo "Creando sexos - Line:" . __LINE__ . "\n";
        $sexos = array(
            ["nombre" => "Masculino"],
            ["nombre" => "Femenino"],
        );

        foreach ($sexos as $sexo){
            \App\Sexo::create([
                'nombre' => $sexo['nombre']
            ]);
        }

        echo "Creando etnias - Line:" . __LINE__ . "\n";

        $etnias = array(
            ['nombre' => 'Indigena'],
        );

        foreach ($etnias as $etnia) {
            \App\Etnia::create([
                'nombre' => $etnia['nombre']
            ]);
        }

        echo "Creando Grados de Escolaridad  - Line:" . __LINE__ . "\n";

        $grados = array(
            ['nombre' => 'Primaria Incompleta'],
            ['nombre' => 'Primaria'],
            ['nombre' => 'Bachiller Incompleto'],
            ['nombre' => 'Bachiller'],
            ['nombre' => 'Tecnico Incompleto'],
            ['nombre' => 'Tecnico'],
            ['nombre' => 'Tecnologo Incompleto'],
            ['nombre' => 'Tecnologo'],
            ['nombre' => 'Universitario Incompleto'],
            ['nombre' => 'Universitario']
        );

        foreach ($grados as $grado) {
            \App\GradoEscolaridad::create([
                'nombre' => $grado['nombre']
            ]);
        }

        echo "Creando Departamentos  - Line:" . __LINE__ . "\n";

        $departamentos = array(
            ['nombre' => 'CAUCA'],
            ['nombre'=> 'AMAZONAS'],
            ['nombre'=> 'ANTIOQUIA'],
            ['nombre'=> 'ARAUCA'],
            ['nombre'=> 'ATLANTICO'],
            ['nombre'=> 'BOLIVAR'],
            ['nombre'=> 'BOYACA'],
            ['nombre'=> 'CALDAS'],
            ['nombre'=> 'CAQUETA'],
            ['nombre'=> 'CASANARE'],
            ['nombre' => 'CESAR'],
            ['nombre' => 'CHOCO'],
            ['nombre' => 'CORDOBA'],
            ['nombre' => 'CUNDINAMARCA'],
            ['nombre' => 'GUAINIA'],
            ['nombre' => 'GUAJIRA'],
            ['nombre' => 'GUAVIARE'],
            ['nombre' => 'HUILA'],
            ['nombre' => 'MAGDALENA'],
            ['nombre' => 'META'],
            ['nombre' => 'N SANTANDER'],
            ['nombre' => 'NARINO'],
            ['nombre' => 'PUTUMAYO'],
            ['nombre' => 'QUINDIO'],
            ['nombre' => 'RISARALDA'],
            ['nombre' => 'SAN ANDRES'],
            ['nombre' => 'SANTANDER'],
            ['nombre' => 'SUCRE'],
            ['nombre' => 'TOLIMA'],
            ['nombre' => 'VALLE DEL CAUCA'],
            ['nombre' => 'VAUPES'],
            ['nombre' => 'VICHADA']           
        );

        foreach ($departamentos as $departamento) {
            \App\Departamento::create([
                'nombre' => $departamento['nombre']
            ]);
        }

        echo "Creando Municipios - Line:" . __LINE__ . "\n";

        $municipios = array(
            ['nombre' => 'TORIBIO','departamento_id'=>'1'],
            ['nombre'=> 'ALMAGUER','departamento_id'=>'1'],
            ['nombre'=> 'ARGELIA','departamento_id'=>'1'],
            ['nombre'=> 'BALBOA','departamento_id'=>'1'],
            ['nombre'=> 'BOLIVAR','departamento_id'=>'1'],
            ['nombre'=> 'BUENOS AIRES','departamento_id'=>'1'],
            ['nombre'=> 'CAJIBIO','departamento_id'=>'1'],
            ['nombre'=> 'CALDONO','departamento_id'=>'1'],
            ['nombre'=> 'CALOTO','departamento_id'=>'1'],
            ['nombre'=> 'CORINTO','departamento_id'=>'1'],
            ['nombre' => 'EL TAMBO','departamento_id'=>'1'],
            ['nombre' => 'FLORENCIA','departamento_id'=>'1'],
            ['nombre' => 'GUAPI','departamento_id'=>'1'],
            ['nombre' => 'INZA','departamento_id'=>'1'],
            ['nombre' => 'JAMBALO','departamento_id'=>'1'],
            ['nombre' => 'LA SIERRA','departamento_id'=>'1'],
            ['nombre' => 'LA VEGA','departamento_id'=>'1'],
            ['nombre' => 'LOPEZ','departamento_id'=>'1'],
            ['nombre' => 'MERCADERES','departamento_id'=>'1'],
            ['nombre' => 'MIRANDA','departamento_id'=>'1'],
            ['nombre' => 'MORALES','departamento_id'=>'1'],
            ['nombre' => 'PADILLA','departamento_id'=>'1'],
            ['nombre' => 'PAEZ','departamento_id'=>'1'],
            ['nombre' => 'PATIA','departamento_id'=>'1'],
            ['nombre' => 'PIAMONTE','departamento_id'=>'1'],
            ['nombre' => 'PIENDAMO','departamento_id'=>'1'],
            ['nombre' => 'POPAYAN','departamento_id'=>'1'],
            ['nombre' => 'PUERTO TEJADA','departamento_id'=>'1'],
            ['nombre' => 'PURACE','departamento_id'=>'1'],
            ['nombre' => 'ROSAS','departamento_id'=>'1'],
            ['nombre' => 'SAN SEBASTIAN','departamento_id'=>'1'],
            ['nombre' => 'SANTA ROSA','departamento_id'=>'1'],
            ['nombre' => 'SANTANDER DE QUILICHAO','departamento_id'=>'1'],
            ['nombre' => 'SILVIA','departamento_id'=>'1'],
            ['nombre' => 'SOTARA','departamento_id'=>'1'],
            ['nombre' => 'SUAREZ','departamento_id'=>'1'],
            ['nombre' => 'SUCRE','departamento_id'=>'1'],
            ['nombre' => 'TIMBIO','departamento_id'=>'1'],
            ['nombre' => 'TIMBIQUI','departamento_id'=>'1'],
            ['nombre' => 'TOTORO','departamento_id'=>'1'],
            ['nombre' => 'VILLA RICA','departamento_id'=>'1']
        );

        foreach ($municipios as $municipio) {
            \App\Municipio::create([
                'nombre' => $municipio['nombre'],
                'departamento_id'=>$municipio['departamento_id']
            ]);
        }

        echo "Creando Veredas - Line:" . __LINE__ . "\n";

        $veredas = array(
            ['nombre' => 'CULEBRERO','municipio_id'=>'1'],
            ['nombre' => 'El FLAYO','municipio_id'=>'1'],
            ['nombre' => 'GARGANTILLAS','municipio_id'=>'1'],
            ['nombre' => 'HIMICUETO','municipio_id'=>'1'],
            ['nombre' => 'HUTLA','municipio_id'=>'1'],
            ['nombre' => 'LA CALERA','municipio_id'=>'1'],
            ['nombre' => 'LA CAPILLA','municipio_id'=>'1'],
            ['nombre' => 'LA ESTRELLA','municipio_id'=>'1'],
            ['nombre' => 'LA JULIA','municipio_id'=>'1'],
            ['nombre' => 'LA PALMA','municipio_id'=>'1'],
            ['nombre' => 'LA PLAYA','municipio_id'=>'1'],
            ['nombre' => 'LA PRIMICIA','municipio_id'=>'1'],
            ['nombre' => 'LA SUSANA','municipio_id'=>'1'],
            ['nombre' => 'LOPEZ','municipio_id'=>'1'],
            ['nombre' => 'QUINAMAYO','municipio_id'=>'1'],
            ['nombre' => 'SESTADERO','municipio_id'=>'1'],
            ['nombre' => 'TACUEYO','municipio_id'=>'1'],
            ['nombre' => 'TORIBIO','municipio_id'=>'1'],
            ['nombre' => 'TRAPICHE','municipio_id'=>'1'],
            ['nombre' => 'ULLUCOS','municipio_id'=>'1'],
            ['nombre' => 'VICHIQUI','municipio_id'=>'1'],
        );

        foreach ($veredas as $vereda) {
            \App\Vereda::create([
                'nombre' => $vereda['nombre'],
                'municipio_id' => $vereda['municipio_id']
            ]);
        }

        echo "Creando resguardos - Line:" . __LINE__ . "\n";

        $resguardos = array(
            ['nombre' => 'TACUEYO'],
            ['nombre' => 'TORIBIO'],
            ['nombre' => 'SAN FRANCISCO'],

        );

        foreach ($resguardos as $resguardo) {
            \App\Resguardo::create([
                'nombre' => $resguardo['nombre']
            ]);
        }

        echo "Creando estados venta - Line:" . __LINE__ . "\n";

        $estadoVentas = array(
            ['nombre' => 'ACOPIO'],
            ['nombre' => 'TRAMITE FACTURACION'],
            ['nombre' => 'DISPONIBLE PARA PAGO'],
            ['nombre' => 'PAGADO'],

        );

        foreach ($estadoVentas as $estadoVenta) {
            \App\EstadoVenta::create([
                'nombre' => $estadoVenta['nombre']
            ]);
        }

    }
}
