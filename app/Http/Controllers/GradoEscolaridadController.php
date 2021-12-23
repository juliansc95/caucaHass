<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GradoEscolaridad;
class GradoEscolaridadController extends Controller
{
    public function selectGradoEscolaridad(Request $request){
       // if(!$request->ajax()) return redirect('/');
        $grados = GradoEscolaridad::select('id','nombre')->orderBy('id','asc')->get();
        return['grados'=>$grados];
    }
}
