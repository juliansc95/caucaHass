<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Suelo;
use Carbon\Carbon;



class SueloController extends Controller
{
    public function index(Request $request)
    {
    if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $suelos= Suelo::join('personas','suelos.productor_id','=','personas.id')
            ->join('productors','suelos.productor_id','=','productors.id')
            ->join('fincas','suelos.finca_id','=','fincas.id')
            ->select('personas.nombre','suelos.productor_id','suelos.finca_id','fincas.nombre as nombre_finca',
            'suelos.curvasNivel','suelos.controlArvenses','suelos.frecuencia','suelos.herbicida','suelos.dosisAplicacionCal',
            'suelos.frecuenciaHerbicida')
            ->orderBy('suelos.id','desc')->paginate(3);
        }
        if($criterio == 'personas'){
            $suelos= Suelo::join('personas','suelos.productor_id','=','personas.id')
            ->join('productors','suelos.productor_id','=','productors.id')
            ->join('fincas','suelos.finca_id','=','fincas.id')
            ->select('personas.nombre','suelos.productor_id','suelos.finca_id','fincas.nombre as nombre_finca',
            'suelos.curvasNivel','suelos.controlArvenses','suelos.frecuencia','suelos.herbicida','suelos.dosisAplicacionCal',
            'suelos.frecuenciaHerbicida')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('suelos.id', 'asc')->paginate(3);
            }
        else{
            $suelos= Suelo::join('personas','suelos.productor_id','=','personas.id')
            ->join('productors','suelos.productor_id','=','productors.id')
            ->join('fincas','suelos.finca_id','=','fincas.id')
            ->select('personas.nombre','suelos.productor_id','suelos.finca_id','fincas.nombre as nombre_finca',
            'suelos.curvasNivel','suelos.controlArvenses','suelos.frecuencia','suelos.herbicida','suelos.dosisAplicacionCal',
            'suelos.frecuenciaHerbicida')
            ->where('suelos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('suelos.id', 'desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $suelos->total(),
                'current_page' => $suelos->currentPage(),
                'per_page'     => $suelos->perPage(),
                'last_page'    => $suelos->lastPage(),
                'from'         => $suelos->firstItem(),
                'to'           => $suelos->lastItem(),
            ],
            'suelos' => $suelos
        ];
    }
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $suelo = new Suelo();
        $suelo->productor_id = $request->productor_id;
        $suelo->finca_id = $request->finca_id;
        $suelo->curvasNivel=$request->curvasNivel;
        $suelo->controlArvenses=$request->controlArvenses;
        $suelo->frecuencia= $request->frecuencia;
        $suelo->herbicida= $request->herbicida;
        $suelo->dosisAplicacionCal= $request->dosisAplicacionCal;
        $suelo->frecuenciaHerbicida= $request->frecuenciaHerbicida;
        $suelo->save();
        DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {      
        $ahora= Carbon::now('America/Bogota');
        $cont=Suelo::count();
        $suelos= Suelo::join('personas','suelos.productor_id','=','personas.id')
        ->join('productors','suelos.productor_id','=','productors.id')
        ->join('fincas','suelos.finca_id','=','fincas.id')
        ->select('personas.nombre','suelos.productor_id','suelos.finca_id','fincas.nombre as nombre_finca',
        'suelos.curvasNivel','suelos.controlArvenses','suelos.frecuencia','suelos.herbicida','suelos.dosisAplicacionCal',
        'suelos.frecuenciaHerbicida')
        ->orderBy('suelos.id','desc')->get();
        $pdf = \PDF::loadView('pdf.suelo',['suelos'=>$suelos,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('suelo.pdf');   
    }

    public function excel(Request $request)
    {      
        $suelos= Suelo::join('personas','suelos.productor_id','=','personas.id')
        ->join('productors','suelos.productor_id','=','productors.id')
        ->join('fincas','suelos.finca_id','=','fincas.id')
        ->select('personas.nombre','suelos.productor_id','suelos.finca_id','fincas.nombre as nombre_finca',
        'suelos.curvasNivel','suelos.controlArvenses','suelos.frecuencia','suelos.herbicida','suelos.dosisAplicacionCal',
        'suelos.frecuenciaHerbicida')
        ->orderBy('suelos.id','desc')->get();
        return [
            'suelos' => $suelos
        ];
    }
}
