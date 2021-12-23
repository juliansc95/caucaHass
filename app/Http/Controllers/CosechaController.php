<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cosecha;
use Carbon\Carbon;


class CosechaController extends Controller
{
    public function index(Request $request)
    {
    if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $cosechas= Cosecha::join('personas','cosechas.productor_id','=','personas.id')
            ->join('productors','cosechas.productor_id','=','productors.id')
            ->join('fincas','cosechas.finca_id','=','fincas.id')
            ->select('personas.nombre','cosechas.productor_id','cosechas.finca_id','fincas.nombre as nombre_finca',
            'cosechas.frecuencia','cosechas.clasificacion','cosechas.empaque','cosechas.transporte','cosechas.kilogramoMoraPrimera',
            'cosechas.kilogramoMoraSegunda','cosechas.mesesProduccion','cosechas.clientes','cosechas.tiempoPago','cosechas.tipoPago')
            ->orderBy('cosechas.id','desc')->paginate(3);
        }
        if($criterio == 'personas'){
            $cosechas= Cosecha::join('personas','cosechas.productor_id','=','personas.id')
            ->join('productors','cosechas.productor_id','=','productors.id')
            ->join('fincas','cosechas.finca_id','=','fincas.id')
            ->select('personas.nombre','cosechas.productor_id','cosechas.finca_id','fincas.nombre as nombre_finca',
            'cosechas.frecuencia','cosechas.clasificacion','cosechas.empaque','cosechas.transporte','cosechas.kilogramoMoraPrimera',
            'cosechas.kilogramoMoraSegunda','cosechas.mesesProduccion','cosechas.clientes','cosechas.tiempoPago','cosechas.tipoPago')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('cosechas.id', 'asc')->paginate(3);
            }
        else{
            $cosechas= Cosecha::join('personas','cosechas.productor_id','=','personas.id')
            ->join('productors','cosechas.productor_id','=','productors.id')
            ->join('fincas','cosechas.finca_id','=','fincas.id')
            ->select('personas.nombre','cosechas.productor_id','cosechas.finca_id','fincas.nombre as nombre_finca',
            'cosechas.frecuencia','cosechas.clasificacion','cosechas.empaque','cosechas.transporte','cosechas.kilogramoMoraPrimera',
            'cosechas.kilogramoMoraSegunda','cosechas.mesesProduccion','cosechas.clientes','cosechas.tiempoPago','cosechas.tipoPago')
            ->where('cosechas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('cosechas.id', 'desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $cosechas->total(),
                'current_page' => $cosechas->currentPage(),
                'per_page'     => $cosechas->perPage(),
                'last_page'    => $cosechas->lastPage(),
                'from'         => $cosechas->firstItem(),
                'to'           => $cosechas->lastItem(),
            ],
            'cosechas' => $cosechas
        ];
    }
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $cosecha = new Cosecha();
        $cosecha->productor_id = $request->productor_id;
        $cosecha->finca_id = $request->finca_id;
        $cosecha->frecuencia=$request->frecuencia;
        $cosecha->clasificacion=$request->clasificacion;
        $cosecha->empaque= $request->empaque;
        $cosecha->transporte= $request->transporte;
        $cosecha->kilogramoMoraPrimera= $request->kilogramoMoraPrimera;
        $cosecha->kilogramoMoraSegunda = $request->kilogramoMoraSegunda;
        $cosecha->mesesProduccion = $request->mesesProduccion;
        $cosecha->clientes =  $request->clientes;
        $cosecha->tiempoPago =  $request->tiempoPago;
        $cosecha->tipoPago =  $request->tipoPago;
        $cosecha->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');
        $cont=Cosecha::count();
        $cosechas= Cosecha::join('personas','cosechas.productor_id','=','personas.id')
        ->join('productors','cosechas.productor_id','=','productors.id')
        ->join('fincas','cosechas.finca_id','=','fincas.id')
        ->select('personas.nombre','cosechas.productor_id','cosechas.finca_id','fincas.nombre as nombre_finca',
        'cosechas.frecuencia','cosechas.clasificacion','cosechas.empaque','cosechas.transporte','cosechas.kilogramoMoraPrimera',
        'cosechas.kilogramoMoraSegunda','cosechas.mesesProduccion','cosechas.clientes','cosechas.tiempoPago','cosechas.tipoPago')
        ->orderBy('cosechas.id','desc')->get();
        $pdf = \PDF::loadView('pdf.cosecha',['cosechas'=>$cosechas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('cosecha.pdf');   
    }

    public function excel(Request $request)
    {
        $cosechas= Cosecha::join('personas','cosechas.productor_id','=','personas.id')
        ->join('productors','cosechas.productor_id','=','productors.id')
        ->join('fincas','cosechas.finca_id','=','fincas.id')
        ->select('personas.nombre','cosechas.productor_id','cosechas.finca_id','fincas.nombre as nombre_finca',
        'cosechas.frecuencia','cosechas.clasificacion','cosechas.empaque','cosechas.transporte','cosechas.kilogramoMoraPrimera',
        'cosechas.kilogramoMoraSegunda','cosechas.mesesProduccion','cosechas.clientes','cosechas.tiempoPago','cosechas.tipoPago')
        ->orderBy('cosechas.id','desc')->get();
        return['cosechas'=>$cosechas];
       
    }
}
