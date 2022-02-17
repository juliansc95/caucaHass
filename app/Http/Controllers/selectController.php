<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TipoId;
use App\Departamento;
use App\Sexo;

class selectController extends Controller
{

    public function select(Request $request){
        
        $tipoIds = TipoId::select('id','nombre')->orderBy('id','asc')->get();
        $sexos = Sexo::select('id','nombre')->orderBy('id','asc')->get();
        $departamentos = Departamento::select('id','nombre')->orderBy('id','asc')->get();

        return[
                'tipoIds'       => $tipoIds,
                'sexos'         => $sexos,
                'departamentos' => $departamentos,
            ];
    }

}
