<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipio;

class MunicipioController extends Controller
{
    public function selectMunicipio(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $municipios = Municipio::select('id','nombre')->orderBy('id','asc')->get();
        return['municipios'=>$municipios];
    }
    public function departamentoMunicipio($id){
         $municipios = Municipio::select('id','nombre')->where("departamento_id","=",$id)->orderBy('id','asc')->get();
        return ["municipios" => $municipios];
    }
}
