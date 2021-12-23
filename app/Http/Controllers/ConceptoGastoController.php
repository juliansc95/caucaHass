<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConceptoGasto;

class ConceptoGastoController extends Controller
{
    public function selectConcepto(Request $request){
        //if(!$request->ajax()) return redirect('/');
         $conceptos = ConceptoGasto::select('id','nombre')->orderBy('id','asc')->get();
         return['conceptos'=>$conceptos];
     }
}
