<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Enfermedad;
use Carbon\Carbon;



class EnfermedadController extends Controller
{
    public function index(Request $request)
    {
    if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $enfermedads= Enfermedad::join('personas','enfermedads.productor_id','=','personas.id')
            ->join('productors','enfermedads.productor_id','=','productors.id')
            ->join('fincas','enfermedads.finca_id','=','fincas.id')
            ->select('personas.nombre','enfermedads.productor_id','enfermedads.finca_id','fincas.nombre as nombre_finca',
            'enfermedads.monitoreo','enfermedads.frecuenciaMonitoreo','enfermedads.antracnosis','enfermedads.tipoManejoAntra','enfermedads.frecuenciaAntra',
            'enfermedads.botritys','enfermedads.tipoManejoBotritys','enfermedads.frecuenciaBotritys','enfermedads.mildeo',
            'enfermedads.tipoManejoMildeo','enfermedads.frecuenciaMildeo','enfermedads.mildeoVelloso','enfermedads.tipoManejoMildeoVelloso','enfermedads.frecuenciaMildeoVelloso',
            'enfermedads.adherentes','enfermedads.nombreAdherente','enfermedads.dosisAplicacion')
            ->orderBy('enfermedads.id','desc')->paginate(3);
        }
        if($criterio == 'personas'){
            $enfermedads= Enfermedad::join('personas','enfermedads.productor_id','=','personas.id')
            ->join('productors','enfermedads.productor_id','=','productors.id')
            ->join('fincas','enfermedads.finca_id','=','fincas.id')
            ->select('personas.nombre','enfermedads.productor_id','enfermedads.finca_id','fincas.nombre as nombre_finca',
            'enfermedads.monitoreo','enfermedads.frecuenciaMonitoreo','enfermedads.antracnosis','enfermedads.tipoManejoAntra','enfermedads.frecuenciaAntra',
            'enfermedads.botritys','enfermedads.tipoManejoBotritys','enfermedads.frecuenciaBotritys','enfermedads.mildeo',
            'enfermedads.tipoManejoMildeo','enfermedads.frecuenciaMildeo','enfermedads.mildeoVelloso','enfermedads.tipoManejoMildeoVelloso','enfermedads.frecuenciaMildeoVelloso',
            'enfermedads.adherentes','enfermedads.nombreAdherente','enfermedads.dosisAplicacion')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('enfermedads.id', 'asc')->paginate(3);
            }
        else{
            $enfermedads= Enfermedad::join('personas','enfermedads.productor_id','=','personas.id')
            ->join('productors','enfermedads.productor_id','=','productors.id')
            ->join('fincas','enfermedads.finca_id','=','fincas.id')
            ->select('personas.nombre','enfermedads.productor_id','enfermedads.finca_id','fincas.nombre as nombre_finca',
            'enfermedads.monitoreo','enfermedads.frecuenciaMonitoreo','enfermedads.antracnosis','enfermedads.tipoManejoAntra','enfermedads.frecuenciaAntra',
            'enfermedads.botritys','enfermedads.tipoManejoBotritys','enfermedads.frecuenciaBotritys','enfermedads.mildeo',
            'enfermedads.tipoManejoMildeo','enfermedads.frecuenciaMildeo','enfermedads.mildeoVelloso','enfermedads.tipoManejoMildeoVelloso','enfermedads.frecuenciaMildeoVelloso',
            'enfermedads.adherentes','enfermedads.nombreAdherente','enfermedads.dosisAplicacion')
            ->where('enfermedads.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('enfermedads.id', 'desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $enfermedads->total(),
                'current_page' => $enfermedads->currentPage(),
                'per_page'     => $enfermedads->perPage(),
                'last_page'    => $enfermedads->lastPage(),
                'from'         => $enfermedads->firstItem(),
                'to'           => $enfermedads->lastItem(),
            ],
            'enfermedads' => $enfermedads
        ];
    }
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $enfermedads = new Enfermedad();
        $enfermedads->productor_id = $request->productor_id;
        $enfermedads->finca_id = $request->finca_id;
        $enfermedads->monitoreo=$request->monitoreo;
        $enfermedads->frecuenciaMonitoreo=$request->frecuenciaMonitoreo;
        $enfermedads->antracnosis= $request->antracnosis;
        $enfermedads->tipoManejoAntra= $request->tipoManejoAntra;
        $enfermedads->frecuenciaAntra= $request->frecuenciaAntra;
        $enfermedads->botritys= $request->botritys;
        $enfermedads->tipoManejoBotritys= $request->tipoManejoBotritys;
        $enfermedads->frecuenciaBotritys= $request->frecuenciaBotritys;
        $enfermedads->mildeo= $request->mildeo;
        $enfermedads->tipoManejoMildeo= $request->tipoManejoMildeo;
        $enfermedads->frecuenciaMildeo= $request->frecuenciaMildeo;
        $enfermedads->mildeoVelloso= $request->mildeoVelloso;
        $enfermedads->tipoManejoMildeoVelloso= $request->tipoManejoMildeoVelloso;
        $enfermedads->frecuenciaMildeoVelloso= $request->frecuenciaMildeoVelloso;
        $enfermedads->adherentes= $request->adherentes;
        $enfermedads->nombreAdherente= $request->nombreAdherente;
        $enfermedads->dosisAplicacion= $request->dosisAplicacion;
        $enfermedads->save();
        DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');
        $cont=Enfermedad::count();
        $enfermedads= Enfermedad::join('personas','enfermedads.productor_id','=','personas.id')
        ->join('productors','enfermedads.productor_id','=','productors.id')
        ->join('fincas','enfermedads.finca_id','=','fincas.id')
        ->select('personas.nombre','enfermedads.productor_id','enfermedads.finca_id','fincas.nombre as nombre_finca',
        'enfermedads.monitoreo','enfermedads.frecuenciaMonitoreo','enfermedads.antracnosis','enfermedads.tipoManejoAntra','enfermedads.frecuenciaAntra',
        'enfermedads.botritys','enfermedads.tipoManejoBotritys','enfermedads.frecuenciaBotritys','enfermedads.mildeo',
        'enfermedads.tipoManejoMildeo','enfermedads.frecuenciaMildeo','enfermedads.mildeoVelloso','enfermedads.tipoManejoMildeoVelloso','enfermedads.frecuenciaMildeoVelloso',
        'enfermedads.adherentes','enfermedads.nombreAdherente','enfermedads.dosisAplicacion')
        ->orderBy('enfermedads.id','desc')->get();
        $pdf = \PDF::loadView('pdf.enfermedad',['enfermedads'=>$enfermedads,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('enfermedad.pdf');   
    }

    public function excel(Request $request)
    {
        $enfermedads= Enfermedad::join('personas','enfermedads.productor_id','=','personas.id')
        ->join('productors','enfermedads.productor_id','=','productors.id')
        ->join('fincas','enfermedads.finca_id','=','fincas.id')
        ->select('personas.nombre','enfermedads.productor_id','enfermedads.finca_id','fincas.nombre as nombre_finca',
        'enfermedads.monitoreo','enfermedads.frecuenciaMonitoreo','enfermedads.antracnosis','enfermedads.tipoManejoAntra','enfermedads.frecuenciaAntra',
        'enfermedads.botritys','enfermedads.tipoManejoBotritys','enfermedads.frecuenciaBotritys','enfermedads.mildeo',
        'enfermedads.tipoManejoMildeo','enfermedads.frecuenciaMildeo','enfermedads.mildeoVelloso','enfermedads.tipoManejoMildeoVelloso','enfermedads.frecuenciaMildeoVelloso',
        'enfermedads.adherentes','enfermedads.nombreAdherente','enfermedads.dosisAplicacion')
        ->orderBy('enfermedads.id','desc')->get();
        return [
            'enfermedads' => $enfermedads
        ];
    }
}
