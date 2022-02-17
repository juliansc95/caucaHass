<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Fertilizante;

class FertilizanteController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $fertilizantes= Fertilizante::
            join('productors','fertilizantes.productor_id','=','productors.id')
            ->join('personas','fertilizantes.productor_id','=','personas.id')
            ->join('fincas','fertilizantes.finca_id','=','fincas.id')
            ->select('fertilizantes.id','fertilizantes.productor_id','fertilizantes.finca_id',
            'fertilizantes.fechaAplicacion','fertilizantes.nombreProducto','fertilizantes.nombreIngenieroAgronomo',
            'fertilizantes.concentracion','fertilizantes.RegistroICA','fertilizantes.Dosis',
            'fertilizantes.formaAplicacion',
            'fertilizantes.recomendo','fertilizantes.aplico',
            'personas.nombre as nombre_productor','fincas.nombre as nombre_finca'
            )
            ->orderBy('fertilizantes.id','desc')->paginate(10);
        }
        else{
            $fertilizantes= Fertilizante::
            join('productors','fertilizantes.productor_id','=','productors.id')
            ->join('personas','fertilizantes.productor_id','=','personas.id')
            ->join('fincas','fertilizantes.finca_id','=','fincas.id')
            ->select('fertilizantes.id','fertilizantes.productor_id','fertilizantes.finca_id',
            'fertilizantes.fechaAplicacion','fertilizantes.nombreProducto','fertilizantes.nombreIngenieroAgronomo',
            'fertilizantes.concentracion','fertilizantes.RegistroICA','fertilizantes.Dosis',
            'fertilizantes.formaAplicacion',
            'fertilizantes.recomendo','fertilizantes.aplico',
            'personas.nombre as nombre_productor','fincas.nombre as nombre_finca'
            )
            ->where('fertilizantes.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('fertilizantes.id', 'desc')->paginate(10);
        }
        return [
            'pagination' => [
                'total'        => $fertilizantes->total(),
                'current_page' => $fertilizantes->currentPage(),
                'per_page'     => $fertilizantes->perPage(),
                'last_page'    => $fertilizantes->lastPage(),
                'from'         => $fertilizantes->firstItem(),
                'to'           => $fertilizantes->lastItem(),
            ],
            'fertilizantes' => $fertilizantes
        ];
    }

    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $fertilizante = new fertilizante();
            $fertilizante->productor_id = $request->productor_id;
            $fertilizante->finca_id = $request->finca_id;
            $mytime= Carbon::parse($request->fechaAplicacion)->toDateString();
            $fertilizante->fechaAplicacion = $mytime;
            $fertilizante->nombreProducto = $request->nombreProducto;
            $fertilizante->nombreIngenieroAgronomo = $request->nombreIngenieroAgronomo;
            $fertilizante->concentracion = $request->concentracion;
            $fertilizante->RegistroICA = $request->RegistroICA;
            $fertilizante->Dosis = $request->Dosis;
            $fertilizante->formaAplicacion = $request->formaAplicacion;
            $fertilizante->recomendo = $request->recomendo;
            $fertilizante->Aplico = $request->Aplico;
            $fertilizante->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');    
        $fertilizantes= Fertilizante::
        join('productors','fertilizantes.productor_id','=','productors.id')
        ->join('personas','fertilizantes.productor_id','=','personas.id')
        ->join('fincas','fertilizantes.finca_id','=','fincas.id')
        ->select('fertilizantes.id','fertilizantes.productor_id','fertilizantes.finca_id',
        'fertilizantes.fechaAplicacion','fertilizantes.nombreProducto','fertilizantes.nombreIngenieroAgronomo',
        'fertilizantes.concentracion','fertilizantes.RegistroICA','fertilizantes.Dosis',
        'fertilizantes.formaAplicacion',
        'fertilizantes.recomendo','fertilizantes.aplico',
        'personas.nombre as nombre_productor','fincas.nombre as nombre_finca'
        )
        ->orderBy('fertilizantes.id','desc')->get();
        $cont=Fertilizante::count();

        $pdf = \PDF::loadView('pdf.fertilizantes',['fertilizantes'=>$fertilizantes,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('fertilizantes.pdf');  
    }

    public function excel(Request $request)
    {    
        $fertilizantes= Fertilizante::
        join('productors','fertilizantes.productor_id','=','productors.id')
        ->join('personas','fertilizantes.productor_id','=','personas.id')
        ->join('fincas','fertilizantes.finca_id','=','fincas.id')
        ->select('fertilizantes.id','fertilizantes.productor_id','fertilizantes.finca_id',
        'fertilizantes.fechaAplicacion','fertilizantes.nombreProducto','fertilizantes.nombreIngenieroAgronomo',
        'fertilizantes.concentracion','fertilizantes.RegistroICA','fertilizantes.Dosis',
        'fertilizantes.formaAplicacion',
        'fertilizantes.recomendo','fertilizantes.aplico',
        'personas.nombre as nombre_productor','fincas.nombre as nombre_finca'
        )
            ->orderBy('fertilizantes.id','desc')->get();
            return [
                'fertilizantes' => $fertilizantes
            ];
    }



}
