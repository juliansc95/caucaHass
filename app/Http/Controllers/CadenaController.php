<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
class CadenaController extends Controller
{
    public function selectCadena(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $cadenas = Cadena::select('id','nombre')->orderBy('id','asc')->get();
        return['cadenas'=>$cadenas];
    }
}
