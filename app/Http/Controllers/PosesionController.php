<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posesion;
class PosesionController extends Controller
{
    public function selectPosesion(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $posesions = Posesion::select('id','nombre')->orderBy('id','asc')->get();
        return['posesions'=>$posesions];
    }
}
