<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etnia;
class EtniaController extends Controller
{
    public function selectEtnia(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $etnias = Etnia::select('id','nombre')->orderBy('id','asc')->get();
        return['etnias'=>$etnias];
    }
}
