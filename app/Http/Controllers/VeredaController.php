<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vereda;

class VeredaController extends Controller
{
    public function selectVereda(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $veredas = Vereda::select('id','nombre')->orderBy('id','asc')->get();
        return['veredas'=>$veredas];
    }
}
