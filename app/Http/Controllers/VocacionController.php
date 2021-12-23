<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Vocacion;
use Carbon\Carbon;


class VocacionController extends Controller
{
    public function index(Request $request)
    {
    if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $vocacions= Vocacion::join('personas','vocacions.productor_id','=','personas.id')
            ->join('productors','vocacions.productor_id','=','productors.id')
            ->join('fincas','vocacions.finca_id','=','fincas.id')
            ->select('personas.nombre','vocacions.productor_id','vocacions.finca_id','fincas.nombre as nombre_finca',
            'vocacions.vocacion','vocacions.tiempo','vocacions.practicaBasica','vocacions.capacitacionRefuerzo','vocacions.temasRefuerzo',
            'vocacions.diasMora','vocacions.labores','vocacions.motivo')
            ->orderBy('vocacions.id','desc')->paginate(3);
        }
        if($criterio == 'personas'){
            $vocacions= Vocacion::join('personas','vocacions.productor_id','=','personas.id')
            ->join('productors','vocacions.productor_id','=','productors.id')
            ->join('fincas','vocacions.finca_id','=','fincas.id')
            ->select('personas.nombre','vocacions.productor_id','vocacions.finca_id','fincas.nombre as nombre_finca',
            'vocacions.vocacion','vocacions.tiempo','vocacions.practicaBasica','vocacions.capacitacionRefuerzo','vocacions.temasRefuerzo',
            'vocacions.diasMora','vocacions.labores','vocacions.motivo')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('vocacions.id', 'asc')->paginate(3);
            }
        else{
            $vocacions= Vocacion::join('personas','vocacions.productor_id','=','personas.id')
            ->join('productors','vocacions.productor_id','=','productors.id')
            ->join('fincas','vocacions.finca_id','=','fincas.id')
            ->select('personas.nombre','vocacions.productor_id','vocacions.finca_id','fincas.nombre as nombre_finca',
            'vocacions.vocacion','vocacions.tiempo','vocacions.practicaBasica','vocacions.capacitacionRefuerzo','vocacions.temasRefuerzo',
            'vocacions.diasMora','vocacions.labores','vocacions.motivo')
            ->where('vocacions.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('vocacions.id', 'desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $vocacions->total(),
                'current_page' => $vocacions->currentPage(),
                'per_page'     => $vocacions->perPage(),
                'last_page'    => $vocacions->lastPage(),
                'from'         => $vocacions->firstItem(),
                'to'           => $vocacions->lastItem(),
            ],
            'vocacions' => $vocacions
        ];
    }
    public function store(Request $request)
    {
       // if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $vocacion = new Vocacion();
        $vocacion->productor_id = $request->productor_id;
        $vocacion->finca_id = $request->finca_id;
        $vocacion->vocacion=$request->vocacion;
        $vocacion->tiempo=$request->tiempo;
        $vocacion->practicaBasica= $request->practicaBasica;
        $vocacion->capacitacionRefuerzo= $request->capacitacionRefuerzo;
        $vocacion->temasRefuerzo= $request->temasRefuerzo;
        $vocacion->diasMora= $request->diasMora;
        $vocacion->labores= $request->labores;
        $vocacion->motivo= $request->motivo;
        $vocacion->save();
        DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');
        $cont=Vocacion::count();
        $vocacions= Vocacion::join('personas','vocacions.productor_id','=','personas.id')
        ->join('productors','vocacions.productor_id','=','productors.id')
        ->join('fincas','vocacions.finca_id','=','fincas.id')
        ->select('personas.nombre','vocacions.productor_id','vocacions.finca_id','fincas.nombre as nombre_finca',
        'vocacions.vocacion','vocacions.tiempo','vocacions.practicaBasica','vocacions.capacitacionRefuerzo','vocacions.temasRefuerzo',
        'vocacions.diasMora','vocacions.labores','vocacions.motivo')
        ->orderBy('vocacions.id','desc')->get();
        $pdf = \PDF::loadView('pdf.vocacion',['vocacions'=>$vocacions,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('vocacion.pdf');   
    }

    public function excel(Request $request)
    {
        $vocacions= Vocacion::join('personas','vocacions.productor_id','=','personas.id')
        ->join('productors','vocacions.productor_id','=','productors.id')
        ->join('fincas','vocacions.finca_id','=','fincas.id')
        ->select('personas.nombre','vocacions.productor_id','vocacions.finca_id','fincas.nombre as nombre_finca',
        'vocacions.vocacion','vocacions.tiempo','vocacions.practicaBasica','vocacions.capacitacionRefuerzo','vocacions.temasRefuerzo',
        'vocacions.diasMora','vocacions.labores','vocacions.motivo')
        ->orderBy('vocacions.id','desc')->get();
        return [
            'vocacions' => $vocacions
        ];
    }
}
