<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\GastosProduccion;
use App\ProduccionConcepto;

class GastosProduccionController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $id = $request->id;
            $gastos = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->join('conceptogastos','produccionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosproduccions.productor_id','=','personas.id')
            ->join('fincas','gastosproduccions.finca_id','=','fincas.id')
            ->select('produccionconceptos.id','produccionconceptos.gastosProduccion_id',
            'produccionconceptos.conceptoGasto_id','produccionconceptos.descripcion','produccionconceptos.otro',
            'produccionconceptos.valorTotal','gastosproduccions.productor_id','gastosproduccions.finca_id','gastosproduccions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
             ->orderBy('produccionconceptos.id', 'asc')->paginate(10);
        }
        if($criterio == 'personas'){
            $gastos = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->join('conceptogastos','produccionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosproduccions.productor_id','=','personas.id')
            ->join('fincas','gastosproduccions.finca_id','=','fincas.id')
            ->select('produccionconceptos.id','produccionconceptos.gastosProduccion_id',
            'produccionconceptos.conceptoGasto_id','produccionconceptos.descripcion','produccionconceptos.otro',
            'produccionconceptos.valorTotal','gastosproduccions.productor_id','gastosproduccions.finca_id','gastosproduccions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('produccionconceptos.id', 'asc')->paginate(10);
        }
        else{
            $gastos = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->join('conceptogastos','produccionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosproduccions.productor_id','=','personas.id')
            ->join('fincas','gastosproduccions.finca_id','=','fincas.id')
            ->select('produccionconceptos.id','produccionconceptos.gastosProduccion_id',
            'produccionconceptos.conceptoGasto_id','produccionconceptos.descripcion','produccionconceptos.otro',
            'produccionconceptos.valorTotal','gastosproduccions.productor_id','gastosproduccions.finca_id','gastosproduccions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')  
            //->where('establecimientoconceptos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('produccionconceptos.id', 'asc')->paginate(10);
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
            $gastos = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->join('conceptogastos','produccionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosproduccions.productor_id','=','personas.id')
            ->join('fincas','gastosproduccions.finca_id','=','fincas.id')
            ->select('produccionconceptos.id','produccionconceptos.gastosProduccion_id',
            'produccionconceptos.conceptoGasto_id','produccionconceptos.descripcion','produccionconceptos.otro',
            'produccionconceptos.valorTotal','gastosproduccions.productor_id','gastosproduccions.finca_id','gastosproduccions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
            ->where('gastosproduccions.productor_id','=',$user)
            ->orderBy('produccionconceptos.id', 'asc')->paginate(10);
        }
        if($criterio == 'personas'){
            $gastos = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->join('conceptogastos','produccionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosproduccions.productor_id','=','personas.id')
            ->join('fincas','gastosproduccions.finca_id','=','fincas.id')
            ->select('produccionconceptos.id','produccionconceptos.gastosProduccion_id',
            'produccionconceptos.conceptoGasto_id','produccionconceptos.descripcion','produccionconceptos.otro',
            'produccionconceptos.valorTotal','gastosproduccions.productor_id','gastosproduccions.finca_id','gastosproduccions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
            ->where('gastosproduccions.productor_id','=',$user)
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('produccionconceptos.id', 'asc')->paginate(10);
        }
        else{
            $gastos = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->join('conceptogastos','produccionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosproduccions.productor_id','=','personas.id')
            ->join('fincas','gastosproduccions.finca_id','=','fincas.id')
            ->select('produccionconceptos.id','produccionconceptos.gastosProduccion_id',
            'produccionconceptos.conceptoGasto_id','produccionconceptos.descripcion','produccionconceptos.otro',
            'produccionconceptos.valorTotal','gastosproduccions.productor_id','gastosproduccions.finca_id','gastosproduccions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')  
            //->where('establecimientoconceptos.'.$criterio, 'like', '%'. $buscar . '%')
            ->where('gastosproduccions.productor_id','=',$user)
            ->orderBy('produccionconceptos.id', 'asc')->paginate(10);
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

            $gasto = new GastosProduccion();
            $gasto->productor_id = $request->productor_id;
            $gasto->finca_id = $request->finca_id;
            $gasto->fechaRegistro = $mytime->toDateTimeString();
            $gasto->save();

            $gastosProduccions = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($gastosProduccions as $ep=>$produccion)
            {
                $produccionConcepto = new ProduccionConcepto();
                $produccionConcepto->gastosproduccion_id = $gasto->id;
                $produccionConcepto->conceptoGasto_id = $produccion['conceptoGasto_id'];
                $produccionConcepto->descripcion = $produccion['descripcion'];
                $produccionConcepto->otro = $produccion['otro'];
                $produccionConcepto->valorTotal = $produccion['valorTotal'];    
                $produccionConcepto->save();
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
        $gastos = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->join('conceptogastos','produccionconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosproduccions.productor_id','=','personas.id')
            ->join('fincas','gastosproduccions.finca_id','=','fincas.id')
            ->select('produccionconceptos.id','produccionconceptos.gastosProduccion_id',
            'produccionconceptos.conceptoGasto_id','produccionconceptos.descripcion','produccionconceptos.otro',
            'produccionconceptos.valorTotal','gastosproduccions.productor_id','gastosproduccions.finca_id','gastosproduccions.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')  
        ->orderBy('produccionconceptos.id', 'asc')->get();
        return [
            'gastos' => $gastos
        ];
        
    }

}
