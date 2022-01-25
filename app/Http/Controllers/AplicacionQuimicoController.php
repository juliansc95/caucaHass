<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\AplicacionQuimico;

class AplicacionQuimicoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $quimicos= AplicacionQuimico::
            join('productors','aplquimicos.productor_id','=','productors.id')
            ->join('personas','aplquimicos.productor_id','=','personas.id')
            ->join('fincas','aplquimicos.finca_id','=','fincas.id')
            ->select('aplquimicos.id','aplquimicos.productor_id','aplquimicos.finca_id',
            'aplquimicos.fechaAplicacion','aplquimicos.quimico_id','aplquimicos.nombreIngenieroAgronomo',
            'aplquimicos.concentracion','aplquimicos.RegistroICA','aplquimicos.Dosis',
            'aplquimicos.periodoCarencia','aplquimicos.periodoEntrada',
            'aplquimicos.formaAplicacion',
            'aplquimicos.recomendo','aplquimicos.aplico',
            'personas.nombre as nombre_productor','fincas.nombre as nombre_finca'
            )
            ->orderBy('aplquimicos.id','desc')->paginate(10);
        }
        else{
            $quimicos= AplicacionQuimico::
            join('productors','aplquimicos.productor_id','=','productors.id')
            ->join('personas','aplquimicos.productor_id','=','personas.id')
            ->join('fincas','aplquimicos.finca_id','=','fincas.id')
            ->select('aplquimicos.id','aplquimicos.productor_id','aplquimicos.finca_id',
            'aplquimicos.fechaAplicacion','aplquimicos.quimico_id','aplquimicos.nombreIngenieroAgronomo',
            'aplquimicos.concentracion','aplquimicos.RegistroICA','aplquimicos.Dosis',
            'aplquimicos.periodoCarencia','aplquimicos.periodoEntrada',
            'aplquimicos.formaAplicacion',
            'aplquimicos.recomendo','aplquimicos.aplico',
            'personas.nombre as nombre_productor','fincas.nombre as nombre_finca'
            )
            ->where('aplquimicos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('aplquimicos.id', 'desc')->paginate(10);
        }
        return [
            'pagination' => [
                'total'        => $quimicos->total(),
                'current_page' => $quimicos->currentPage(),
                'per_page'     => $quimicos->perPage(),
                'last_page'    => $quimicos->lastPage(),
                'from'         => $quimicos->firstItem(),
                'to'           => $quimicos->lastItem(),
            ],
            'quimicos' => $quimicos
        ];
    }

    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $quimico = new AplicacionQuimico();
            $quimico->productor_id = $request->productor_id;
            $quimico->finca_id = $request->finca_id;
            $mytime= Carbon::parse($request->fechaAplicacion)->toDateString();
            $quimico->fechaAplicacion = $mytime;
            $quimico->quimico_id = $request->quimico_id;
            $quimico->nombreIngenieroAgronomo = $request->nombreIngenieroAgronomo;
            $quimico->concentracion = $request->concentracion;
            $quimico->RegistroICA = $request->RegistroICA;
            $quimico->Dosis = $request->Dosis;
            $quimico->periodoCarencia = $request->periodoCarencia;
            $quimico->periodoEntrada = $request->periodoEntrada;
            $quimico->formaAplicacion = $request->formaAplicacion;
            $quimico->recomendo = $request->recomendo;
            $quimico->Aplico = $request->Aplico;
            $quimico->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }
}
