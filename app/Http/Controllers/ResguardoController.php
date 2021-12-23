<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resguardo;

class ResguardoController extends Controller
{
    public function selectResguardo(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $resguardos = Resguardo::select('id','nombre')->orderBy('id','asc')->get();
        return['resguardos'=>$resguardos];
    }
}
