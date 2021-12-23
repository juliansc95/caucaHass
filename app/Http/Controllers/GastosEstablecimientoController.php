<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\GastosEstablecimiento;
use App\EstablecimientoConcepto;
use App\GastosProduccion;
use App\ProduccionConcepto;

class GastosEstablecimientoController extends Controller
{
    
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $id = $request->id;
            $gastos = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->join('conceptogastos','establecimientoconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosestablecimientos.productor_id','=','personas.id')
            ->join('fincas','gastosestablecimientos.finca_id','=','fincas.id')
            ->select('establecimientoconceptos.id','establecimientoconceptos.gastosEstablecimiento_id',
            'establecimientoconceptos.conceptoGasto_id','establecimientoconceptos.descripcion','establecimientoconceptos.otro',
            'establecimientoconceptos.valorTotal','gastosestablecimientos.productor_id','gastosestablecimientos.finca_id','gastosestablecimientos.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
             ->orderBy('establecimientoconceptos.id', 'asc')->paginate(10);
        }
        if($criterio == 'personas'){
            $gastos = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->join('conceptogastos','establecimientoconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosestablecimientos.productor_id','=','personas.id')
            ->join('fincas','gastosestablecimientos.finca_id','=','fincas.id')
            ->select('establecimientoconceptos.id','establecimientoconceptos.gastosEstablecimiento_id',
            'establecimientoconceptos.conceptoGasto_id','establecimientoconceptos.descripcion','establecimientoconceptos.otro',
            'establecimientoconceptos.valorTotal','gastosestablecimientos.productor_id','gastosestablecimientos.finca_id','gastosestablecimientos.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('establecimientoconceptos.id', 'asc')->paginate(10);
        }
        else{
            $gastos = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->join('conceptogastos','establecimientoconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosestablecimientos.productor_id','=','personas.id')
            ->join('fincas','gastosestablecimientos.finca_id','=','fincas.id')
            ->select('establecimientoconceptos.id','establecimientoconceptos.gastosEstablecimiento_id',
            'establecimientoconceptos.conceptoGasto_id','establecimientoconceptos.descripcion','establecimientoconceptos.otro',
            'establecimientoconceptos.valorTotal','gastosestablecimientos.productor_id','gastosestablecimientos.finca_id','gastosestablecimientos.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
            //->where('establecimientoconceptos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('establecimientoconceptos.id', 'asc')->paginate(10);
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
            $gastos = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->join('conceptogastos','establecimientoconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosestablecimientos.productor_id','=','personas.id')
            ->join('fincas','gastosestablecimientos.finca_id','=','fincas.id')
            ->select('establecimientoconceptos.id','establecimientoconceptos.gastosEstablecimiento_id',
            'establecimientoconceptos.conceptoGasto_id','establecimientoconceptos.descripcion','establecimientoconceptos.otro',
            'establecimientoconceptos.valorTotal','gastosestablecimientos.productor_id','gastosestablecimientos.finca_id','gastosestablecimientos.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
            ->where('gastosestablecimientos.productor_id','=',$user)  
            ->orderBy('establecimientoconceptos.id', 'asc')->paginate(10);
        }
        if($criterio == 'personas'){
            $gastos = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->join('conceptogastos','establecimientoconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosestablecimientos.productor_id','=','personas.id')
            ->join('fincas','gastosestablecimientos.finca_id','=','fincas.id')
            ->select('establecimientoconceptos.id','establecimientoconceptos.gastosEstablecimiento_id',
            'establecimientoconceptos.conceptoGasto_id','establecimientoconceptos.descripcion','establecimientoconceptos.otro',
            'establecimientoconceptos.valorTotal','gastosestablecimientos.productor_id','gastosestablecimientos.finca_id','gastosestablecimientos.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
            ->where('gastosestablecimientos.productor_id','=',$user)  
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('establecimientoconceptos.id', 'asc')->paginate(10);
        }
        else{
            $gastos = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->join('conceptogastos','establecimientoconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosestablecimientos.productor_id','=','personas.id')
            ->join('fincas','gastosestablecimientos.finca_id','=','fincas.id')
            ->select('establecimientoconceptos.id','establecimientoconceptos.gastosEstablecimiento_id',
            'establecimientoconceptos.conceptoGasto_id','establecimientoconceptos.descripcion','establecimientoconceptos.otro',
            'establecimientoconceptos.valorTotal','gastosestablecimientos.productor_id','gastosestablecimientos.finca_id','gastosestablecimientos.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
            ->where('gastosestablecimientos.productor_id','=',$user)  
            //->where('establecimientoconceptos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('establecimientoconceptos.id', 'asc')->paginate(10);
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

            $gasto = new GastosEstablecimiento();
            $gasto->productor_id = $request->productor_id;
            $gasto->finca_id = $request->finca_id;
            $gasto->fechaRegistro = $mytime->toDateTimeString();
            $gasto->save();

            $establecimientoConceptos = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($establecimientoConceptos as $ep=>$establecimiento)
            {
                $establecimientoConcepto = new EstablecimientoConcepto();
                $establecimientoConcepto->gastosEstablecimiento_id = $gasto->id;
                $establecimientoConcepto->conceptoGasto_id = $establecimiento['conceptoGasto_id'];
                $establecimientoConcepto->descripcion = $establecimiento['descripcion'];
                $establecimientoConcepto->otro = $establecimiento['otro'];
                $establecimientoConcepto->valorTotal = $establecimiento['valorTotal'];    
                $establecimientoConcepto->save();
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
        $gastos = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->join('conceptogastos','establecimientoconceptos.conceptoGasto_id','=','conceptogastos.id')
            ->join('personas','gastosestablecimientos.productor_id','=','personas.id')
            ->join('fincas','gastosestablecimientos.finca_id','=','fincas.id')
            ->select('establecimientoconceptos.id','establecimientoconceptos.gastosEstablecimiento_id',
            'establecimientoconceptos.conceptoGasto_id','establecimientoconceptos.descripcion','establecimientoconceptos.otro',
            'establecimientoconceptos.valorTotal','gastosestablecimientos.productor_id','gastosestablecimientos.finca_id','gastosestablecimientos.fechaRegistro',
            'conceptogastos.nombre as conceptoGasto','personas.nombre as nombreProductor','fincas.nombre as nombreFinca')
        ->orderBy('establecimientoconceptos.id', 'asc')->get();
        return [
            'gastos' => $gastos
        ];
        
    }
    


}
