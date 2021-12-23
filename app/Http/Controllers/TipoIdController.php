<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoId;
class TipoIdController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $tipoIds= TipoId::orderBy('id','desc')->paginate(3);
        }
        else{
            $tipoIds=TipoId::where($criterio,'like','%'.$buscar.'%')->orderBy('id','desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $tipoIds->total(),
                'current_page' => $tipoIds->currentPage(),
                'per_page'     => $tipoIds->perPage(),
                'last_page'    => $tipoIds->lastPage(),
                'from'         => $tipoIds->firstItem(),
                'to'           => $tipoIds->lastItem(),
            ],
            'tipoIds' => $tipoIds
        ];
    }
    public function selectTipoId(Request $request){
       // if(!$request->ajax()) return redirect('/');
        $tipoIds = TipoId::select('id','nombre')->orderBy('id','asc')->get();
        return['tipoIds'=>$tipoIds];
    }

}
