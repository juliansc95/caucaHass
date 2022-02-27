<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TipoId;
use App\Departamento;
use App\Sexo;
use App\Posesion;
use App\Productor;
use App\ProductosFertilizante;
use App\Quimico;

class selectController extends Controller
{

    public function select(Request $request){
        
        $tipoIds = TipoId::select('id','nombre')->orderBy('id','asc')->get();
        $sexos = Sexo::select('id','nombre')->orderBy('id','asc')->get();
        $departamentos = Departamento::select('id','nombre')->orderBy('id','asc')->get();
        $posesions = Posesion::select('id','nombre')->orderBy('id','asc')->get();
        $personas= Productor::join('personas','productors.id','=','personas.id')
	  ->select('productors.id','personas.nombre')->orderBy('productors.id','asc')->get();
	$fertilizantes= ProductosFertilizante::select('id','nombre')
	  ->orderBy('id','asc')->get();	
        $quimicos= Quimico::select('id','nombre')
	 ->orderBy('id','asc')->get();
	$formaAplicacionFertilizante = [
	  ['id'=>'EDAFICA', 'nombre' => 'Edafica'],
	  ['id'=>'FOLIAR', 'nombre' => 'Foliar']
	];
	$formaAplicacionQuimico = [
	  ['id'=>'BOMBA DE ESPADA', 'nombre' => 'BOMBA DE ESPADA'],
	  ['id'=>'BOMBA DE MOTOR', 'nombre' => 'BOMBA DE MOTOR']
	];
	return[
                'tipoIds'       => $tipoIds,
                'sexos'         => $sexos,
                'departamentos' => $departamentos,
                'posesions'     => $posesions,
		'productores'   => $personas, 
		'fertilizantes' => $fertilizantes,
		'quimicos'	=> $quimicos,
		'afertilizante' => $formaAplicacionFertilizante,
		'aquimico'	=> $formaAplicacionQuimico

            ];
    }

}
