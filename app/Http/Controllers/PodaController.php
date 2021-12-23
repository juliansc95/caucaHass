<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Poda;

class PodaController extends Controller
{
    public function index(Request $request)
    {
    //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $podas= Poda::join('personas','podas.productor_id','=','personas.id')
            ->join('productors','podas.productor_id','=','productors.id')
            ->join('fincas','podas.finca_id','=','fincas.id')
            ->select('personas.nombre','podas.productor_id','podas.finca_id','fincas.nombre as nombre_finca',
            'podas.estadoVegetativo','podas.podaFormacion','podas.podaAclareo','podas.frecuenciaAclareo','podas.podaMantenimiento',
            'podas.frecuenciaMantenimiento','podas.podaFitosanitaria','podas.frecuenciaFitosanitaria')
            ->orderBy('podas.id','desc')->paginate(3);
        }
        if($criterio == 'personas'){
            $podas= Poda::join('personas','podas.productor_id','=','personas.id')
            ->join('productors','podas.productor_id','=','productors.id')
            ->join('fincas','podas.finca_id','=','fincas.id')
            ->select('personas.nombre','podas.productor_id','podas.finca_id','fincas.nombre as nombre_finca',
            'podas.estadoVegetativo','podas.podaFormacion','podas.podaAclareo','podas.frecuenciaAclareo','podas.podaMantenimiento',
            'podas.frecuenciaMantenimiento','podas.podaFitosanitaria','podas.frecuenciaFitosanitaria')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('podas.id', 'asc')->paginate(3);
            }
        else{
            $podas= Poda::join('personas','podas.productor_id','=','personas.id')
            ->join('productors','podas.productor_id','=','productors.id')
            ->join('fincas','podas.finca_id','=','fincas.id')
            ->select('personas.nombre','podas.productor_id','podas.finca_id','fincas.nombre as nombre_finca',
            'podas.estadoVegetativo','podas.podaFormacion','podas.podaAclareo','podas.frecuenciaAclareo','podas.podaMantenimiento',
            'podas.frecuenciaMantenimiento','podas.podaFitosanitaria','podas.frecuenciaFitosanitaria')
            ->where('podas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('podas.id', 'desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $podas->total(),
                'current_page' => $podas->currentPage(),
                'per_page'     => $podas->perPage(),
                'last_page'    => $podas->lastPage(),
                'from'         => $podas->firstItem(),
                'to'           => $podas->lastItem(),
            ],
            'podas' => $podas
        ];
    }
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $podas = new Poda();
        $podas->productor_id = $request->productor_id;
        $podas->finca_id = $request->finca_id;
        $podas->estadoVegetativo=$request->estadoVegetativo;
        $podas->podaFormacion=$request->podaFormacion;
        $podas->podaAclareo=$request->podaAclareo;
        $podas->frecuenciaAclareo=$request->frecuenciaAclareo;
        $podas->podaMantenimiento=$request->podaMantenimiento;
        $podas->frecuenciaMantenimiento=$request->frecuenciaMantenimiento;
        $podas->podaFitosanitaria=$request->podaFitosanitaria;
        $podas->frecuenciaFitosanitaria=$request->frecuenciaFitosanitaria;
        $podas->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');
        $cont=Poda::count();
        $podas= Poda::join('personas','podas.productor_id','=','personas.id')
        ->join('productors','podas.productor_id','=','productors.id')
        ->join('fincas','podas.finca_id','=','fincas.id')
        ->select('personas.nombre','podas.productor_id','podas.finca_id','fincas.nombre as nombre_finca',
        'podas.estadoVegetativo','podas.podaFormacion','podas.podaAclareo','podas.frecuenciaAclareo','podas.podaMantenimiento',
        'podas.frecuenciaMantenimiento','podas.podaFitosanitaria','podas.frecuenciaFitosanitaria')
        ->orderBy('podas.id','desc')->get();
        $pdf = \PDF::loadView('pdf.podas',['podas'=>$podas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('podas.pdf');
       
    }

    public function excel(Request $request)
    {
        $podas= Poda::join('personas','podas.productor_id','=','personas.id')
        ->join('productors','podas.productor_id','=','productors.id')
        ->join('fincas','podas.finca_id','=','fincas.id')
        ->select('personas.nombre','podas.productor_id','podas.finca_id','fincas.nombre as nombre_finca',
        'podas.estadoVegetativo','podas.podaFormacion','podas.podaAclareo','podas.frecuenciaAclareo','podas.podaMantenimiento',
        'podas.frecuenciaMantenimiento','podas.podaFitosanitaria','podas.frecuenciaFitosanitaria')
        ->orderBy('podas.id','desc')->get();
        return [
            'podas' => $podas
        ];
    }
}
