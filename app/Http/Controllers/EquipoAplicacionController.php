<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EquipoAplicacion;
use App\MetodoAplicacion;
use App\UnidadAplicacion;
use App\UnidadDosis;
use App\ProductoFitosanitario;

class EquipoAplicacionController extends Controller
{
    public function selectEquipo(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $equipos = EquipoAplicacion::select('id','nombre')->orderBy('id','asc')->get();
        return['equipos'=>$equipos];
    }

    public function selectMetodo(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $metodos = MetodoAplicacion::select('id','nombre')->orderBy('id','asc')->get();
        return['metodos'=>$metodos];
    }

    public function selectUnidad(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $unidades = UnidadAplicacion::select('id','nombre')->orderBy('id','asc')->get();
        return['unidades'=>$unidades];
    }

    public function selectDosis(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $dosis = UnidadDosis::select('id','nombre')->orderBy('id','asc')->get();
        return['dosis'=>$dosis];
    }

    public function selectProducto2(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $productos = ProductoFitosanitario::select('id','nombre')
        ->where('nombre', 'like', '%'. $filtro . '%')
        ->orderBy('nombre', 'asc')->get();
        return['productos'=>$productos];
    }


}
