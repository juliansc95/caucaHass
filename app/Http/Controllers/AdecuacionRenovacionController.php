<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\AdecuacionRenovacion;
use App\RenovacionConcepto;


class AdecuacionRenovacionController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $id = $request->id;
            $gastos = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->join('conceptogastos','renovacionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','adecuacionrenovacions.productor_id','=','personas.id')
            ->join('fincas','adecuacionrenovacions.finca_id','=','fincas.id')
            ->select('renovacionconceptos.id','renovacionconceptos.adecuacionrenovacion_id',
            'renovacionconceptos.conceptoGasto_id','renovacionconceptos.descripcion','renovacionconceptos.otro',
            'renovacionconceptos.valorTotal','adecuacionrenovacions.productor_id','adecuacionrenovacions.finca_id','adecuacionrenovacions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
             ->orderBy('renovacionconceptos.id', 'asc')->paginate(10);
        }
        if($criterio == 'personas'){
            $gastos = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->join('conceptogastos','renovacionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','adecuacionrenovacions.productor_id','=','personas.id')
            ->join('fincas','adecuacionrenovacions.finca_id','=','fincas.id')
            ->select('renovacionconceptos.id','renovacionconceptos.adecuacionrenovacion_id',
            'renovacionconceptos.conceptoGasto_id','renovacionconceptos.descripcion','renovacionconceptos.otro',
            'renovacionconceptos.valorTotal','adecuacionrenovacions.productor_id','adecuacionrenovacions.finca_id','adecuacionrenovacions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')   
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('renovacionconceptos.id', 'asc')->paginate(10);
        }
        else{
            $gastos = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->join('conceptogastos','renovacionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','adecuacionrenovacions.productor_id','=','personas.id')
            ->join('fincas','adecuacionrenovacions.finca_id','=','fincas.id')
            ->select('renovacionconceptos.id','renovacionconceptos.adecuacionrenovacion_id',
            'renovacionconceptos.conceptoGasto_id','renovacionconceptos.descripcion','renovacionconceptos.otro',
            'renovacionconceptos.valorTotal','adecuacionrenovacions.productor_id','adecuacionrenovacions.finca_id','adecuacionrenovacions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca') 
            //->where('establecimientoconceptos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('renovacionconceptos.id', 'asc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $gastos->total(),
                'current_page' => $gastos->currentPage(),
                'per_page'     => $gastos->perPage(),
                'last_page'    => $gastos->lastPage(),
                'from'         => $gastos->firstItem(),
                'to'           => $gastos->lastItem(),
            ],
            'gastos' => $gastos
        ];
    }

    public function indexProductor(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $user = \Auth::user()->id;

        if ($buscar==''){
            $id = $request->id;
            $gastos = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->join('conceptogastos','renovacionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','adecuacionrenovacions.productor_id','=','personas.id')
            ->join('fincas','adecuacionrenovacions.finca_id','=','fincas.id')
            ->select('renovacionconceptos.id','renovacionconceptos.adecuacionrenovacion_id',
            'renovacionconceptos.conceptoGasto_id','renovacionconceptos.descripcion','renovacionconceptos.otro',
            'renovacionconceptos.valorTotal','adecuacionrenovacions.productor_id','adecuacionrenovacions.finca_id','adecuacionrenovacions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
            ->where('adecuacionrenovacions.productor_id','=',$user) 
            ->orderBy('renovacionconceptos.id', 'asc')->paginate(10);
        }
        if($criterio == 'personas'){
            $gastos = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->join('conceptogastos','renovacionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','adecuacionrenovacions.productor_id','=','personas.id')
            ->join('fincas','adecuacionrenovacions.finca_id','=','fincas.id')
            ->select('renovacionconceptos.id','renovacionconceptos.adecuacionrenovacion_id',
            'renovacionconceptos.conceptoGasto_id','renovacionconceptos.descripcion','renovacionconceptos.otro',
            'renovacionconceptos.valorTotal','adecuacionrenovacions.productor_id','adecuacionrenovacions.finca_id','adecuacionrenovacions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')   
            ->where('adecuacionrenovacions.productor_id','=',$user) 
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('renovacionconceptos.id', 'asc')->paginate(10);
        }
        else{
            $gastos = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->join('conceptogastos','renovacionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','adecuacionrenovacions.productor_id','=','personas.id')
            ->join('fincas','adecuacionrenovacions.finca_id','=','fincas.id')
            ->select('renovacionconceptos.id','renovacionconceptos.adecuacionrenovacion_id',
            'renovacionconceptos.conceptoGasto_id','renovacionconceptos.descripcion','renovacionconceptos.otro',
            'renovacionconceptos.valorTotal','adecuacionrenovacions.productor_id','adecuacionrenovacions.finca_id','adecuacionrenovacions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca') 
            ->where('adecuacionrenovacions.productor_id','=',$user) 
            //->where('establecimientoconceptos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('renovacionconceptos.id', 'asc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $gastos->total(),
                'current_page' => $gastos->currentPage(),
                'per_page'     => $gastos->perPage(),
                'last_page'    => $gastos->lastPage(),
                'from'         => $gastos->firstItem(),
                'to'           => $gastos->lastItem(),
            ],
            'gastos' => $gastos
        ];
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');

            $gasto = new AdecuacionRenovacion();
            $gasto->productor_id = $request->productor_id;
            $gasto->finca_id = $request->finca_id;
            $gasto->fechaRegistro = $mytime->toDateTimeString();
            $gasto->save();

            $renovacionConceptos = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($renovacionConceptos as $ep=>$renovacion)
            {
                $renovacionConcepto = new RenovacionConcepto();
                $renovacionConcepto->adecuacionrenovacion_id = $gasto->id;
                $renovacionConcepto->conceptoGasto_id = $renovacion['conceptoGasto_id'];
                $renovacionConcepto->descripcion = $renovacion['descripcion'];
                $renovacionConcepto->otro = $renovacion['otro'];
                $renovacionConcepto->valorTotal = $renovacion['valorTotal'];    
                $renovacionConcepto->save();
            }          

            DB::commit();
            return[
                'id'=>$gasto->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function excel(){
        $gastos = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->join('conceptogastos','renovacionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','adecuacionrenovacions.productor_id','=','personas.id')
            ->join('fincas','adecuacionrenovacions.finca_id','=','fincas.id')
            ->select('renovacionconceptos.id','renovacionconceptos.adecuacionrenovacion_id',
            'renovacionconceptos.conceptoGasto_id','renovacionconceptos.descripcion','renovacionconceptos.otro',
            'renovacionconceptos.valorTotal','adecuacionrenovacions.productor_id','adecuacionrenovacions.finca_id','adecuacionrenovacions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
        ->orderBy('renovacionconceptos.id', 'asc')->get();
        return [
            'gastos' => $gastos
        ];
        
    }



}
