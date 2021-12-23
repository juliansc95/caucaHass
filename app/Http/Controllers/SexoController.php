<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sexo;
class SexoController extends Controller
{
    public function selectSexo(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $sexos = Sexo::select('id','nombre')->orderBy('id','asc')->get();
        return['sexos'=>$sexos];
    }
}
